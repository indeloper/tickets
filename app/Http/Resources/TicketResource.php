<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Ticket
 */
class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'tenant' => $this->tenant,
            'address' => $this->address,
            'description' => $this->description,
            'label' => $this->label,
            'assignee' => $this->assignee,
            'payer' => $this->payer,
            'budget' => $this->budget,
            'payed_at' => $this->payed_at,
            'deadline' => $this->deadline,
            'end_date' => $this->end_date,
        ];
    }
}
