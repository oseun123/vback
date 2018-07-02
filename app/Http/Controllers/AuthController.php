<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Http\Request;
use App\Mail\VerifyEmailMail;
use Symfony\Component\HttpFoundation\Response;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // return response()->json($request->all(),401 );
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password doesn\'t exist'], 401);
        }
        if ($request->verifytoken) {
            $email = $request->email;
            $token1 = $request->verifytoken;

            if ($token1 !== auth()->user()->verifytoken) {
                return response()->json(['error' => 'Invalid token'], 401);
            }
            User::where(['email' => $email, 'verifytoken' => $token1])->update(['verifytoken' => null, 'active' => 1]);
            return $this->respondWithToken($token);
        }
        if (auth()->user()->active === 0) {
            return response()->json(['error' => 'You have to verify your account to login'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(Request $request)
    {

        // return response($request->all(), Response::HTTP_CREATED);
        $this->validate($request, [

            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ]);
        $token = $this->createToken();
        $user = new User;
        // $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->verifytoken = $token;

        $user->save();
        $email = $request->email;
        $this->sendEmail($email, $token);

        return response()->json(['message' => 'You have Successfully Registered, Please check your mail to verify your email. ']);



        // if ($request->hasFile('photo')) {
        //     $request->photo->store('public');
        //     $imageName = $request->photo->hashName();

        //     // return response()->json($request->photo);
        // }
       
        // return $this->login($request);
        // http://localhost:8000/storage/rBGAiDbqT9yRtbKkNwl9UgvqvsRhdQ9lM5OEiVsW.jpeg
    }
    public function createToken()
    {
        return str_random(60);
    }

    public function sendEmail($email, $token)
    {
        Mail::to($email)->send(new VerifyEmailMail($token));
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'isAdmin' => auth()->user()->type,
        ]);
    }

    // public function upload(Request $request)
    // {

    //     return $request->all();
    // }
}