<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'customer_id' => [$required, 'unique:rooms,customer_id'],
            'room_id'  => [$required, 'unique:rooms,room_id'],
            'start_period' => $required,
            'end_period' => $required,
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Campo identificador do usuário necessário',
            'room_id.required' => 'Campo identificador do quarto necessário',
            'start_period.required' => 'Não foi definida uma data inicial da pousada',
            'end_period.required' => 'Não foi definida uma data final da pousada',

            'customer_id.unique' => 'Esse usuário já está associado a um quarto'

        ];
    }
}
