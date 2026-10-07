<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('session-views.login');
    }
    public function store(SessionStoreRequest $request)
    {
        $att=$request->validated();
        if (!Auth::attempt($att))
        {
            throw ValidationException::withMessages([
                'password'=>'those cradentials dont match'
            ]);
        }
        $request->session()->regenerate();
        return redirect('/');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
