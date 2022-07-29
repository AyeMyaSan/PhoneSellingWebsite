<?php

namespace App\Http\Controllers;

use App\Contracts\Services\orderServiceInterface;
use App\Order;
use Datatables;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(orderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

      public function thanku(){
        return view('thankU');
      }
     

    public function checkout(Request $request)
    {
        function formatInput()
        {
            $input = array_map('trim', $this->all());
            $input['price'] = (int) ($input['price']);

            $this->replace($input);
            return $this->all();
        } 
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|regex:/[0-9]+/|between:0,15',
            'user_address' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('showUserForm'))
                ->withErrors($validator)
                ->withInput();
        }

        $cart = session('cart');
        $product = $request->product;
        if($request->btn_edit_post == 'CheckOut'){
            $cart = array_map(function($item) use ($product){
                foreach($product as $p) {
                    if ($item['id'] == $p['id'] && $item['color'] == $p['color']) {
                        $item['quantity'] = $p['quantity'];
                    }
                }
                return $item;
            }, $cart);
            session()->put('cart', $cart);
            return redirect()->route('thanku');
        }else{  
            
            if(isset($cart[$request->btn_edit_post])) {
                
                session()->forget('cart.'. $request->btn_edit_post);
              }
        }
        $this->orderService->checkout($request);
        return view('thankU');
        //session()->forget('cart');
    }

    public function order()
    {
        return view('services.Order');
    }

    public function orderList()
    {
        $productsQuery = "(SELECT o_id, array_agg(distinct product.model) products
                            FROM order_detail
                            join product on product.id = p_id
                            group by o_id) as o_p";

        $orderData = order::join('users', 'users.id', '=', 'order.user_id')
            ->join(\DB::raw($productsQuery), 'o_p.o_id', '=', 'order.id')
            ->orderBy('order.created_at', 'desc')
            ->select('order.*', 'users.name', 'users.email', 'products')
            ->get()
            ->map(function ($d) {
                $d->products = implode(", ", explode(',', substr($d->products, 1, -1)));
                return $d;
            });

        return DataTables::of($orderData)
            ->addIndexColumn()
            ->addColumn('status', function ($order) {
                if ($order->status == 0) {
                    return "Pending";
                } elseif ($order->status == 1) {
                    return "Confirmed";
                } elseif ($order->status == 2) {
                    return "Delivered";
                }
            })
            ->addColumn('action', function ($order) {
                return '<a href="/order/detail/' . $order->id . '"><i class="fa fa-eye"></i> View</a>';
            })
            ->make(true);
    }
    public function orderDelete($id)
    {
        $this->orderService->orderDelete($id);
        return redirect()->route('order');
    }

    public function showOrderDetail($request)
    {
        $orderInfo = $this->orderService->showOrderDetail($request);
        return view('services.OrderDetail')->with('orderInfo', $orderInfo);
    }

    public function updateStatus(Request $request)
    {

        $orderInfo = $this->orderService->updateStatus($request);
        if ($request->status != 2) {
            $sendMail = $this->orderService->basic_email($request);

        }
        return view('services.OrderDetail')->with(compact('orderInfo'));

    }

    public function myorders()
    {
        return view('myorder');
    }

    public function myorderList()
    {
        $productsQuery = "(SELECT o_id, array_agg(distinct product.model) model,array_agg(distinct product.image) image
                            FROM order_detail
                            join product on product.id = p_id
                            group by o_id) as o_p";

        $orderData = order::join(\DB::raw($productsQuery), 'o_p.o_id', '=', 'order.id')
            ->orderBy('order.created_at', 'desc')
            ->select('order.*', 'model', 'image')
            ->get()
            ->map(function ($d) {
                $d->model = implode(", ", explode(',', substr($d->model, 1, -1)));
                return $d;
            });

        return Datatables::of($orderData)
            ->addColumn('status', function ($order) {
                if ($order->status == 0) {
                    return "Pending";
                } elseif ($order->status == 1) {
                    return "Confirmed";
                } elseif ($order->status == 2) {
                    return "Delivered";
                }
            })
            ->addColumn('action', function ($order) {
                return '<a href="/voucher/' . $order->id . '"><i class="fa fa-eye"></i>View Voucher</a>';
            })

            ->make(true);
    }

    public function showvoucher($request)
    {
        $orderInfo = $this->orderService->showvoucher($request);
        return view('voucher1')->with('orderInfo', $orderInfo);
    }
}
