<?php
namespace App\Contracts\Dao;

interface orderDaoInterface
{
    // public function showOrder();
    // public function orderDelete($id);
    public function getAllOrders();
    public function saveOrder($orderArray);
    public function saveOrderDetail($orderDetailArray);
    public function orderDelete($id);
    public function updateStatus($request);    
    public function Orders();
    public function Sales();
    public function Revenues();
    public function Mobile();
    public function Laptop();
    public function Tablet();





}
?>