<?php

namespace App\Http\Enums;

enum TicketAssigneeEnum: string
{
    case TENANT = 'tenant';

    case TECHNICAL = 'technical';

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            self::TENANT->value => 'Арендатор',
            self::TECHNICAL->value => 'Технический отдел',
        ];
    }
}
