<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\User;

class changePasswordController extends Controller
{

public function proccess(ChangePasswordRequest $request){
    return $this->getPasswordResetTableRow($request)->count() > 0 ? $this->changePassword($request) :$this->tokenNotFoundResponse();
}

private function getPasswordResetTableRow($request){

    return DB::table('password_resets')->where([
        'email'=>$request->email,
        'token'=>$request->verifytoken,
    ]);
}
private function tokenNotFoundResponse(){

    return response()->json(['error'=>'invalid token/email'],Response::HTTP_UNPROCESSABLE_ENTITY);
}

private function changePassword($request){
 $user = User::whereEmail($request->email)->first();
 $user->update(['password' => $request->password ]);

 $this->getPasswordResetTableRow($request)->delete();
 return response()->json(['data'=>'Password Successfully Changed'],response::HTTP_CREATED);
}

}
