<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemStore extends FormRequest
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
            'product_id' => 'required',
            'product_amount' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'product_id.required' => 'Favor selecionar um produto.',
            'product_amount.required' => 'Favor informar a quantidade.',
            'product_amount.required' => 'Favor informar uma quantidade maior que 0.'
        ];
    }
}
