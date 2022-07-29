<?php
namespace App\Dao;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Dao\UserDaoInterface;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserDao implements UserDaoInterface
{  
    public function profileShow()
    {
        $user_info = User::find(auth()->user()->id);
        return $user_info;
    }
    public function profileUpdate($request)
    { 
        $user = User::find(auth()->user()->id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password))
        {
            $user->password =$request->password;  
        }

        return $user->save();
    }

    
    public function showCustomer()
    {
        $userInfo = User::select('id','name', 'email','role')->get();
        return $userInfo; 
    }
    public function Admins()
    {
        $userInfo = User::select('id','name', 'email')
        ->where('role','1')
        ->get();
        return $userInfo; 
    }
    public function Customers()
    {
        $cusInfo = User::select('id','name', 'email')
        ->where('role','2')
        ->get();
        return $cusInfo; 
    }
    public function customerDelete($id)
    {  
        $userInfo = User::where('id', $id)
        -> delete();
    }
    public function saveChange($userId,$updateArray)
    {   
        User::where('id', $userId)
        ->update($updateArray);
    }
    public function addNewUser($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
            ]);
            
        }
        public function showEditUser($id)
        {
            $userInfo = User::find($id);
            return $userInfo;
            
        }
        public function userUpdate($userId,$updateArray)
        {   
            User::where('id', $userId)
            ->update($updateArray);
        }
        public function RecentData()
        {
            $userInfo=User::join('news','news.user_id','=','users.id' )
            ->join('product','product.user_id','=','users.id')
            ->orderBy('users.created_at','desc')
            ->select(['users.*','news.news_detail','product.id','product.model','product.price'])
            ->get();
            return $userInfo;
        }
    }
    