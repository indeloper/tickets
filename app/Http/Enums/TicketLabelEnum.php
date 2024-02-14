<?php

namespace App\Http\Enums;

enum TicketLabelEnum: string
{
    case ACCIDENT = 'accident';

    case PROBLEM = 'problem';

    case PLANNED = 'planned';

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            self::ACCIDENT->value => 'Авария',
            self::PROBLEM->value => 'Проблема',
            self::PLANNED->value => 'Плановая',
        ];
    }
}
