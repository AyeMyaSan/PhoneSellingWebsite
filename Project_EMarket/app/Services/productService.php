<?php
namespace App\Services;
use App\review;
use App\Contracts\Services\productServiceInterface;
use App\Contracts\Dao\productDaoInterface;

class productService implements productServiceInterface
{
    public $productDao;
    
    public function __construct(productDaoInterface $productDao)
    {
        $this->productDao = $productDao;
    }
    
    public function postAddShow()
    {
        return view('product.addProduct');
    }

    public function addProduct($request,$image)
    {
        return $this->productDao->addProduct($request,$image);
    }

    public function showMyProduct()
    {
        return $this->productDao->showMyProduct();
    }
    public function recentItems()
    {
        return $this->productDao->recentItems();
    }
    
    public function showSmartPhone()
    {
        return $this->productDao->showSmartPhone();
    }

    public function getSmartPhoneBrand()
    {
        return $this->productDao->getSmartPhoneBrand();
    }

    public function getSmartPhoneRAM()
    {
        return $this->productDao->getSmartPhoneRAM();
    }

    public function getSmartPhonePrice()
    {
        return $this->productDao->getSmartPhonePrice();
    }

    public function wishproduct()
    {
        return $this->productDao->wishproduct();
    }

    public function showTablet()
    {
        return $this->productDao->showTablet();
    }

    public function getTabletBrand()
    {
        return $this->productDao->getTabletBrand();
    }

    public function getTabletRAM()
    {
        return $this->productDao->getTabletRAM();
    }

    public function getTabletPrice()
    {
        return $this->productDao->getTabletPrice();
    }

    public function showLaptop()
    {
        return $this->productDao->showLaptop();
    }

    public function getLaptopBrand()
    {
        return $this->productDao->getLaptopBrand();
    }

    public function getLaptopRAM()
    {
        return $this->productDao->getLaptopRAM();
    }

    public function getLaptopPrice()
    {
        return $this->productDao->getLaptopPrice();
    }
    
    public function showProductDetail($request)
    {
        return $this->productDao->showProductDetail($request);
    }
    
    public function productEditShow($id)
    {
     return $this->productDao->productEditShow($id);
    }
    
    public function productUpdate($request,$image)
    { 
        $flag=$request->visibility;
        
        if($flag=="true")
        {
            $check=1;
        }
        else $check=0;
        $updateArray = [
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
                        'other_feactures'=>$request->feactures,
                        'price'=>$request->price,
                        'visibility'=>$check,
                        'user_id'=> auth()->user()->id
        ];
        if (!empty($image)) {
            $updateArray['image'] = $image;
        }
        return $this->productDao->productUpdate($request->hiddenproductid, $updateArray);
    }
    
    public function productDelete($id)
    {
        return $this->productDao->productDelete($id);
    }

    public function getProduct()
    {
        return $this->productDao->getProduct();
    }
    public function addreview($request)
    {
        // dd($request);
        return $this->productDao->addreview($request);
        
    }
    public function showReviewDetail($request)
    { 
        return $this->productDao->showReviewDetail($request);
    }
    public function updateRStatus($id,$status)
     {
        return $this->productDao->updateRStatus($id,$status);
    }
    public function reviewDel($request)
{
    
    return $this->productDao->reviewDel($request);
}


    public function showreview($request)
    {
        return $this->productDao->showreview($request);
    }
    public function latestsmp()
    {
        return $this->productDao->latestsmp();
    }

    public function latestlab()
    {
        return $this->productDao->latestlab();
    }

    public function latesttab()
    {
        return $this->productDao->latesttab();
    }

    
}
