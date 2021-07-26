<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'phone_number' => 'required|min:10|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
        $input = $request->all();
        // unset($input['c_password']);
        $input['password'] = Hash::make($input['password']);
        $data = User::create($input);
        $credentials = $request->only(['email', 'password', 'role']);
        $token = Auth::attempt($credentials);
        //return successful response
        return response()->json([
            'data' => $data,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ], 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|email|string',
            'role' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only(['email', 'password', 'role']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ], 200);
    }

    /**
     * Request an email verification email to be sent.
     *
     * @param  Request  $request
     * @return Response
     */
    public function emailRequestVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('Email address is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            "success" => true,
            "message" => 'Email request verification sent to ' . Auth::user()->email,
        ]);
    }

    /**
     * Verify an email using email and token from email.
     *
     * @param  Request  $request
     * @return Response
     */
    public function emailVerify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
        ]);

        try {
            \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json('Fail Verify Email, Token has expired');
            // do whatever you want to do if a token is expired
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json('Fail Verify Email, Token is invalid', 401);
            // do whatever you want to do if a token is invalid
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json('Fail Verify Email, Token not found', 401);
        }

        if (!$request->user()) {
            return response()->json('Invalid token', 401);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('Email address ' . $request->user()->getEmailForVerification() . ' is already verified.');
        }
        $request->user()->markEmailAsVerified();

        return response()->json('Email address ' . $request->user()->email . ' successfully verified.');
    }
}
