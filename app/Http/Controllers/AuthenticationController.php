<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function __construct() {
        $this->middleware(['auth:sanctum'])->only('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Omae Wa SIAPA???'],
            ]);
        }
        ;

        return $user->createToken($request->email)->plainTextToken;
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['messages' => 'omae wa udah logout']);

    }

        public function register(Request $request) {

        $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json(['messages' => 'Akun Omae Wa Udah Watashi Bikin']);

    }

}
