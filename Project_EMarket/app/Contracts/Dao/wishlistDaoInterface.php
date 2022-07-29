<?php
namespace App\Contracts\Dao;

interface wishlistDaoInterface
{
    
    public function store($request);
    public function removewishlist($request);
    public function deletewishlist($request);
    public function mywishlist();
    public function showwishlist();
}
?>