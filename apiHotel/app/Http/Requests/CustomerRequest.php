<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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

        $required = $this->isMethod('post') ? 'required' : 'sometimes';
        return [
            'name' => [$required, 'string', 'max:120'],
            'cnpj' => 'nullable|required_without:cpf',
            'cpf' => 'nullable|required_without:cnpj',
            'address' => [$required, 'string', 'max:120']

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigátorio',
            'name.max' => 'O campo nome passou do seu limite: :max caracteres',
            'name.string' => 'O campo nome deve ser texto válido',

            'cnpj.required' => 'O campo CNPJ é obrigátorio',
            'cnpj.max' => 'O campo CNPJ passou do seu limite: :max caracteres',
            'cnpj.string' => 'O campo CNPJ deve ser texto válido',

            'cpf.required' => 'O campo CPF é obrigátorio',
            'cpf.max' => 'O campo CPF passou do seu limite: :max caracteres',
            'cpf.string' => 'O campo CPF deve ser texto válido',

            'address.required' => 'O campo endereço é obrigátorio',
            'address.max' => 'O campo endereço passou do seu limite: :max caracteres',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Erro de validação ( Customer )',
                'errors' => $validator->errors(),

            ], 422)
        );
    }
}
