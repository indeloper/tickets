<?php

namespace App\Models\Workflow\Ticket;

use App\Http\Enums\TicketAssigneeEnum;
use App\Http\Enums\TicketLabelEnum;
use App\Http\Enums\TicketPayerEnum;
use App\Http\Enums\TicketRealmEnum;
use App\Http\Enums\TicketStateEnum;
use App\Models\Ticket;
use Codewiser\Workflow\Charge;
use Codewiser\Workflow\Exceptions\TransitionFatalException;
use Codewiser\Workflow\Exceptions\TransitionRecoverableException;
use Codewiser\Workflow\Transition;
use Codewiser\Workflow\WorkflowBlueprint;
use Illuminate\Validation\Rule;

class TicketWorkflow extends WorkflowBlueprint
{

    public function states(): array
    {
        return TicketStateEnum::cases();
    }

    public function transitions(): array
    {
        return [
            /**
             * Может только сотрудник, который создал заявку (УК, ТО)
             * Обязательное заполнение полей "Состояние", "Описание", "Адрес"
             * Только для заявок с сотоянием "Плановая" или "Проблема"
             *
             */
            Transition::make(TicketStateEnum::DRAFT, TicketStateEnum::NEW)
                ->as('Отправить заявку на рассмотрение')
                ->before(
                    fn(Ticket $ticket) => $ticket->label == TicketLabelEnum::ACCIDENT
                        ? throw new TransitionRecoverableException('Заявки с состоянием "Авария" сразу отправляются в работу')
                        : null
                )
                ->before(
                    fn(Ticket $ticket) => !$ticket->label
                        ? throw new TransitionRecoverableException('Не указано состояние инцидента')
                        : null
                )
                ->before(
                    fn(Ticket $ticket) => !$ticket->description
                        ? throw new TransitionRecoverableException('Не указано описание инцидента')
                        : null
                ),

            /**
             * Может только сотрудник, который создал заявку (УК, ТО)
             * Обязательное заполнение полей "Состояние", "Описание", "Адрес"
             * Только для заявок с сотоянием "Авария"
             * После смены статуса автоматически плательщиком ставится УК, а исполнителем ТО
             */
            Transition::make(TicketStateEnum::DRAFT, TicketStateEnum::IN_PROGRESS)
                ->as('Отправить заявку в работу')
                ->before(
                    fn(Ticket $ticket) => $ticket->label !== TicketLabelEnum::ACCIDENT
                        ? throw new TransitionRecoverableException('Заявки с состояниями "Проблема" или "Плановая" должны быть рассмотрены менеджером')
                        : null
                )
                ->after(
                    function (Ticket $ticket) {
                        $ticket->query()->update([
                            'payer' => TicketPayerEnum::MANAGEMENT_COMPANY->value,
                            'assignee' => TicketAssigneeEnum::TECHNICAL->value
                        ]);
                    }
                ),

            Transition::make(TicketStateEnum::NEW, TicketStateEnum::BUDGET)
                ->as('Бюджет')
                ->before(
                    fn(Ticket $ticket) => !$ticket->payer
                        ? throw new TransitionRecoverableException('Не указан плательщик')
                        : null
                )
                ->before(
                    fn(Ticket $ticket) => $ticket->label === TicketLabelEnum::ACCIDENT
                        ? throw new TransitionRecoverableException('asdgk')
                        : null
                ),

            Transition::make(TicketStateEnum::NEW, TicketStateEnum::IN_PROGRESS)
                ->as('В работе'),

            Transition::make(TicketStateEnum::BUDGET, TicketStateEnum::TRIAGE)
                ->as('Согласование')
                ->before(
                    fn(Ticket $ticket) => !$ticket->budget
                        ? throw new TransitionRecoverableException('nel`zya')
                        : null
                ),

            Transition::make(TicketStateEnum::TRIAGE, TicketStateEnum::IN_PROGRESS)
                ->as('В работе'),

            Transition::make(TicketStateEnum::IN_PROGRESS, TicketStateEnum::COMPLETED)
                ->as('Выполнено'),

            Transition::make(TicketStateEnum::COMPLETED, TicketStateEnum::CLOSED)
                ->as('Закрыть'),

            Transition::make(TicketStateEnum::BUDGET, TicketStateEnum::REJECTED)
                ->as('Отказ'),

            Transition::make(TicketStateEnum::TRIAGE, TicketStateEnum::REJECTED)
                ->as('Отказ'),
        ];
    }
}
