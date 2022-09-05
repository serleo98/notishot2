<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;

class LoginController extends Controller
{
    /**
     * @var string
     */
    protected $resource = LoginResource::class;

    /**
     * LoginController constructor.
     */
    public function login(Request $request)
    {
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(!Auth::attempt($login_credentials))
            return response()->json([
                'message' =>'Unauthorized'
            ],401);
        $user =$request->user();
        $user_login_token = $user->createToken('Personal Access Token');
        $token = $user_login_token->token;
        $token -> save();
        return response()->json([
            'access_token' => $user_login_token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString() 
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
