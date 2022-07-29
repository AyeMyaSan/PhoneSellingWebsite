<?php
namespace App\Dao;

use App\Contracts\Dao\newsDaoInterface;
use App\News;

class newsDao implements newsDaoInterface
{
    
    public function newsAdd($request)
    {  
        //    dd($request);
        //  dd($request,$image);
        $flag=$request->visibility;
        
        if($flag=="true")
        {
            $check=1;
        }
        else $check=0;
        News::create([
            'news_title' => $request->news_title,
            'news_category' => $request->news_category,
            'news_detail' => $request->news_detail,
            'news_image' =>$request->news_image,
            'visibility'=>$check,
            'user_id' => auth()->user()->id,
            ]);
            
        }
        public function showMyNews()
        {
            $newsInfo = News::join('users', 'users.id', '=', 'news.user_id')
            ->where('news.user_id', auth()->user()->id)
            ->orderBy('news.created_at', 'desc')
            ->get([
                'users.id', 'users.name', 'news.*',
                ]);
                
                return $newsInfo;
            }
            public function AllNews()
            {
                $newsInfo = News::join('users', 'users.id', '=', 'news.user_id')
                ->orderBy('news.created_at', 'desc')
                ->get([
                    'users.id', 'users.name', 'news.*',
                    ]);
                    
                    return $newsInfo;
                }
                public function recentNews()
                {
                    $newsInfo = News::join('users', 'users.id', '=', 'news.user_id')
                    ->orderBy('id','desc')->take(2)
                    ->get([
                        'users.name', 'news.id','news.news_title','news.news_detail',
                        ]);
                        return $newsInfo; 
                        
                        
                    }
                    
                    public function newsEditShow($id)
                    {
                        $newsInfo = News::find($id);
                        return $newsInfo;
                        
                    }
                    
                    public function newsUpdate($nId,$updateArray)
                    {   
                        News::where('id', $nId)
                        ->update($updateArray);
                    }
                    
                    public function newsDelete($id)
                    {
                        $newsInfo = News::where('id', $id)
                        ->delete();
                    }
                    
                    public function showNewsList()
                    {
                        $newsInfo = News::join('users', 'users.id', '=', 'news.user_id')
                        ->where('visibility', 'true')
                        ->orderBy('news.created_at', 'desc')
                        ->get([
                            'users.id', 'users.name', 'news.*',
                            ]);
                            
                            return $newsInfo;
                        }
                        public function showNewsDetail($id)
                        {
                            $newsInfo = News::find($id);                            
                            return $newsInfo; 
                        }
                        public function latestnews()
                        {
                            $newsInfo = News::where('visibility', 'true')
                            ->orderBy('created_at','desc')->take(3)
                            ->get('news.*');   
                            return $newsInfo; 
                            
                        }
                        
                        
                    }
                    