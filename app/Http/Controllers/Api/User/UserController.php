<?php

namespace App\Http\Controllers\Api\User;


use App\Models\User\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
  
    public function store(UserRequest $userRequest ) {
        return $userRequest;
    }


    /*public function userList($toFind = null)
    {
        return $this->localRepository->getUsers($toFind);
    }

    public function update($user, Array $data) : String
    {
        $this->localRepository->updateUser($user, $data);
        
        if(isset($data['profile'])){
        
            $profile = Profile::where('user_id', $user->id)->first();
            $this->profileRepository->update($data['profile'],$profile);
        }
        return trans('common.updated_user');
    }

    public function destroy($user)
    {
        $message = 'No se ha podido eliminar intente luego';
        if(is_null($user->profile))
        {
            $this->profileRepository->deleteProfile($user);
        }
        $this->localRepository->deleteUser($user);
        $message = 'Ha sido eliminado con exito';
        return $message;
    }
    public function registro (UserRequest $data)
    {
        $data['role_id'] = 4;
        $this->store($data);
        return trans('common.register_user');
    }*/
}
