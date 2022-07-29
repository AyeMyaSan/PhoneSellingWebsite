<?php
namespace App\Contracts\Dao;

interface newsDaoInterface
{
    public function newsAdd($request);
    public function showMyNews();
    public function newsEditShow($id);
    public function newsUpdate($nId,$updateArray);
    public function newsDelete($id);
    public function showNewsList();
    public function showNewsDetail($request);
    public function recentNews();

}
?>