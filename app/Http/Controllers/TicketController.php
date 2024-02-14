<?php

namespace App\Http\Controllers;

use App\Http\Enums\TicketAssigneeEnum;
use App\Http\Enums\TicketLabelEnum;
use App\Http\Enums\TicketPayerEnum;
use App\Http\Enums\TicketStateEnum;
use App\Http\Requests\StateRequest;
use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Codewiser\Workflow\Contracts\StateEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Ticket/TicketIndex', [
            'tickets' => TicketResource::collection(Ticket::all())->collection->groupBy('state')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Ticket/TicketCreate', [
            'labels' => TicketLabelEnum::labels()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $ticket = new Ticket();
        $ticket->tenant = $request->tenant;
        $ticket->address = $request->address;
        $ticket->label = $request->label;
        $ticket->description = $request->description;

        $ticket->initiator_id = Auth::id();

        $ticket->state = TicketStateEnum::DRAFT;
        $ticket->save();

        return Redirect::route('ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return Inertia::render('Ticket/TicketShow', [
            'ticket' => new TicketResource($ticket),
            'state' => $ticket->state()->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $abilities = [
            'budget' => Gate::inspect('budget', $ticket)->toArray(),
            'delete' => Gate::inspect('delete', $ticket)->toArray(),
        ];

        return Inertia::render('Ticket/TicketEdit', [
            'ticket' => new TicketResource($ticket),
            'labels' => TicketLabelEnum::labels(),
            'payers' => TicketPayerEnum::labels(),
            'abilities' => $abilities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('state'));

        return Redirect::route('ticket.show', $ticket);
    }

    public function state(StateRequest $request, Ticket $ticket)
    {
        if (
            $ticket->state !== $request->enum('state', TicketStateEnum::class)
            && $state = $request->enum('state', TicketStateEnum::class)
        ) {
            $ticket->state()
                ->authorize($state)
                ->transit($state)
                ->save();
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
