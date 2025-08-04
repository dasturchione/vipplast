<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutButton
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
