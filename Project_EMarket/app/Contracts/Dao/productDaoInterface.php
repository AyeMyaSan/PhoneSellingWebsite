<?php
namespace App\Contracts\Dao;

interface productDaoInterface
{
    public function addProduct($request,$image);
    public function showMyProduct();
    public function showSmartPhone();
    public function wishproduct();
    public function showTablet();
    public function showLaptop();
    public function showProductDetail($request);
    public function productEditShow($id);
    public function productUpdate($pId,$updateArray); 
    public function productDelete($id);
    public function getProduct();
    public function getProductById($id);
    public function recentItems();
    // public function showreview($request);
    // public function revDel($request);
    // public function addreview($request);
    // public function revEdit($id);
    // public function proid($request);
    // public function proidedit($id);

    
}