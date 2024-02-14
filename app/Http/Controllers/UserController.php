<?php

namespace App\Http\Controllers;

use App\Http\Enums\RolesEnum;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()->whereNot('id', Auth::id())->get();

        return Inertia::render('User/UserIndex', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('User/UserCreate', [
            'roles' => RolesEnum::labels()
        ]);
    }

    public function store(StoreRequest $request)
    {
        /** @var User $user */
        $user = User::query()->create([...$request->except('role'), 'password' => Hash::make(Str::random())]);

        $user?->syncRoles(RolesEnum::from($request->role));

        $status = Password::sendResetLink(
            $user->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return Redirect::route('user.index');
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return Inertia::render('User/UserEdit', [
            'user' => new UserResource($user),
            'roles' => RolesEnum::labels()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('role'));

        $user->syncRoles($request->role);

        return Redirect::route('user.index');
    }

    public function destroy(User $user)
    {

    }

    public function block(User $user)
    {
        $user->block();

        return Redirect::route('user.edit', $user);
    }

    public function unblock(User $user)
    {
        $user->unblock();

        return Redirect::route('user.edit', $user);
    }
}
