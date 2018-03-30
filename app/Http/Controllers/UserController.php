<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Http\Controllers\ClientController;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws AuthenticationException
     */
    public function Login (Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return Auth::user()->clients->makeVisible('secret');
        } else {
            throw new AuthenticationException();
        }
    }
}
