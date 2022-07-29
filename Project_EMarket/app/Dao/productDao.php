<?php
namespace App\Dao;
use App\Contracts\Dao\productDaoInterface;
use App\Contracts\Services\productServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Review;

class productDao implements productDaoInterface{
    
    public function addProduct($request, $image)
    {   
        //  dd($request,$image);
        $flag=$request->visibility;
        
        if($flag=="true")
        {
            $check=1;
        }
        else $check=0;
        product::create([
            'model'=>$request->model,
            'category'=>$request->category,
            'brand'=>$request->brand,
            'screensize'=>$request->screensize,
            'resolution'=>$request->resolution,
            'cpu'=>$request->cpu,
            'gpu'=>$request->gpu,
            'os'=>$request->os,
            'ram'=>$request->ram,
            'memory'=>$request->memory,
            'camera'=>$request->camera,
            'battery'=>$request->battery,
            'color'=>$request->color,
            'image'=>$image,
            'visibility'=>$check,
            'other_feactures'=>$request->feactures,
            'price'=>$request->price,
            'user_id'=> auth()->user()->id,
            ]);
        }
        public function showMyProduct()
    {
        $productInfo = product::join('users', 'users.id', '=', 'product.user_id')
                        ->orderBy('product.created_at','desc')
                        ->get([
                            'users.id', 'users.name', 'product.*'
                        ]);   
               
        return $productInfo; 
    }
    public function recentItems()
    {
        $productInfo = product::select('id','model', 'price')
        ->orderBy('created_at','desc')->take(4)
        ->get();   
        return $productInfo; 
    }
    

    public function showSmartPhone()
    {
        $productInfo = product::where('category', 's')
                        ->where('visibility', 'true')
                        ->orderBy('product.created_at','desc')
                        ->get('product.*');                             
        return $productInfo; 
    }

    public function getSmartPhoneBrand()
    {
        $brandInfo = \DB::table('product')->where('category','s')->groupBy('brand')->pluck('brand')->prepend('all','');  //prepend('','value')                   

        return $brandInfo;
    }

    public function getSmartPhoneRAM()
    {
        $ramInfo = \DB::table('product')->where('category','s')->groupBy('ram')->pluck('ram')->prepend('all',''); 
                            
        return $ramInfo; 
    }

    public function getSmartPhonePrice()
    {
        $priceInfo = \DB::table('product')->where('category','s')->groupBy('price')->pluck('price'); 
                            
        return $priceInfo; 
    }

    public function wishproduct()
    {
       if (Auth::check()) {
                          
       $productwish = product::join('wishlist', 'product.id', '=', 'wishlist.p_id')
       ->where('wishlist.user_id', auth()->user()->id)
       ->orderBy('product.created_at', 'desc')
       ->get('wishlist.p_id');
   //   dd($productwish);
       return $productwish; 
       }
   }

    public function showTablet()
    {
        $productInfo = product::where('category', 't')
                        ->orderBy('product.created_at','desc')
                        ->get('product.*');                             
        return $productInfo; 
    } 

    public function getTabletBrand()
    {
        $brandInfo = \DB::table('product')->where('category','t')->pluck('brand')->prepend('all','');                   
        return $brandInfo;
    }

    public function getTabletRAM()
    {
        $ramInfo = \DB::table('product')->where('category','t')->pluck('ram')->prepend('all',''); 
                            
        return $ramInfo; 
    }

    public function getTabletPrice()
    {
        $priceInfo = \DB::table('product')->where('category','t')->pluck('price');
                            
        return $priceInfo; 
    }

    public function showLaptop()
    {
        $productInfo = product::where('category', 'l')
                        ->orderBy('product.created_at','desc')
                        ->get('product.*');                             
        return $productInfo; 
    }

    public function getLaptopBrand()
    {
        $brandInfo = \DB::table('product')->where('category','l')->pluck('brand')->prepend('all','');                    
        return $brandInfo;
    }

