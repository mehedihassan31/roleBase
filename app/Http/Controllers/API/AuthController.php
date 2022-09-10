<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // $credentials = $request->only(['email', 'password']);
    	if (Auth::attempt(['phone' => request('email'), 'password' => request('password')]) ||
        Auth::attempt(['email' => request('email'), 'password' => request('password')]) ||
        Auth::attempt(['username' => request('email'), 'password' => request('password')])) {

        $user = Auth::user();
        $userRole = $user->role()->first();

        if ($userRole) {
            $this->scope = $userRole->name;
        }else{
            $this->scope = 'user';
        }
        $success['name'] = $user->name;
        $success['token']=$user->createToken($user->email.'-'.now(),[$this->scope]);;
        return response()->json(['success' => $success], 200);
		}
		else {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
    }


    public function register(RegisterRequest $request)
    {
    	$user = User::create([
    		'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
    		'email' => $request->email,
    		'password' => \Hash::make($request->password),
        ]);

        if ($user) {
            $this->scope = 'user';
        }

    	$success['name'] = $user->name;
    	$success['token']=$user->createToken($user->email.'-'.now(),[$this->scope]);;
    	return response()->json(['success' => $success], 200);
    }

}
