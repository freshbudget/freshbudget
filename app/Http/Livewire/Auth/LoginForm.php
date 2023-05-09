<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class LoginForm extends Component
{
    public function render()
    {
        return view('auth.login')->extends('layouts.auth')->section('content');
    }
}
