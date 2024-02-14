<?php

namespace App\Http\Middleware;

use App\Http\Enums\RolesEnum;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'abilities' => [
                    'user' => [
                        'viewAny' => Gate::inspect('viewAny', User::class)
                    ],
                    'ticket' => [
                        'viewAny' => Gate::inspect('viewAny', Ticket::class)
                    ],
                ],
            ],
        ];
    }
}
