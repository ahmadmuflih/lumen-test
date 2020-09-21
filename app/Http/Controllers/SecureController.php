<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SecureController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) { // Jika parameter tidak sesuai
            return response()->json(['status' => 'error', 'message' => $validator->getMessageBag()->first()], 400);
        }
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid email or password'], 401);
        }
        $user = Auth::user();
        $user->token = $token;
        $user->save();
        $data['user'] = $user;
        return response()->json(
            [
                'status' => 'success',
                'message' => 'You are login successfully',
                'data' => $data
            ],
            200
        );
    }

    public function profile(Request $request)
    {
        $data['user'] = Auth::user();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}