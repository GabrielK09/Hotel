<?php

namespace App\Http\Requests;

use App\Models\DetailRooms;
use App\Models\Room;
use App\Service\RoomService;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    protected $roomService;
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;

    }
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
            'start_period' => $required,
            'end_period' => $required,
            'room_id'  => [$required, function ($attribute, $value, $fail) {
                $detailRoom = DetailRooms::where('id', $value)->first();
                if(
                    $detailRoom->exists() &&
                    $detailRoom->busy == 1 &&
                    $detailRoom->capacity == 0
                    
                )
                {
                    $fail("Esse quarto já estáo ocupado ou cheio");

                }
            }],

            'customer_id' => [$required, function ($attribute, $value, $fail) {
                if(Room::where('customer_id', $value)->exists() && Room::where('customer_id', $value)->first()->active == 1)
                {
                    $fail("Esse usuário já está associado ao quarto");

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
