<?php
namespace App\Contracts\Services;

interface wishlistServiceInterface
{       
  
    public function store($request);
    public function removewishlist($request);
    public function deletewishlist($request);
    public function mywishlist();
    public function showwishlist();
}
?>