<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Resources\Responses\LoginClientResource;

trait LoggedUser
{
    protected function createToken(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->get('remember_me')) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return $tokenResult;
    }
}
