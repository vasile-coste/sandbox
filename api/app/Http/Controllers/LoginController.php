<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function apiLogin(Request $request)
    {
        // validate the request and respond with custom messages in case of fail
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'The email address is mandatory.',
                'password.required' => 'The password is mandatory.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'type' => 'error',
                'messages' => $errors,
            ], 500);
        }

        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) { //$user && Hash::check($request->password, $user->password)
            //Auth::login($user);
            // dd(Auth::check());

            return response()->json([
                'type' => 'success',
                'message' => 'Login successfully!',
            ], 200);
        }

        return response()->json([
            'type' => 'error',
            'messages' => [
                'Invalid login credentials.',
            ],
        ], 500);

        return $request->all();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
