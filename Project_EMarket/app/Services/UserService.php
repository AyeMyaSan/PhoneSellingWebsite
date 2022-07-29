<?php
namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Dao\UserDaoInterface;
use Mail;

class UserService implements UserServiceInterface
{
    public $userDao;
    
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }
    public function basic_email($request) {
        $data = array('name'=>$request->name, 'email'=>$request->email);
        Mail::send('services.ContactMail', ['data'=>$data,'request'=>$request], function($message) use($data,$request) {
           $message->to('thinthinmoe.bcsc@gmail.com', 'Thinn Thinn Moe')
                    ->from($request->email,$request->name)
                    ->subject($request->subject);
        });
        return back();
       
    }
    
    public function profileShow()
    {
        return $this->userDao->profileShow();
    }

    public function showCustomer()
    {
        return $this->userDao->showCustomer();
    }
    public function Admins()
    {
        return $this->userDao->Admins();
    }
    public function Customers()
    {
        return $this->userDao->Customers();
    }

    public function customerDelete($id)
    {
        return $this->userDao->customerDelete($id);
    }
    
    public function saveChange($request)
    {
    $updateArray = [
        'name' => $request->name,
        'email' => $request->email,
        'role'=>'1',
        'password' =>bcrypt($request->password),
    ];
    
    return $this->userDao->saveChange($request->hiddenuserid, $updateArray);
    }

    public function showAddUser()
    {
        return $this->userDao->showAddUser();
    }
    public function addNewUser($request)
    {
        return $this->userDao->addNewUser($request);
    }
    public function showEditUser($id)
    {
        return $this->userDao->showEditUser($id);
    }
    public function userUpdate($request)
    {
    $updateArray = [

        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' =>bcrypt($request->password),
    ];
    return $this->userDao->userUpdate($request->hiddenuserid, $updateArray);
    }
    public function RecentData()
    {
        return $this->userDao->RecentData();
    }
    public function profileUpdate($request)
    {
        return $this->userDao->profileUpdate($request);
    }


}
