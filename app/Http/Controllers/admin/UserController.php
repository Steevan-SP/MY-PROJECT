<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
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
                        'id_number'=>$data['id_number'],
                        'phone'=>$data['phone'],
                        'epfnumber'=>$data['epfnumber'],
                        
                    ]);
                        // dd($data['role_id']);
                    if ($data['role_id'] == 1){
                        Admin::create([
                            'user_id'=>$user->id,
                            'firstname'=>$data['firstname'],
                            'lastname'=>$data['lastname'],
                            'address'=>$data['address'],
                            'landline'=>$data['landline'],
                            
                        
                        ]);

                    } else {
                        Receptionist::create([
                            'user_id'=>$user->id,
                            'firstname'=>$data['firstname'],
                            'lastname'=>$data['lastname'],
                            'address'=>$data['address'],
                            'landline'=>$data['landline'],
                        
                      ]);
                  }
          
                  return redirect()->route('user.index',)->with('success', 'User has been created Successfully!');
            }

            public function edit(User $user){
                    
                $roles = Role::all();
                return view('admin.user.edit',compact('roles','user'));
            }  

            public function update(User $user, UserUpdateRequest $request)
{
    $data = $request->validated();

    if ($request->input('password')) {
        $data['password'] = Hash::make($request->input('password'));
    } else {
        $data['password'] = $user->password;
    }

    if ($data['role_id'] != $user->role_id) {
        if ($user->role_id == 1) {
            $admin=Admin::where('user_id', $user->id)->first();
                $admin->delete();
                Receptionist::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'address' => $data['address'],
                    'landline' => $data['landline'],
                    'user_id' => $user->id,
                ]);
            }else
            {
                $receptionist=Receptionist::where('user_id', $user->id)->first();
                $receptionist->delete();
                Admin::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'address' => $data['address'],
                    'landline' => $data['landline'],
                    'user_id' => $user->id,
                ]);
            }
        }else {

            if ($data['role_id'] == 2) {
                $receptionist = Receptionist::where('user_id', $user->id)->first();
                
                $updateData = [
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'address' => $data['address'],
                    'landline' => $data['landline'],
                    
                ];
            
                $receptionist->update($updateData);
            }
            
            if ($data['role_id'] == 1) {
                $admin = Admin::where('user_id', $user->id)->first();
            
                $updateData = [
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'address' => $data['address'],
                    'landline' => $data['landline'],
                
                ];
            
                $admin->update($updateData);
            }
            
            
        }
        $user->update([
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'password' => $data['password'],
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'epfnumber' => $data['epfnumber'],
        ]);

        return redirect()->route('user.index')->with('updated', 'User details have been updated successfully!');
    
            }
                
            public function show(User $user){
                dd($user);
                return view('admin.user.show',compact('user'));
            }

            public function delete(User $user){
                //dd($user);
                return view('admin.user.delete',compact('user'));
            }
        
            public function destroy(User $user){
        
                $user->delete();
                return redirect()->route('user.index')->with('success', 'user details has been deleted successfuly!');
            }
    }

