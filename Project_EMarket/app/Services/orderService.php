<?php
namespace App\Services;

use App\Contracts\Services\orderServiceInterface;
use App\Contracts\Dao\orderDaoInterface;
use App\Contracts\Dao\productDaoInterface;
use App\Order;
use Mail;

class orderService implements orderServiceInterface
{
    public $orderDao,$productDao;
    
    public function __construct(orderDaoInterface $orderDao,productDaoInterface $productDao)
    {
        $this->orderDao = $orderDao;
        $this->prodcutDao = $productDao;
    }
    
    public function checkout($request){
        $totalPrice = $totalQuantity = 0;
        foreach(session('cart') as $id => $value){
            $totalQuantity += $value['quantity'];
            $totalPrice+=$value['price']*$value['quantity'];
        }
        
        $orderArray = [
            'user_id' => auth()->user()->id,
            'total_quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'status' => 0,
            'user_name'=>$request->user_name,
            'email'=>$request->user_email,
            'phoneNo'=>$request->phone_no,
            'address'=>$request->user_address
        ];        
        $newOrder = $this->orderDao->saveOrder($orderArray);
        
        $orderDetailArray= array();
        foreach(session('cart') as $id => $value){
            
            $orderDetail = [
                
                'o_id' => $newOrder->id,
                'p_id' => $value['id'],
                'color' => $value['color'],
                'unit_price' =>$value['price'],
                'quantity' => $value['quantity'],
                'total_price' => $value['price']*$value['quantity'],
                'created_at' => date('Y-m-d H:i:s')
            ];            
            $orderDetailArray[]=$orderDetail;
            
        }
        $this->orderDao->saveOrderDetail($orderDetailArray);
        //session()->forget('cart');
       
    }
    public function getAllOrders(){
        return $this->orderDao->getAllOrders();
    }
    public function Orders(){
        return $this->orderDao->Orders();
    }
    public function Sales(){
        return $this->orderDao->Sales();
    }
    public function Revenues(){
        return $this->orderDao->Revenues();
    }
    public function orderDelete($id)
    {
        return $this->orderDao->orderDelete($id);
    }
    public function showOrderDetail($request)
    { 
        return $this->orderDao->showOrderDetail($request);
    }
    
    public function updateStatus($request)
    {
        return $this->orderDao->updateStatus($request);
    } 
    public function Mobile() 
    {
       return $this->orderDao->Mobile();
    }
    public function Laptop() 
    {
       return $this->orderDao->Laptop();
    }
    public function Tablet() 
    {
       return $this->orderDao->Tablet();
    }

    public function showvoucher($request)
    {
        return $this->orderDao->showvoucher($request);
    }
    
    public function basic_email($request) {
        $orderDetail = $this->orderDao->showOrderDetail($request->hiddenorderid);
        $mail = $request->email;
        $data = array('name'=>'tt', 'email'=>$mail);
    //dd($orderDetail);
        Mail::send('services.Mail', ['data'=>$data, 'orderDetail'=>$orderDetail], function($message) use($data, $orderDetail) {
           $message->to($data['email'], 'Laravel')
                    ->from('thinthinmoe.bcsc@gmail.com','Thin Thin Moe')
                    ->subject('Laravel Basic Testing Mail');
        });
        return back();
    }

}
?>