<?php
namespace App\Http\Controllers;
use App\Product;
use App\Review;
use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\NewsServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Datatables;
use Validator;


class UserProductController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $productService;
    
    public function __construct(ProductServiceInterface $productService ,NewsServiceInterface $newsService)
    {
        $this->productService = $productService;
        $this->newsService = $newsService;
    }
    public function continue(){
        session()->forget('cart');
        $smpInfo=$this->productService->latestsmp();
        $labtopInfo=$this->productService->latestlab();
        $tabletInfo=$this->productService->latesttab();
        return view('welcome',compact('smpInfo','labtopInfo','tabletInfo'));
          }
    public function welcome(){
        $smpInfo=$this->productService->latestsmp();
        $labtopInfo=$this->productService->latestlab();
        $tabletInfo=$this->productService->latesttab();
        $newsInfo=$this->newsService->latestnews();
        return view('welcome',compact('smpInfo','labtopInfo','tabletInfo','newsInfo'));
    }
    
    public function showSmartPhone()
    {
        $productInfo = $this->productService->showSmartPhone();
        $brandInfo = $this->productService->getSmartPhoneBrand();
        $ramInfo = $this->productService->getSmartPhoneRAM();
        $priceInfo = $this->productService->getSmartPhonePrice();
        $productwish = $this->productService->wishproduct();

        return view('smartPhone', compact('productInfo', 'brandInfo', 'ramInfo', 'priceInfo', 'productwish'));
    }

    public function showTablet()
    {
        $productInfo = $this->productService->showTablet();
        $brandInfo = $this->productService->getTabletBrand();
        $ramInfo = $this->productService->getTabletRAM();
        $priceInfo = $this->productService->getTabletPrice();
        $productwish = $this->productService->wishproduct();

        return view('Tablet', compact('productInfo', 'brandInfo', 'ramInfo', 'priceInfo', 'productwish'));
        }

    public function showLaptop()
    {
        $productInfo = $this->productService->showLaptop();
        $brandInfo = $this->productService->getLaptopBrand();
        $ramInfo = $this->productService->getLaptopRAM();
        $priceInfo = $this->productService->getLaptopPrice();
        $productwish = $this->productService->wishproduct();

        return view('Laptop', compact('productInfo', 'brandInfo', 'ramInfo', 'priceInfo', 'productwish'));
    }
    public function showProductDetail($request)
    {
        $productInfo = $this->productService->showProductDetail($request); 
        $productwish = $this->productService->wishproduct();
        $reviewInfo = $this->productService->showReview($request);     
        return view('productDetail', compact('productInfo', 'reviewInfo','productwish'));
    }   
    public function addReview(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'rev_title'=>'required',                  
            'rev_msg'=>'required',
            
            ]);
            if ($validator->fails()) {
                return redirect(route('showProductDetail',$request->id))
                ->withErrors($validator)
                ->withInput();
            }        
            $this->productService->addReview($request);
            return redirect()->route('showProductDetail',$request->id)->with('success_msg','Your Review is pending... Please wait admin approvement');
        }   
        
        public function review()
    {
        return view('services.Review');
    }

    public function reviewList()
    {
        $reviewData = Review::join('users','users.id','=','review.user_id')
        ->orderBy('review.created_at','desc')
        ->select('review.*','users.name')
        ->get();

            return DataTables::of($reviewData)
            ->addIndexColumn()
            ->addColumn('status', function ($review) {
                if ($review->status == 0) {
                    return "Pending";
                } elseif ($review->status == 1) {
                    return "Confirmed";
                } elseif ($review->status == 2) {
                    return "Delivered";
                }
            })
            ->addColumn('action', function ($review) {
                return '<a href="/review/detail/' . $review->id . '"><i class="fa fa-eye"></i> View</a>';
            })
            
            ->make(true);
            
    }
    public function showReviewDetail($id)
    {
        $reviewInfo = $this->productService->showReviewDetail($id);
        return view('services.ReviewDetail', compact('reviewInfo', $reviewInfo));

    }

    public function updateRStatus($id,$status)
    {
        $review = $this->productService->updateRStatus($id,$status);
               if ($review) {
            return redirect()->route('review')->with('success_msg','Approved');
        } else {
            return redirect()->route('review')->with('fail_msg','Cannot be Approved!');
        }
                
    }
    public function reviewDel($id)
    {
        $this->productService->reviewDel($id);
        return redirect()->route('review');
    }  
    public function showProductCart()
    {
        return view('ProductCart');
    }
    
    public function contactUs(){
        return view('ContactUs');
    } 
    
    public function addToCart(Request $request)
    { 
        $rules=[
            'option'=>'required',
        ];
        function validateInteger($attribute, $value)
            {
                return filter_var($value, FILTER_VALIDATE_INT) !== false;
            }
            $customMessages = [
                'required' => 'The color field is required !!',
                           
            ];
            $this->validate($request, $rules, $customMessages);

        $productInfo = Product::find($request->id);
        abort_if(empty($productInfo), 404);
        $cart = array();
        $cart = session()->get('cart');
        $exitKey = null;
        $quantity = 1;
        
        if (!empty($cart)) {
            
            foreach ($cart as $key => $value){
                
                if($value['id'] == $request->id && $value['color'] == $request->option)
                {
                    $exitKey = $key;
                    
                    break;
                }

            }
        }
        
        $currentItem = [
            "id" => $request->id,
            "model" => $productInfo->model,
            "quantity" =>$quantity,
            "price" => $productInfo->price,
            "image" => $request->hiddenimg,
            "color" => $request->option,
            
        ];
        
        if (is_null($exitKey)){
            $cart[] = $currentItem;
        }
        else{
            $currentItem['quantity'] = $cart[$exitKey]['quantity']+1;
            $cart[$exitKey] = $currentItem;
        }
        session()->put('cart', $cart);
        return view('ProductCart');      
    }
    
    public function showUserForm(Request $request)
    {  
        $cart = session('cart');
        $product = $request->product;
        if($request->btn_edit_post == 'CheckOut'){
            $cart = array_map(function($item) use ($product){
                foreach($product as $p) {
                    if ($item['id'] == $p['id'] && $item['color'] == $p['color']) {
                        $item['quantity'] = $p['quantity'];
                    }
                }
                return $item;
            }, $cart);
            session()->put('cart', $cart);
            return redirect()->route('showFinalCheckout');
        }else{  
            
            if(isset($cart[$request->btn_edit_post])) {
                
                session()->forget('cart.'. $request->btn_edit_post);
              }
        }
        // return redirect()->back();
        return view('ProductCart');
      }

      public function showFinalCheckout(){
        return view('UserForm');
      }
      
      public function showProfile(){
          return view('services.profile');

    }

    public function changeImage(Request $request){
        
        $idsearch = $request->id;
        $csearch = $request->category;

        if($csearch == 's'){
            $img = \DB::table('product')
                    ->where('category', 's')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('image')
                    ->get();
            $clr = \DB::table('product')
                    ->where('category', 's')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('color')
                    ->get();
        }else if($csearch == 't'){
            $img = \DB::table('product')
                    ->where('category', 't')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('image')
                    ->get();
            $clr = \DB::table('product')
                    ->where('category', 't')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('color')
                    ->get();
        }else if($csearch == 'l'){
            $img = \DB::table('product')
                    ->where('category', 'l')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('image')
                    ->get();
            $clr = \DB::table('product')
                    ->where('category', 'l')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('color')
                    ->get();
        }

        foreach ($img as $key => $value) {
            foreach ($value as $values) {
                $imgStr = $values;
            }
        }
        foreach ($clr as $key => $value) {
            foreach ($value as $values) {
                $clrStr = $values;
            }
        }

        $imgArr = explode(', ',$imgStr);
        $clrArr = explode(',',$clrStr);

        $img_clr = array_merge($imgArr,$clrArr);
        
        return response()->json($img_clr);

    }

    public function changeColor(Request $request){
        
        $idsearch = $request->id;

        $img = \DB::table('product')
                    ->where('category', 's')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('image')
                    ->get();
        $clr = \DB::table('product')
                    ->where('category', 's')
                    ->where('id', 'LIKE', "%$idsearch%")
                    ->select('color')
                    ->get();

        foreach ($img as $key => $value) {
            foreach ($value as $values) {
                $imgStr = $values;
            }
        }
        foreach ($clr as $key => $value) {
            foreach ($value as $values) {
                $clrStr = $values;
            }
        }

        $clrArr = explode(',',$clrStr);
        $imgArr = explode(', ',$imgStr);

        $img_clr = array_merge($clrArr,$imgArr);
        
        return response()->json($img_clr);

    }

    
}