    public function getLaptopRAM()
    {
        $ramInfo = \DB::table('product')->where('category','l')->pluck('ram')->prepend('all','');
                            
        return $ramInfo; 
    }

    public function getLaptopPrice()
    {
        $priceInfo = \DB::table('product')->where('category','l')->pluck('price');
                            
        return $priceInfo; 
    }

    public function showProductDetail($id)
    {
        $productInfo = product::find($id);                            
        return $productInfo; 
    }
   
    public function productEditShow($id)
            {
                $productInfo = Product::find($id);
                return $productInfo;
                
            }
    
    public function productUpdate($pId,$updateArray)
    {
        //dd($pId,$updateArray);
        Product::where('id', $pId)
                ->update($updateArray);
    }
    
    public function productDelete($id)
    {
        $img = product::where('id', $id)->pluck('image');
        
        // if (!empty($img)) {
        //     $oldImage = $img[0]->image;
        //     $file_path = public_path("images/$oldImage");
           
        // }
        $productInfo = product::where('id', $id)
                        -> delete();
    }
    
    
   
    public function getProduct()
    {
        $productInfo = product::join('users', 'users.id', '=', 'product.user_id')
        ->orderBy('product.created_at','desc')
        ->get(['users.id', 'users.name', 'product.*']); 
        return $productInfo;
    }

    public function getProductById($id){
        $productInfo=product::where('id',$id)->first();
        return $productInfo;
    }
    public function addReview($request)
    {
           

         $id=$request->id;
         
            review::create([
            'user_id' => auth()->user()->id,
            'p_id' => $id,
            'rev_rating'=>$request->rev_rating,
            'rev_title' => $request->rev_title,
            'rev_msg' => $request->rev_msg,
            'status'=>'0',
            'created_at' => date('Y-m-d H:i:s'),
            ]);

            
        }
        public function showReviewDetail($id)
        { 
            $reviewInfo = review::join('users', 'users.id', '=', 'review.user_id')
            ->join('product', 'product.id', '=', 'review.p_id')
            ->orderBy('review.created_at', 'desc')
            ->where('review.id', $id)
            ->select(['review.*', 'product.model', 'product.price', 'product.image', 'product.ram', 'product.memory','users.name', 'users.email'])
            ->get();
            //dd($reviewInfo);
            return $reviewInfo; 
            
        }
        public function updateRStatus($id,$status)
        {
            $update=(int)$status;
           
            $review = review::where('id', $id)->update(['status' => $update]);
            return $review;
        }


        public function showreview($id)
        {
            $id = (int)$id;
            $reviewInfo = review::join('product', 'product.id', '=', 'review.p_id')
            ->join('users', 'users.id', '=', 'review.user_id')
            -> where('review.p_id',$id)
            -> where('review.status','1')
            ->orderBy('review.created_at', 'desc')
            ->select(['review.id','review.rev_title','rev_rating','rev_msg','users.name'])
             ->get();   
                      
            return $reviewInfo; 
        }

        public function reviewDel($request)
        {
            $reviewInfo = review::where('id', $request)
                            -> delete();
        }

    public function latestsmp()
    {
        // $smpInfo = product::select('id','brand','model', 'price','image')
        // ->where('category', 's')
        // ->orderBy('created_at','desc')->take(3)
        // ->get();   
        // return $smpInfo; 
        $smpInfo = product::where('category', 's')
        ->where('visibility', 'true')
                        ->orderBy('product.created_at','desc')
                        ->get('product.*');                             
        return $smpInfo; 
    }

    public function latestlab()
    {
        $labtopInfo = product::select('id','brand','model', 'price','image')
        ->where('category', 't')
        ->where('visibility', 'true')
        ->orderBy('created_at','desc')->take(3)
        ->get();   
        return $labtopInfo; 
    }

    public function latesttab()
    {
        $tabletInfo = product::select('id','brand','model', 'price','image')
        ->where('category', 'l')
        ->where('visibility', 'true')
        ->orderBy('created_at','desc')->take(3)
        ->get();   
        return $tabletInfo; 
    }
}