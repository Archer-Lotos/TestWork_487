<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator};


class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->pivot = $authRepository;
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
        ];
        $input = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['message' => 'Data is invalid'], 401);
        } else {
            $user = $this->pivot->registerUser($input);
            return response()->json(['user' => $user, 'key' => $user->api_key->key], 201);
        }
    }

    public function login(Request $request)
    {
        $validatedRequest = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validatedRequest)) {
            $request->session()->regenerate();

            $this->pivot->setKey(auth()->user());

            return response()->json(['user' => auth()->user(), 'key' => auth()->user()->api_key->key], 201);
        }

        return response()->json(['message' => 'Data is invalid'], 401);
    }

    public function logout()
    {
        $this->pivot->dropKey(auth()->user());

        return response()->json(['message' => 'You logout'], 200);
    }
}
