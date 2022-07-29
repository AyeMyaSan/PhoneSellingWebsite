<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\productServiceInterface;
use Validator;
use App\Product;
use Datatables;
class ProductController extends Controller
{    
    
    public $productService;
    public function __construct(productServiceInterface $productService){
        $this->productService=$productService;
    }
    
    
    public function addProduct(Request $request)
    {
        function formatInput()
        {
            $input = array_map('trim', $this->all());
            $input['price'] = (int) ($input['price']);
            
            $this->replace($input);
            return $this->all();
        }
        
        $rules = [
            'model' => 'required',
            'brand' => 'required',
            'screensize' => 'required',
            'resolution' => 'required',
            'cpu' => 'required',
            'gpu' => 'required',
            'os' => 'required',
            'ram' => 'required',
            'memory' => 'required',
            'camera' => 'required',
            'model' => 'required',
            'battery' => 'required',
            'color' =>'required',
            'image' =>'required|array|min:1',
            'price' => 'required|integer|min:1'];
            
            function validateInteger($attribute, $value)
            {
                return filter_var($value, FILTER_VALIDATE_INT) !== false;
            }
            $customMessages = [
                'required' => 'The :attribute field can not be blank !!',
                'clr.required' => 'The color can\'t be blank !! You should check at least one color !!',
                'image.required' => 'The image can\'t be blank !! You should have at least an image !!',             
            ];
            $this->validate($request, $rules, $customMessages);
            
            $images = $request->image;
            $img = array();
            foreach($images as $key=>$value){
                // dd($value);     
                if (!empty($value)) {
                    $imageName = rand(1111,9999).time() . '.' . $value->getClientOriginalExtension();
                    $value->move(public_path('images'), $imageName);
                    $img[] = $imageName;
                    // $image = json_encode($images);
                    // dd($images);
                }
            }
            // dd($img);
            $image = implode(', ', array_values($img));           
            
            $this->productService->addProduct($request,$image);
            return redirect()->route('showMyProduct');
        }
        
        
        public function showMyProduct()
        {
            return view('products.myProduct');
        }
        
        public function productList()
        {
            $productData = product::join('users', 'users.id', '=', 'product.user_id')
            ->where('product.user_id', auth()->user()->id)
            ->orderBy('product.created_at','desc')
            ->get([
                'users.id', 'users.name', 'product.*'
                ]); 
                
                
                foreach($productData as $key=>$value){
                    $arrImg = $value->image;
                    $img = explode(',',$arrImg);
                    $firstImage = $img[0];
                }
                //dd($firstImage);
                return DataTables::of($productData)
                ->rawColumns(['image'],function($product){ 
                    $url=asset("images/$firstImage"); 
                    return '<img src='.$url.' alt="product-image" />' ;
                })
                ->addIndexColumn()
                ->addColumn('category',function($product){
                    if($product->category == 's'){
                        return "Smart Phone";
                    }
                    else if($product->category == 't'){
                        return "Tablet";
                    }
                    else return "Laptop / PC";
                })
                ->addColumn('action', function ($product) {
                    return '<a href="/prodcut/editshow/' . $product->id . '" class="btn btn-sm btn-success"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/product/delete/' . $product->id . '" class="btn btn-sm btn-danger" id="removeBtn"><i class="far fa-trash-alt"></i></a>';
                    
                })
                
                ->make(true);
            }
            
            
            
            public function productEditShow($id)
            {
                $productInfo = $this->productService->productEditShow($id);
                return view('products.productEdit')->with('productInfo', $productInfo);  
            }
            
            public function productUpdate(Request $request)
            {    
                function formatInput()
                {
                    $input = array_map('trim', $this->all());
                    $input['price'] = (int) ($input['price']);
                    
                    $this->replace($input);
                    return $this->all();
                }
                $rules = [
                    'model' => 'required',
                    'brand' => 'required',
                    'screensize' => 'required',
                    'resolution' => 'required',
                    'cpu' => 'required',
                    'gpu' => 'required',
                    'os' => 'required',
                    'ram' => 'required',
                    'memory' => 'required',
                    'camera' => 'required',
                    'model' => 'required',
                    'battery' => 'required',
                    'color' =>'required',
                    'price' => 'required|integer|min:1'];
                    
                    function validateInteger($attribute, $value)
                    {
                        return filter_var($value, FILTER_VALIDATE_INT) !== false;
                    }
                    $customMessages = [
                        'required' => 'The :attribute field can not be blank !!',
                        'clr.required' => 'The color can\'t be blank !! You should check at least one color !!',                    'memory.required' => 'We need your email address also',
                        'message.required' => 'c\'mon, you want to contact me without saying anything?',
                    ];
                    $this->validate($request, $rules, $customMessages);
                     //dd($request);
                    if($request->hasFile('image') != false ){
                        $images = $request->file('image');
                    $img = array();
                    foreach($images as $key=>$value){
                    if (!empty($value)) {
                        $imageName = rand(1111,9999).time() . '.' . $value->getClientOriginalExtension();
                        $value->move(public_path('images'), $imageName);
                        $img[] = $imageName;
                        }
                    }
                    $image = implode(', ', array_values($img)); 
                    }else{
                        $imgs = $request->image;
                        $img = explode(", ",$imgs);
                    $img = array();
                    foreach($img as $key=>$value){
                        if (!empty($value)) {
                        $imageName = rand(1111,9999).time() . '.' . $value->getClientOriginalExtension();
                        $value->move(public_path('images'), $imageName);
                        $img[] = $imageName;
                        }
                    }
                    $image = implode(', ', array_values($img)); 
                    } 
                    
                    $this->productService->productUpdate($request,$image);
                    return redirect()->route('showMyProduct');
                }
                
                
                public function productDelete($id)
                {
                    $this->productService->productDelete($id);
                    return redirect()->route('showMyProduct');
                }
                public function showProductAdd(){
                    return view('products.addProduct');
                }
                
            }
            