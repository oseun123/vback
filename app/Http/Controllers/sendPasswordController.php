<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class sendPasswordController extends Controller
{
    public function sendEmail(Request $request){
        if (!$this->validateEmail($request->email)) {
            return $this->failedResponse();
        }
        
        $this->send($request->email);
        return $this->successResponse();
    }

    public function send($email){
        $token= $this->createToken($email);
        
        Mail::to($email)->send(new ResetPasswordMail($token));


    }
    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email',$email)->first();
        if ($oldToken) {
            // dd($oldToken);
            return $oldToken->token;
        }

        $token= str_random(60);
        $this->saveToken($token,$email);
        return $token;
    }

    public function saveToken($token,$email){
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
            'created_at'=> Carbon::now(),
        ]);
    }


    public function validateEmail($email){
        return !!User::where('email',$email)->first();
       
    }

    public function failedResponse(){
        return response()->json([
            'error'=>'Email does\'nt exist'

        ],Response::HTTP_NOT_FOUND);
    }
    public function successResponse(){
        return response()->json([
            'data'=>'Reset link was successfully sent to your email.'

        ],Response::HTTP_OK);
    }
}
