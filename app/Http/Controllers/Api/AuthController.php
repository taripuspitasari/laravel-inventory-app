<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $data = $request->validated();
        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided email address or password is incorrect'
            ], 422);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->is_admin) {
            return response([
                'message' => 'Unauthorized access: Admins cannot log in here.'
            ], 422);
        }
        $token = $user->createToken('main')->plainTextToken;

        // return response(compact('user', 'token'));
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password has changed']);
    }

    public function updateProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:55'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
        ]);

        /** @var \App\Models\User $user */
        $user = User::find($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        return response()->json(['user' => new UserResource($user), 'message' => 'Personal information has changed']);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        if ($user->image) {
            Storage::delete($user->image);
        }

        $path = $request->file('photo')->store('profile-images');

        $user->update(['image' => $path]);

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'Photo profile updated successfully'
        ]);
    }
}
