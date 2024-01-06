<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\Admin\UserStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Receptionist;



class UserController extends Controller

{
    
        public function index(){
            $users=User::all();
            return view('admin.user.index',compact('users'));
        }

       
            public function create(){

               
                $roles = Role::all();
                return view('admin.user.create',compact('roles'));
                // dd(1);
            
            }

            public function store(UserStoreRequest $request){
              
                $data = $request->validated();

                        //   dd($data);
                      $user=User::create([
                        'role_id'=>$data['role_id'],
                        'email' => $data['email'],
                        'password' =>Hash::make($data['password']),
                    ]);
                        // dd($data['role_id']);
                    if ($data['role_id'] == 1){
                        Admin::create([
                            'user_id'=>$user->id,
                            'firstname'=>$data['firstname'],
                            'lastname'=>$data['lastname'],
                            'address'=>$data['address'],
                            'id_number'=>$data['id_number'],
                            'phone'=>$data['phone'],
                            'landline'=>$data['landline'],
                            'epfnumber'=>$data['epfnumber'],
                        
                        ]);

                    } else {
                        Receptionist::create([
                            'user_id'=>$user->id,
                            'firstname'=>$data['firstname'],
                            'lastname'=>$data['lastname'],
                            'address'=>$data['address'],
                            'id_number'=>$data['id_number'],
                            'phone'=>$data['phone'],
                            'landline'=>$data['landline'],
                            'epfnumber'=>$data['epfnumber'],
                        
                      ]);
                  }
          
                  return redirect()->route('user.index',)->with('success', 'User has been created Successfully!');
            }

            public function edit(User $user){

                $roles = Role::all();
                return view('admin.user.edit',compact('users'));
            }
        



            
    }

