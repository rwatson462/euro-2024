<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateUser;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Queries\Auth\FindUserByEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController
{
    public function __construct(
        private readonly CreateUser $createUser,
        private readonly FindUserByEmail $findUserByEmail,
    ) {
        //
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $this->createUser->handle(
            $request->validated('name'),
            $request->validated('email'),
            $request->validated('password'),
        );

        $user = $this->findUserByEmail->handle($request->validated('email'));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
