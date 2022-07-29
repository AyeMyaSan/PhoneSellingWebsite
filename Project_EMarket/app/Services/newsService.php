<?php
namespace App\Services;

use App\Contracts\Services\newsServiceInterface;
use App\Contracts\Dao\newsDaoInterface;

class newsService implements newsServiceInterface
{
    public $newsDao;
    /**
     * constructor function
     *
     * @param newsDaoInterface $newsDao
     */
    public function __construct(newsDaoInterface $newsDao)
    {
        $this->newsDao = $newsDao;
    }
    
    /**
     * add post
     *
     * @param Request $request
     * @return void
     */
    public function newsAdd($request)
    {  
        return $this->newsDao->newsAdd($request);
    }
    public function showMyNews()
    {
        return $this->newsDao->showMyNews();
    }
    public function AllNews()
    {
        return $this->newsDao->AllNews();
    }
    public function recentNews()
    {
        return $this->newsDao->recentNews();
    }
    

    public function newsUpdate($request)
    {
        $flag=$request->visibility;
        
        if($flag=="true")
        {
            $check=1;
        }
        else $check=0;
    $updateArray = [

        'news_title' => $request->news_title,
        'news_category' => $request->news_category,
        'news_detail' => $request->news_detail,
        'visibility'=>$check,
        'user_id' => auth()->user()->id,
 
    ];
    if (!empty($request->news_image)) {
    $updateArray['news_image'] = $request->news_image;
    }
    return $this->newsDao->newsUpdate($request->hiddenpostid, $updateArray);
    }

    public function newsEditShow($id)
    {
        return $this->newsDao->newsEditShow($id);
    }
    public function newsDelete($id)
    {
        return $this->newsDao->newsDelete($id);
    }
 
    public function showNewsList()
    {
        return $this->newsDao->showNewsList();
    }

    public function showNewsDetail($request)
    {
        return $this->newsDao->showNewsDetail($request);
    }
    public function latestnews()
    {
        return $this->newsDao->latestnews();
    }
    
}
