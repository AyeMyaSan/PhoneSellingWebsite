<?php
namespace App\Contracts\Services;

interface orderServiceInterface
{   
    public function checkout($request);
    public function getAllOrders();
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