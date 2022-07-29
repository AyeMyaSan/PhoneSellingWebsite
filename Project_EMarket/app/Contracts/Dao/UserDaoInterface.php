<?php
namespace App\Contracts\Dao;

interface UserDaoInterface
{
    public function profileShow();
    public function profileUpdate($request);
    public function showCustomer();
    public function customerDelete($id);
    public function saveChange($userId,$updateArray);
    public function addNewUser($request);
    public function showEditUser($id);
    public function userUpdate($userId,$updateArray);
    public function Admins();
    public function Customers();






}