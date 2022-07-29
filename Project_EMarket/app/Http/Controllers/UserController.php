<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\UserServiceInterface;
use Validator;
use App\User;
use Charts;
use Datatables;

class UserController extends Controller
{
    public $user_service;
    /**
    * constructor function
    *
    * @param UserServiceInterface $user_service
    */
    public function __construct(UserServiceInterface $user_service)
    {
        $this->user_service = $user_service;
    }
    
    /**
    * show user profile form
    *
    * @return view
    */
    public function profileShow()
    {
        $user_info = $this->user_service->profileShow();
        return view('myaccindex')->with('user_info',$user_info);
    }
    
    public function showCustomer()
    {
        
        return view('services.customer');
    } 
    public function customerList()
    {
        $userData =  $userInfo = User::select('id','name', 'email','role')
        ->orderBy('users.created_at','desc')
        ->get();
        

            return DataTables::of($userData)
            ->addIndexColumn()
            ->addColumn('role',function($user){
                if($user->role == '1'){
                    return "Admin";
                }
                else return "Customer";
            })
            ->addColumn('action', function ($user) {
                return '<a href="/userdata/editshow/' . $user->id . '" class="btn btn-sm btn-success"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/delete/customer/' . $user->id . '" class="btn btn-sm btn-danger" id="removeBtn"><i class="far fa-trash-alt"></i></a>';
                
            })
            
            ->make(true);
        }
    
    
    public function customerDelete($id)
    { 
        $this->user_service->customerDelete($id);
        return redirect()->route('showCustomer');
        
        
    }
    public function saveChange(Request $request)
    {   
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',                  
            'password'=>'required',
            'password_confirmation'=>'required',
            ]);
            if ($validator->fails()) {
                return redirect(route('showProfile'))
                ->withErrors($validator)
                ->withInput();
            }
            $this->validate($request, [
                'password' => 'min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8'
                ]);                      
                
                $this->user_service->saveChange($request);
                return redirect()->route('home');
            }
            
            public function showAddUser()
            {
                return view('services.addUser');
            } 
            
            public function addNewUser(Request $request)
            {
                $validator=Validator::make($request->all(),[
                    'role'=>'required',
                    'name'=>'required',                  
                    'email'=>'required',
                    'password'=>'required',
                    'password_confirmation'=>'required',
                    
                    ]);
                    if ($validator->fails()) {
                        return redirect(route('showAddUser'))
                        ->withErrors($validator)
                        ->withInput();
                    }
                    $this->validate($request, [
                        'password' => 'min:8',
                        'password_confirmation' => 'required_with:password|same:password|min:8'
                        ]); 
                        
                        $this->user_service->addNewUser($request);
                        return redirect()->route('showCustomer');
                    }
                    public function showEditUser($id)
                    {
                        $userInfo = $this->user_service->showEditUser($id);
                        return view('services.editUser')->with('userInfo', $userInfo);  
                    }
                    public function userUpdate(Request $request)
                    { 
                        $validator=Validator::make($request->all(),[
                            'role'=>'required',
                            'name'=>'required',                  
                            'email'=>'required',
                            'password'=>'required',
                            'password_confirmation'=>'required',
                            
                            ]);
                            if ($validator->fails()) {
                                return redirect(route('showEditUser',$request->hiddenuserid))
                                ->withErrors($validator)
                                ->withInput();
                            }
                            $this->validate($request, [
                                'password' => 'min:8',
                                'password_confirmation' => 'required_with:password|same:password|min:8'
                                ]);
                                
                                $this->user_service->userUpdate($request);
                                return redirect()->route('showCustomer');
                                
                            }
                          
                            public function contact(Request $request)
                            {
                                $validator=Validator::make($request->all(),[
                                    'name'=>'required',
                                    'email'=>'required',                  
                                    'subject'=>'required',
                                    'message'=>'required',                                    
                                    ]);
                                    if ($validator->fails()) {
                                        return redirect(route('contactUs'))
                                        ->withErrors($validator)
                                        ->withInput();
                                    }
                                $sendMail = $this->user_service->basic_email($request);
                                return redirect()->route('contactUs')->with('success_msg','Well done! You successfully send this important message.!');
                                
                            }
                            
                            public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'email|required|max:120|unique:users,email,' .auth()->user()->id,
            'password' => 'confirmed'
            ]);
            
            if ($validator->fails()) {
                return redirect(route('profileShow'))
                ->withErrors($validator)
                ->withInput();
            }
            
            $updated = $this->user_service->profileUpdate($request);
            if ($updated){
                return redirect()->route('showSmartPhone');
            } else {
                return redirect()->route('profileShow');
            }
        }
                        
                        }
                        
                        