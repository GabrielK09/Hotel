<?php

namespace App\Http\Requests;

use App\Models\Room;
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
            'room_id'  => [$required],
            'start_period' => $required,
            'end_period' => $required,
            'customer_id' => [$required, function ($attribute, $value, $fail) {
                $room = Room::where('customer_id', $value)->first();
                if ($room->exists())
                {
                    $fail("Esse usuário já está associado a um quarto. Número do quarto $room->room_id | Usuário: $room->customer & ID: $room->customer_id");
                    
                }
                
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Campo identificador do usuário necessário',
            'room_id.required' => 'Campo identificador do quarto necessário',
            'start_period.required' => 'Não foi definida uma data inicial da pousada',
            'end_period.required' => 'Não foi definida uma data final da pousada',

        ];
    }
}
