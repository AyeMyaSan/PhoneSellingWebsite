<?php
namespace App\Contracts\Services;

interface productServiceInterface
{
    public function addProduct($request,$image);
    public function showMyProduct();
    public function showSmartPhone();
    public function wishproduct();
    public function showTablet();
    public function showLaptop();
    public function showProductDetail($request);
    public function productEditShow($id);
    public function productUpdate($request,$image); 
    public function productDelete($id);
    public function getProduct();
    public function recentItems();
    // public function showreview($request);
    // public function revDel($request);
    // public function addreview($request);
    // public function revEdit($id);
    // public function proid($request);
    // public function proidedit($id);

}
?>