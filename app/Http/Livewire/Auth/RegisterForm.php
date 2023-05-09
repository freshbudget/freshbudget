<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterForm extends Component
{
    public function render()
    {
        return view('auth.register')->extends('layouts.auth')->section('content');
    }
}
