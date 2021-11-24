<?php

namespace Modules\Blog\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $inputs = $request->only('name', 'family', 'mobile', 'password');
        User::create([
            'name' => $inputs['name'],
            'family' => $inputs['family'],
            'mobile' => $inputs['mobile'],
            'password' => Hash::make($inputs['password'])
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('API Token')->accessToken;
            return response()->json([
                'token' => $token,
                'name' => $user->name,
                'family' => $user->family,
                'mobile' => $user->mobile
            ]);
        } else {
            return response()->json([
                'errors' => [
                    'mobile' => 'اطلاعات ورود اشتباه است'
                ]
            ], 403);
        }
    }
}
