<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session-views.register');
    }
    public function store(RegisterStoreRequest $request)
    {
        $attributes=$request->validated();
        $role=$attributes['role'];
        unset($attributes['role']);
        if ($role=='customer')
        {
            $attributes['balance']=0;
        }
        $user=User::create($attributes);
        $user->assignRole($role);
        Auth::login($user);
        return redirect('/');
    }
}
