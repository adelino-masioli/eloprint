<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdate extends FormRequest
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
            'name'      => 'required|min:5',
            'email'     => 'required|unique:customers,email,'.$this->id,
            'telephone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'       => 'O campo NOME é obrigatório.',
            'name.min'            => 'O campo NOME tem que ter no mínimo 5 caracteres.',
            'email.required'      => 'O campo E-MAIL é obrigatório.',
            'email.unique'        => 'E-mail já cadastrados',
            'telephone.required'  => 'O campo TELEFONE é obrigatório.'
        ];
    }
}
