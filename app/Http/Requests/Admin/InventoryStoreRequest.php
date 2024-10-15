<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InventoryStoreRequest extends FormRequest
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
    {
        
        
            return [
                'user_id' => 'required|exists:users,id',
                'item_name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:0',
                'status' => 'nullable|string|max:255',
            ];
        
    }
}
