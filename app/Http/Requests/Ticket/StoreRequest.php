<?php

namespace App\Http\Requests\Ticket;

use App\Http\Enums\TicketLabelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'tenant' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'label' => 'nullable|string|' . Rule::in(TicketLabelEnum::cases()),
            'description' => 'nullable|string',
        ];
    }
}
