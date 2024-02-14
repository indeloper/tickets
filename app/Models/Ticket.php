<?php

namespace App\Models;

use App\Builders\TicketBuilder;
use App\Http\Enums\TicketAssigneeEnum;
use App\Http\Enums\TicketLabelEnum;
use App\Http\Enums\TicketPayerEnum;
use App\Http\Enums\TicketStateEnum;
use App\Models\Workflow\Ticket\TicketWorkflow;
use Carbon\Carbon;
use Codewiser\Workflow\StateMachineEngine;
use Codewiser\Workflow\Traits\HasWorkflow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property TicketStateEnum $state
 * @property string $tenant
 * @property string $address
 * @property string $description
 * @property TicketLabelEnum $label
 * @property User $initiator_id
 * @property null|TicketAssigneeEnum $assignee
 * @property null|User $assignee_id
 * @property null|TicketPayerEnum $payer
 * @property null|array $budget
 * @property null|Carbon $payed_at
 * @property null|Carbon $deadline
 * @property null|Carbon $end_date
 *
 * @method static TicketBuilder query()
 */
class Ticket extends Model
{
    use HasFactory,
        HasWorkflow;

    protected $guarded = [];

    protected $casts = [
        'state' => TicketStateEnum::class,
        'label' => TicketLabelEnum::class,
        'assignee' => TicketAssigneeEnum::class,
        'payer' => TicketPayerEnum::class
    ];

    public function newEloquentBuilder($query): TicketBuilder
    {
        return new TicketBuilder($query);
    }

    public function state(): StateMachineEngine
    {
        return $this->workflow(TicketWorkflow::class, 'state');
    }
}
