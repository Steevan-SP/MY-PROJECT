<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->role_id == 1){
            
            return[
            'role_id'   =>'required',
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required| string | min:8',
            'address'   => 'required',
            'id_number' =>'required | max:12 |unique:users',
            'phone'     => 'required | max:12 |unique:users',
            'landline'  => 'nullable | max:12',
            'epfnumber' => 'required| min:4 |unique:users'

                    ];
                                }
    return[
            'role_id'   =>'required',
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required | string | min:8',
            'address'   => 'required',
            'id_number' =>'required | max:12 |unique:users',
            'phone'     => 'required | max:12 |unique:users',
            'landline'  => 'nullable | max:12',
            'epfnumber' => 'required| min:4 |unique:users'

                ];
            }
}
