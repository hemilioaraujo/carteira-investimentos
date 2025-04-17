<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransacaoRequest extends FormRequest
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
            'data' => ['required', 'date'],
            'tipo_ordem_id' => ['required', 'exists:tipos_ordens,id'],
            'ativo_id' => ['required', 'exists:ativos,id'],
            'corretora_id' => ['required', 'exists:corretoras,id'],
            'quantidade' => ['required', 'numeric', 'min:0'],
            'preco_unitario' => ['required', 'numeric', 'min:0'],
            'valor_total' => ['required', 'numeric', 'min:0'],
            'observacoes' => ['nullable', 'string'],
        ];
    }
}
