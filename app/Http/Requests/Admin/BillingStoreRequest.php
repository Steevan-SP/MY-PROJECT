<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BillingStoreRequest extends FormRequest
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
      
        return [
            'user_id' => 'required|exists:users,id',
            'item' => 'required|string',
            'code' => 'required|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|integer|min:0',
            'total-amount' => 'required|integer|min:0',
        ];
    
        //(1);
    }
}