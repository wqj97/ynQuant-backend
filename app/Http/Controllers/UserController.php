<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $user->access_token = $user->createToken('ynQuant', ['*'])->accessToken;
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

        if ($request->has('sandbox')) {
            $user = User::firstOrNew([
                'phone' => $request->phone,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'skills' => $request->skills
            ]);
            $user->id = 1;
            $user->updated_at = Carbon::now();
            $user->created_at = Carbon::now();
            $user->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRhMjYyYTA3ODg1NDY2OTJmYzhiYjNjMTA3YjJjZmVjNzY2MzE0MDA2ZmNhNGJmZWY4ZTZjMDE0NGQ3ZmE0YWI0MjliNzY3MzFhOTBkNTRlIn0.eyJhdWQiOiIyIiwianRpIjoiNGEyNjJhMDc4ODU0NjY5MmZjOGJiM2MxMDdiMmNmZWM3NjYzMTQwMDZmY2E0YmZlZjhlNmMwMTQ0ZDdmYTRhYjQyOWI3NjczMWE5MGQ1NGUiLCJpYXQiOjE1MjMxMDcxNDcsIm5iZiI6MTUyMzEwNzE0NywiZXhwIjoxNTU0NjQzMTQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.d47nw-u0mr_Yb7Sb1HA37sgsTmKdJiSA9X8uVXbZy05RlbEnysRVwLV3bndA77O08u-hrS-mym3C1RyFEsY_O8KXOWDqTsDNBpHPSDp9P2R-MuHPG8AdTk87sieVcsS-O9GcB7eZ1cVYkqfvTzcRqdJLM9b71jCsFgQHyP4T-5L10UHZm1X635IQODPyuA3UMSLzHxEeStXDrkM96ytlGxjRGhMAx2QxyizssMNIj5O4zBdxfzK4DMdRPd23aUUrhtlvJ33z2fcziSnWrWKMyOfDiD6aokbeQs-tV3IExmO54qLFNzPOtWh_peaw4cURXD10Mm_To5sQcsI-nAcnyz4GjhMaGnPUw1VzxNPGGoumGdzCBLLchswoYV3C53wdlf28cr0AIEqfDjPJlum5kdDThYsOkrHa47lMNNwg3LQo71aVwocDZmI6mHLd_ks6vOHbRkvzq5qScGHQPLxj8rnv2VFh4wmKx1tyzp7pXkUu8TUyTr0nYwRrVT5o0NDn6Iz3ppLMTeuqerUB_W4pVaBzeAh03SLlB0R-szi6bI9cJ0KzH7YhdkqSLJRajGSqcNz24-CS44MSi7acfNTkF4LhRGqmv_KAv8KHFr_FTD7uRmxaVSvnwJkQZRrQqzTXyowPJs4jYjdUGQg2Y6flmoXYcDOWDGf4uDGWlwBaeiI';
            $user->makeVisible(['email', 'phone']);
            return $user;
        }

        if (User::where('phone', $request->phone)->exists()) {
            return response()->json('手机号已存在', 403);
        } elseif (User::where('name', $request->name)->exists()) {
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
