<?php
namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function profileShow();
    public function profileUpdate($request);
    public function showCustomer();
    public function customerDelete($id);
    public function saveChange($request);
    public function addNewUser($request);
    public function showEditUser($id);
    public function userUpdate($request);
    public function Admins();
    public function Customers();
}