<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function profile( Request $request)
    {
return response()->json(['user'=>$request->user(),]);
    }


    public function updateProfileImage(Request $request)
{
 $user = Auth::user();

    if ($request->hasFile('profile_image')) {

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }


        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $path;
        $user->save();
    }

    return response()->json([
        'message' => 'your photo image updated successfuly',
        'user' => $user
    ]);
}
}
