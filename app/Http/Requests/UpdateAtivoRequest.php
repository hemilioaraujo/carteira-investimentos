<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAtivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => [
                'required',
                'max:6',
                'unique:ativos,codigo,'.$this->route('ativo')->id,
            ],
            'descricao' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['required',  'max:14', 'unique:ativos,cnpj,'.$this->route('ativo')->id],
        ];
    }
}
