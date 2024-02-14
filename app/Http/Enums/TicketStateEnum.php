<?php

namespace App\Http\Enums;

use Codewiser\Workflow\Contracts\StateEnum;

enum TicketStateEnum: string implements StateEnum
{

    case DRAFT = 'draft';

    case NEW = 'new';

    case BUDGET = 'budget';

    case TRIAGE = 'triage';

    case IN_PROGRESS = 'in_progress';

    case COMPLETED = 'completed';

    case CLOSED = 'closed';

    case REJECTED = 'rejected';

    public function caption(): string
    {
        return match ($this) {
            self::DRAFT => 'Черновик',
            self::NEW => 'Новая',
            self::BUDGET => 'Бюджетирование',
            self::TRIAGE => 'Согласование',
            self::IN_PROGRESS => 'В работе',
            self::COMPLETED => 'Выполнено',
            self::CLOSED => 'Закрыто',
            self::REJECTED => 'Отказ',

        };
    }

    public function attributes(): array
    {
        return match ($this) {
            self::BUDGET =>[
                'fields' => []
            ],
            default => []
        };
    }
}
