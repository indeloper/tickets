<?php

namespace App\Http\Requests\Ticket;

use App\Http\Enums\TicketLabelEnum;
use App\Http\Enums\TicketStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tenant' => 'nullable|sometimes|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'label' => 'sometimes|nullable|string|' . Rule::in(TicketLabelEnum::cases()),
            'description' => 'sometimes|nullable|string',
        ];
    }
}
