<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelDetailRequest extends FormRequest
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
        $required = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'name' => [$required, 'string', 'max:120'],
            'cnpj' => [$required, 'string', 'max:14'],
            'email' => [$required, 'string', 'max:170'],
            'address' => [$required, 'string', 'max:120'],
            'number' => [$required, 'string'],
            'number_of_rooms' => [$required, 'string'],
            'number_of_employees' => [$required, 'string'],
            
        ];
    }
}
 