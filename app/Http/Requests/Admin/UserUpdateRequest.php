<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = $this->user;
        //dd($this);
        if($this->role_id == 1){
            return[
                'role_id'   =>'required',
                'firstname' =>'required',
                'lastname'  =>'required',
                'email'     => ['required', 'email',Rule::unique('users')->ignore($user)],
                'password'  => 'required| string | min:8',
                'address'   => 'required',
                'id_number' => ['required' ,'max:12',Rule::unique('users')->ignore($user)],
                'phone'     => ['required ',' max:12',Rule::unique('users')->ignore($user)],
                'landline'  => 'nullable | max:12',
                'epfnumber' => ['required',' max:4',Rule::unique('users')->ignore($user)],
        ];}
        else{
            return [
                'role_id'   =>'required',
                'firstname' =>'required',
                'lastname'  =>'required',
                'email'     => ['required ', 'email',Rule::unique('users')->ignore($user)],
                'password'  => 'required| string | min:8',
                'address'   => 'required',
                'id_number' => ['required','max:12',Rule::unique('users')->ignore($user)],
                'phone'     => ['required' ,'max:12',Rule::unique('users')->ignore($user)],
                'landline'  => 'nullable | max:12',
                'epfnumber' => ['required' ,'max:4',Rule::unique('users')->ignore($user)],
            ];}
    }
}

