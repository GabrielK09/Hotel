<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HotelRommRequest extends FormRequest
{   
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
            'customer_id' => ['required', 'string'],
            'capacity' => [$required, 'string'],
            'level' => [$required, 'string'],
            'price_for_night' => [$required, 'number'],
            'number_room' => [$required, 'number'],
            'busy' => 'required'

        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'O identificador do usuário é obrigátorio',
            'capacity.required' => 'A capacidade do quarto é obrigátorio',
            'level.required' => 'O nível do quarto é obrigátorio',
            'price_for_night.required' => 'O preço por noite do quarto é obrigátorio',
            'price_for_night.number' => 'O preço por noite do quarto deve ser um número',
            'number_room.required' => 'O número de quartos é obrigátorio',
            'number_room.number' => 'O número de quartos deve ser um número',
            'busy.required' => 'É necessário informar se o quarto está ou não ocupado'

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Erro na criação do quarto ( Hotel Room )',
                'errors' => $validator->errors(),

            ], 422)
        );
        
    }
}
