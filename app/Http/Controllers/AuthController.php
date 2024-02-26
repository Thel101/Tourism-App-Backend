<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
<<<<<<< HEAD
use Illuminate\Support\Facades\Validator;
=======
>>>>>>> c1392d5 (added DestinationImage)
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
<<<<<<< HEAD
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

=======
>>>>>>> c1392d5 (added DestinationImage)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
<<<<<<< HEAD

        if ($user) {
            return response()->json(['message' => 'User Registered Successfully!'], 200);
=======
        if ($user) {
            return $user;
>>>>>>> c1392d5 (added DestinationImage)
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
<<<<<<< HEAD
        /** @var User $user */
        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, time() + (60 * 24 * 60), '/', null, false, false, false); // 1 day

        $response = response([
            'message' => 'Log in success!',
            'token' => $token,
            'user' => $user
        ])->withCookie($cookie);
        return $response;

=======

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'message' => $token
        ])->withCookie($cookie);
>>>>>>> c1392d5 (added DestinationImage)
    }

    public function user()
    {
        return Auth::user();
    }
<<<<<<< HEAD
    public function logout()
    {
=======
    public function logout(){
>>>>>>> c1392d5 (added DestinationImage)
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'Logout Successfully!'
        ])->withCookie($cookie);
    }
}
