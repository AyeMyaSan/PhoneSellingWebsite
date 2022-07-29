<?php
namespace App\Dao;

use App\Contracts\Dao\wishlistDaoInterface;
use App\Contracts\Services\wishlistServiceInterface;
use App\wishlists;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class wishlistDao implements wishlistDaoInterface
{

    public function store($request)
     {             
            wishlists::create([
                'p_id' => $request->id,
                'user_id'=>auth()->user()->id,
            ]);
        
           
    }

  
    public function removewishlist($request)
    {
        
    $wishlistInfo = wishlists::where('user_id', auth()->user()->id)
                            ->where('p_id', $request->id)
                            ->delete();
    }

    
    public function deletewishlist($request)
    {
        
    $wishlistInfo = wishlists::where('user_id', auth()->user()->id)
                            ->where('p_id', $request->id)
                            ->delete();
    }

    public function showwishlist()
    {
        $wishlistInfo = wishlists::join('product', 'product.id', '=', 'wishlist.p_id')
        ->join('users', 'users.id', '=', 'wishlist.user_id')
        -> where('wishlist.user_id', auth()->user()->id)
        ->orderBy('wishlist.created_at', 'desc')
        ->select('wishlist.*','product.*')
         ->get();   

        return $wishlistInfo; 
    }

    public function mywishlist()
    {
        $wishlistInfo = wishlists::join('product', 'product.id', '=', 'wishlist.p_id')
        ->join('users', 'users.id', '=', 'wishlist.user_id')
        -> where('wishlist.user_id', auth()->user()->id)
        ->orderBy('wishlist.created_at', 'desc')
        ->select('wishlist.*','product.*')
         ->get();   

        return $wishlistInfo;; 


    }


}
