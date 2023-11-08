<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CAuth extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $validasi = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // $validasi = request()->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|min:6',
        // ]);

        if ($validasi->fails()) {
            return response()->json($validasi->messages());
        }
        // $validasi['password'] = bcrypt(request()->password);
        // $user = User::create($validasi);
        $user = User::create([
            'email' => request()->email,
            'password' => bcrypt(request()->password),
        ]);
        if ($user)
            return response()->json(['message' => 'Registrasi berhasil']);
        else
            return response()->json(['message' => 'Registrasi gagal']);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if ($token = auth()->attempt($credentials)) {
            // return $this->respondWithToken($token);
            $token = $this->respondWithToken($token);
            return redirect('/dashboard');
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
