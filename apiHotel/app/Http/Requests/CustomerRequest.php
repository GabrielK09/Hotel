<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
