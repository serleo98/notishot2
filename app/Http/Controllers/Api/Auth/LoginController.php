<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;
use App\Http\Resources\User\RoleResource;
use App\Http\Controllers\Api\Auth\LoggedUser;

class LoginController extends Controller
{
    use LoggedUser;
    /**
     * @var string
     */
    protected $resource = LoginResource::class;
    protected $login_credentials;
    /**
     * LoginController constructor.
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request)
    {
        $this->login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(!Auth::attempt($this->login_credentials))
            return response()->json(['message' =>'Unauthorized'],401);
        $user = $request->user();
        $user_login_token = $user->createToken('Personal Access Token');
        $user->accessToken = $user_login_token->accessToken;
        $token = $user_login_token->token;
        $token -> save();
        return LoginResource::make($user);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
