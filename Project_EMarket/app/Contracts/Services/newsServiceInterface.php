<?php
namespace App\Contracts\Services;

interface newsServiceInterface
{
    public function newsAdd($request);
    public function showMyNews();
    public function newsEditShow($id);
    public function newsDelete($id);
    public function newsUpdate($request);
    public function showNewsList();
    public function showNewsDetail($request);
    public function recentNews();
}