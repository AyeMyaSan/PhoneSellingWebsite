<?php
namespace App\Dao;

use App\Contracts\Dao\orderDaoInterface;
use App\Order;
use App\OrderDetail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class orderDao implements orderDaoInterface
{
    
    public function saveOrder($orderArray)
    {
        return Order::create($orderArray);
    }
    
    public function saveOrderDetail($orderDetailsArray)
    {
        return OrderDetail::insert($orderDetailsArray);
    }
    public function getAllOrders()
    {
        $orderInfo = order::join('users', 'users.id', '=', 'order.user_id')
        ->join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->orderBy('order.created_at', 'desc')
        ->select(['order.*', 'users.name', 'users.email', 'order.phoneNo', 'order.address', 'product.model', 'product.image'])
        ->get();        
        $orderInfo = $orderInfo->groupBy('id');
        return $orderInfo;
    }
    public function Orders()
    {
        $orderInfo = order::select(['id'])
        ->get();
        return $orderInfo;
    }
    public function Sales()
    {
        $saleInfo = order::join('users', 'users.id', '=', 'order.user_id')
        ->join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->where('order.status','0')
        ->select(['order_detail.quantity'])
        ->get();
        //  dd($saleInfo);
        return $saleInfo;
    }
    public function Revenues()
    {
        // $priceInfo = order::select(['order.total_price'])
        // ->get();        
        // return $priceInfo;
        $priceInfo = order::join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->where('order.status','2')
        ->select(['order.total_price'])
        ->get();       
        return $priceInfo;
    }
    public function orderDelete($id)
    {
        $orderInfo = order::where('id', $id)
        ->delete();
    }
    
    public function showOrderDetail($id)
    {
        $orderInfo = order::join('users', 'users.id', '=', 'order.user_id')
        ->join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->orderBy('order.created_at', 'desc')
        ->where('order_detail.o_id', $id)
        ->select(['order.*', 'product.model', 'product.price', 'product.image', 'product.ram', 'product.memory', 'order_detail.color', 'order_detail.quantity', 'users.name', 'users.email', 'order.phoneNo', 'order.address'])
        ->get();
        return $orderInfo; 
        
    }
    public function updateStatus($request)
    {         
        $id = (int)$request->hiddenorderid; 
        $status = (int)$request->status;
        // dd($id,$status);
        $order = \DB::table('order')->where('id', $id)->update(['status' => $status]);
        $orderInfo = \DB::table('order')
        ->join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->orderBy('order.created_at', 'desc')
        ->where('order.id', $id)
        ->select(['order.*', 'product.model', 'product.price', 'product.image', 'product.ram', 'product.memory', 'order_detail.color', 'order_detail.quantity','order.phoneNo', 'order.address'])
        ->get();
       
       // dd($orderInfo);

        return $orderInfo;
    }
    public function Mobile()
    {
        $mobile = order::join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->where('product.category', 's')
        ->select(['order_detail.quantity','product.category'])
        ->get();
        return $mobile; 
       
    }
    public function Laptop()
    {
        $laptop = order::join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->where('product.category', 'l')
        ->select(['order_detail.quantity','product.category'])
        ->get();
        return $laptop; 
       
    }
    public function Tablet()
    {
      
        $tablet = order::join('order_detail', 'order_detail.o_id', '=', 'order.id')
        ->join('product', 'product.id', '=', 'order_detail.p_id')
        ->where('product.category', 't')
        ->select(['order_detail.quantity','product.category'])
        ->get();
        // dd($tablet);
        return $tablet; 
    }

    public function showvoucher($id)
    {
        $orderInfo = order::join('users', 'users.id', '=', 'order.user_id')
            ->join('order_detail', 'order_detail.o_id', '=', 'order.id')
            ->join('product', 'product.id', '=', 'order_detail.p_id')
            ->orderBy('order.created_at', 'desc')
            ->where('order_detail.o_id', $id)
            ->select(['order.*', 'product.model', 'product.price', 'product.image', 'product.ram', 'product.memory', 'order_detail.color', 'order_detail.quantity', 'users.name', 'users.email', 'order.phoneNo', 'order.address'])
            ->get();

            return $orderInfo; 
    }
   
    
}
