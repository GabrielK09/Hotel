<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRommRequest extends FormRequest
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
            'customer_id' => ['required', 'string'],
            'capacity' => [$required, 'string'],
            'level' => [$required, 'string'],
            'price_for_night' => [$required, 'number'],
            'number_room' => [$required, 'number'],
            'busy' => ['required', 'number'],

        ];
    }
}
