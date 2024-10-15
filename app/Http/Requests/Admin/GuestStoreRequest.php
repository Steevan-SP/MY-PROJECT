<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GuestStoreRequest extends FormRequest
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
        //dd($this->all());
        if ($this->guest_type == 'local') {
            return [
                'guest_type'     => 'required',
                'title'          => 'required',
                'guestfirstname' => 'required',
                'guestlastname'  => 'required',
                'addressline1'   => 'required',
                'addressline2'   => 'nullable',
                'city'           => 'required',
                'phone'          => 'required | max:12 |unique:users',
                'id_number'      => 'required | max:12 |unique:users',
                'adult_count'    => 'required',
                'kids_count'     => 'nullable',
                'email'          => 'required|email|unique:users',
            ];
          // dd($this->all());
        } 
        elseif ($this->guest_type == 'foreign') {
            return [
                'guest_type'     => 'required',
                'title'          => 'required',
                'guestfirstname' => 'required',
                'guestlastname'  => 'required',
                'country'        => 'required',
                'passport_number'=> 'required',
                'image_path'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'driver_name'    => 'required_if:is_driver_available,Yes', 
                'vehicle_number' => 'required_if:is_driver_available,Yes', 
                'adult_count'    => 'required',
                'kids_count'     => 'nullable',
                'email'          => 'required|email|unique:users',
            ];
           //  dd($this->guest_type);
        } else
        {
            return [
                'guest_type'            => 'required',
                'title'                 => 'required',
                'guestfirstname'       => 'required',
                'guestlastname'        => 'required',
                'complementary_reason' => 'required|string',
                'adult_count'          => 'required',
                'kids_count'           => 'nullable',
                'email'                => 'required|email|unique:users',
            ];
        }
        //dd(1);
    }
}