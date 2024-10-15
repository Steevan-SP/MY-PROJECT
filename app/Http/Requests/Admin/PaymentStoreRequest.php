<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {dd($request->payment_mode);
       return [
             
            'guest_id' => 'nullable',
            'user_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
            'ticket_id' => 'nullable',
            'total_adults_price' => 'nullable|numeric',
            'total_kids_price' => 'nullable|numeric',
            'payment_mode' => 'required',
            'card_type' => 'required_if:payment_mode,card|string', 
            'last_four_digits' => 'required_if:payment_mode,card|string|max:4',
            'total_amount' => 'required|numeric',
            'ticket_number' => 'nullable|string',
            'bill_number' => 'nullable|string',

                ];
          
    
}
}

