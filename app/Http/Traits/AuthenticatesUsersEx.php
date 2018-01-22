<?php

namespace App\Http\Traits;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait AuthenticatesUsersEx {
    use AuthenticatesUsers {
        AuthenticatesUsers::validateLogin as parentvalidateLogin;
    }

    protected function validateLogin()
    {
        $messages = [
            'email.exists' => 'Account is not active!',
        ];
        $this->validate(request(), [
            $this->username() => 'required|exists:users,email,isActive,1',
            'password' => 'required'
        ], $messages);
    }

    protected function redirectTo()
    {
        // if user have role
        if (auth()->user()->isAdmin) {
            return $this->redirectTo = '/adminPanel';
        }

        return $this->redirectTo = '/dashboard';
    }
}