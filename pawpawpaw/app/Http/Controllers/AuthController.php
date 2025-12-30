<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->toArray(), [
                'nama' => 'required|string|max:100',
                'nik' => 'required|numeric|digits:16|unique:users,nik',
                'no_telp' => 'required|numeric|digits_between:10,15',
                'email' => 'required|string|email|max:100|unique:users,email',
                'password' => 'required|string|min:8',
                //'role' => 'required|in:PATIENT,DOCTOR,ADMIN',
            ]);

            if ($validator->fails()) {
                // return response()->json([
                //     'message' => 'failed to register',
                //     'errors' => $validator->errors()
                // ], 400);

                return redirect()->back()->withErrors($validator)->withInput();
            }


            $user = User::create([
                'nama' => $request['nama'],
                'nik' => $request['nik'],
                'no_telp' => $request['no_telp'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role' => 'PATIENT',
            ]);

            // return response()->json([
            //     'message' => 'User registered successfully',
            //     'user_id' => $user->id_user
            // ], 201);

            return redirect('/homepage')->with('success', 'Registration successful. Welcome!');

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Log in a user
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->toArray(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'failed to register to user',
                    'errors' => $validator->errors()
                ], 400);
            }

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'failed to register to user',
                    'errors' => 'invalid email or password'
                ], 400);
            }


            // return response()->json([
            //     'message' => 'Logged in successfully',
            //     'user' => Auth::user()->nama
            // ], 200);

            // Ambil user yang sedang login
            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'PATIENT') {
                return redirect('/homepage')->with('success', 'Logged in successfully. Welcome!');
            } elseif ($user->role === 'DOCTOR') {
                return redirect('/doctordashboard')->with('success', 'Welcome, Doctor!');
            } elseif ($user->role === 'ADMIN') {
                return redirect('/admindashboard')->with('success', 'Welcome, Admin!');
            } else {
                // Jika role tidak dikenali, logout user dan kembalikan error
                Auth::logout();
                return response()->json([
                    'message' => 'Unauthorized access',
                    'error' => 'Your role is not recognized'
                ], 403);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Log out a user
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'internal server error',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
