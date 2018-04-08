<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 登录用户
     * @param Request $request
     * @return \App\User|\Illuminate\Contracts\Auth\Authenticatable
     * @throws AuthenticationException
     */
    public function Login (Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required'
        ]);
        if (!User::where('phone', $request->phone)->exists()){
            throw new AuthenticationException('手机号不存在');
        }

        if (Auth::attempt([
            'phone' => $request->phone,
            'password' => $request->password
        ])) {
            $user = Auth::user();
            $user->makeVisible(['email', 'phone']);
            $user->access_token = $user->createToken('ynQuant')->accessToken;
            return $user;
        } else {
            throw new AuthenticationException('密码错误');
        }
    }


    /**
     * 创建用户
     * @param Request $request
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Regist (Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'name' => 'required',
            'password' => 'required',
            'skills' => 'required'
        ]);

        if (User::where('phone', $request->phone)->exists()) {
            return response()->json('手机号已存在', 403);
        } elseif (User::Where('name', $request->name)->exists()) {
            return response()->json('用户名已存在', 403);
        }

        $user = User::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'skills' => $request->skills
        ]);
        $user->token = $user->createToken('ynQuant')->accessToken;
        $user->makeVisible(['email', 'phone']);
        return $user;
    }
}
