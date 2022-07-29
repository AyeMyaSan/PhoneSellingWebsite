<?php
namespace App\Services;

use App\Contracts\Dao\wishlistDaoInterface;
use App\Contracts\Services\wishlistServiceInterface;
use App\wishlists;

class wishlistService implements wishlistServiceInterface
{
    public $wishlistDao;

    public function __construct(wishlistDaoInterface $wishlistDao)
    {
        $this->wishlistDao = $wishlistDao;

    }

    public function store($request)
    {
        return $this->wishlistDao->store($request);
    }

    public function removewishlist($request)
    {
        return $this->wishlistDao->removewishlist($request);
    }
    public function deletewishlist($request)
    {
        return $this->wishlistDao->deletewishlist($request);
    }

    public function mywishlist(){
        return $this->wishlistDao->mywishlist();
    }

    public function showwishlist()
    {
        return $this->wishlistDao->showwishlist();
    }
    

}
