<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:10|max:20',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8'
            ],
            [
                'email.unique' => 'Email address is already in use',

            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            return response()->json(['message' => 'User Registered Successfully!'], 200);
        }
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        /** @var User $user */
        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, time() + (60 * 24 * 60), '/', null, false, false, false); // 1 day

        $response = response([
            'message' => 'Log in success!',
            'token' => $token,
            'user' => $user
        ])->withCookie($cookie);
        return $response;

    }

    public function user()
    {
        return Auth::user();
    }
    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'Logout Successfully!'
        ])->withCookie($cookie);
    }
}
