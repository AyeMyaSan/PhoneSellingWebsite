<?php

use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
use App\Contracts\Services\wishlistServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Validator;
use App\wishlists;
use Auth;

use Datatables;

class WishlistController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $wishlistService;
    
    public function __construct(wishlistServiceInterface $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }
    public function viewwishlist()
    {
         return view('WishList');
    }
   
    // public function index()
    // {
    //   $user = Auth::user();
    //   $wishlists = Wishlist::where("user_id", "=", $user->id)->orderby('id', 'desc')->paginate(10);
    //   return view('wishlist', compact('user', 'wishlists'));
    // }

    public function store(Request $request)
    {
       
        $this->wishlistService->store($request);
       
        return back()->with('success','successfully!');

        }

public function removewishlist(Request $request)
    {
        $this->wishlistService->removewishlist($request);
       
        return back()->with('delete','successfully!');
    }

    public function deletewishlist(Request $request)
    {
        $this->wishlistService->deletewishlist($request);
        return back()->with('delete','successfully!');
    }


    public function mywishlist(){
        $wishlistInfo=$this->wishlistService->mywishlist();
        return view('userwishlist')->with('wishlistInfo',$wishlistInfo);
    }

    public function showwishlist()
    {
        $wishlistInfo = $this->wishlistService->showwishlist();
        return view('WishList')->with('wishlistInfo', $wishlistInfo);
    }



}





