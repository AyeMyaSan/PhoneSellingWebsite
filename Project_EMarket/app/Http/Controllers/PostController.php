<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\News;
use App\Contracts\Services\newsServiceInterface;
use App\Contracts\Services\productServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Services\orderServiceInterface;
use Validator;
use Charts;
use Datatables;
use App\Order;
use App\User;

class PostController extends Controller
{    
    public $newsService;
    public function __construct(newsServiceInterface $newsService,productServiceInterface $productService,UserServiceInterface $userService,orderServiceInterface $orderService ){
        $this->newsService=$newsService;
        $this->productService=$productService;
        $this->userService=$userService;
        $this->orderService=$orderService;
        
    }
    public function newsAdd(Request $request)
    {
         //dd($request);
        $validator=Validator::make($request->all(),[
            'news_title'=>'required',
            'news_category'=>'required',                  
            'news_detail'=>'required',
            'news_image'=>'required',
            
            ]);
            if ($validator->fails()) {
                return redirect(route('showNewsAdd'))
                ->withErrors($validator)
                ->withInput();
            }
   
            $image = $request->news_image;
            
            if (!empty($image)) {
                $imageName = rand(1111,9999).time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $request->news_image = $imageName;           
            }

            $this->newsService->newsAdd($request);
            return redirect()->route('news');
        }
        
        public function news()
        {
            return view('products.myNews');
        }
        
        public function newsList()
        {
            $newsData = News::join('users', 'users.id', '=', 'news.user_id')
            ->where('news.user_id', auth()->user()->id)
            ->orderBy('news.created_at','desc')
            ->get([
                'users.id', 'users.name','news.*'
                ]); 
            
                return DataTables::of($newsData)
                ->rawColumns(['news_image'],function($news){
                    $url=asset("images/$news->news_image"); 
                    return '<img src='.$url.' alt="news-image" />' ;
                })
                ->addIndexColumn()
                ->addColumn('news_category',function($news){
                    if($news->news_category == 'smartphone'){
                        return "Smart Phone";
                    }
                    else if($news->news_category == 'Tablet'){
                        return "Tablet";
                    }
                    else return "Laptop / PC";
                })
                ->addColumn('action', function ($news) {
                    return '<a href="/news/editshow/' . $news->id . '" class="btn btn-sm btn-success"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/delete/' . $news->id . '" class="btn btn-sm btn-danger" id="removeBtn"><i class="far fa-trash-alt"></i></a>';
                    
                })
                
                ->make(true);
            }
            
            
            public function AllNews()
            { 
                $newsInfo = $this->newsService->AllNews();
                return view('products.myNews')->with('newsInfo',$newsInfo);
            }
            
            public function newsEditShow($id)
            {
                $newsInfo = $this->newsService->newsEditShow($id);
                return view('products.newsEdit')->with('newsInfo', $newsInfo);  
            }
            public function newsUpdate(Request $request)
            { 
                $validator=Validator::make($request->all(),[
                    'news_title'=>'required',
                    'news_category'=>'required',                  
                    'news_detail'=>'required',
                    
                    ]);
                    if ($validator->fails()) {
                        return redirect(route('newsEditShow',$request->hiddenpostid))
                        ->withErrors($validator)
                        ->withInput();
                    }
                    
                    if (!empty($request->news_image)){     
                        $imageName = time().'.'.request()->news_image->getClientOriginalExtension();
                        request()->news_image->move(public_path('images'), $imageName);
                        $request->news_image = $imageName;
                    }
                    
                    
                    $this->newsService->newsUpdate($request);
                    return redirect()->route('news');
                    
                }
                
                public function newsDelete($id)
                {
                    $this->newsService->newsDelete($id);
                    return redirect()->route('news');
                    
                }
                
                
                public function showDashboard(){
                    $newsInfo = $this->newsService->recentNews();
                    $productInfo=$this->productService->recentItems();
                    $userInfo=$this->userService->Admins();
                    $cusInfo=$this->userService->Customers();
                    $count=count($cusInfo);
                    $orderInfo=$this->orderService->Orders();
                    $countOrder=count($orderInfo);
                    $saleInfo=$this->orderService->Sales();
                    $priceInfo=$this->orderService->Revenues();
                    
                    $mobile=$this->orderService->Mobile();
                    $totalPhoneAmount=0;
                    foreach ($mobile as $key=>$quantity){
                        $totalPhoneAmount+=$quantity['quantity'];
                    }
                    
                    $laptop=$this->orderService->Laptop();
                    $totalLaptopAmount=0;
                    foreach ($laptop as $key=>$quantity){
                        $totalLaptopAmount+=$quantity['quantity'];
                    }
                    
                    $tablet=$this->orderService->Tablet();
                    $totaltabletAmount=0;
                    foreach ($tablet as $key=>$quantity){
                        $totaltabletAmount+=$quantity['quantity'];
                    }
                    
                    
                    $chart = Charts::database(Order::all(), 'area', 'highcharts')
                    ->title('Daily Orders')
                    ->labels("Order")
                    ->dimensions(500, 400)
                    ->responsive(false)
                    ->lastByDay(7, true);
                    
                    $pie  =	 Charts::create('pie', 'highcharts')
                    ->title('Sale Rating')
                    ->labels(['Phone', 'Labtop', 'Tablet'])
                    ->values([ $totalPhoneAmount,$totalLaptopAmount,$totaltabletAmount])
                    ->dimensions(1000,500)
                    ->responsive(true);
                    
                    
                    
                    return view('Dashboard',compact('newsInfo','productInfo','userInfo','count','countOrder','saleInfo','priceInfo','pie','chart'));
                }
                public function showNewsAdd(){
                    return view('products.addNews');
                }
                public function showNewsList()
                {
                    $newsInfo = $this->newsService->showNewsList();
                    return view('newsList')->with('newsInfo', $newsInfo);
                }
                public function showNewsDetail($request)
                {
                    $newsInfo = $this->newsService->showNewsDetail($request);
                    return view('newsDetail')->with('newsInfo', $newsInfo);
                }
                
                
            }