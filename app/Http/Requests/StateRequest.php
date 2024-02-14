<?php

namespace App\Http\Requests;

use App\Http\Enums\TicketStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'state' => 'required|string|' . Rule::in(TicketStateEnum::cases())
        ];
    }
}
