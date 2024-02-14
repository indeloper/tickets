<?php

namespace App\Http\Enums;

enum RolesEnum: string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';

    case MANAGER = 'manager';

    case GENERAL = 'general';

    case COMMERCIAL = 'commercial';

    case TECHNICAL = 'technical';

    case ACCOUNTING = 'accounting';

    case EXECUTOR = 'executor';

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            self::SUPERADMIN->value => 'Бог',
            self::ADMIN->value => 'Администратор',
            self::MANAGER->value => 'Менеджер',
            self::GENERAL->value => 'Генеральный директор',
            self::COMMERCIAL->value => 'Коммерческий отдел',
            self::TECHNICAL->value => 'Технический отдел',
            self::ACCOUNTING->value => 'Бухгалтерия',
            self::EXECUTOR->value => 'Исполнитель',
        ];
    }
}
