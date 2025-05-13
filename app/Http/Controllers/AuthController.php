<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register( RegisterRequest $request){
        $imagePath = null;

        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->store('profile_images', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_image' => $imagePath,
        ]);
        $token = $user->createToken('YourAppName')->plainTextToken;
        return response()->json([
            'message' => 'you register successfuly',
             'token'=>$token,
            'user' => $user,
            'profile_photo'=>$imagePath
        ], 201);
    }


   public function login(LoginRequest $request)
   {
    $logindata= $request->only('email', 'password');

    if (Auth::attempt($logindata)) {
        $user = Auth::user();
        $token = $user->createToken('YourAppNam')->plainTextToken;


        return response()->json([
            'message' => 'you log in successfully',
            'token' => $token,
            'user' => $user
        ]);
    } else {
        return response()->json(['message' => 'error'], 401);
    }
}






}
