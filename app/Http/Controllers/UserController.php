<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function show($id)
    {
  $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function profile( Request $request)
    {
return response()->json(['user'=>$request->user(),]);
    }


    public function updateProfileImage(Request $request)
{
 $user = Auth::user();

    if ($request->hasFile('profile_photo')) {

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }


        $path = $request->file('profile_photo')->store('profile_photo', 'public');
        $user->profile_photo = $path;
        $user->save();
    }

    return response()->json([
        'message' => 'your photo image updated successfuly',
        'user' => $user,

    ]);
}
}
