<?php

namespace App\Http\Enums;

enum TicketPayerEnum: string
{
    case TENANT = 'tenant';

    case MANAGEMENT_COMPANY = 'management_company';

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            self::TENANT->value => 'Арендатор',
            self::MANAGEMENT_COMPANY->value => 'Управляющая компания',
        ];
    }
}
