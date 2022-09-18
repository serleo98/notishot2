<?php

namespace App\Http\Controllers\Api\User;


use App\Models\User\User;
use App\Models\User\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userResource = UserResource::class;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function index($toFind = null)
    {
        switch ($toFind) {
            case 'active':
                return $this->user->where('deleted_at', null)->where('role_id', 1)->get();
            break;
            case 'deleted':
                return $this->user->onlyTrashed()->where('role_id', 1)->get();
            break;
            default:
                return $this->user->where('role_id', '!=', 1)->get();
            break;
        }
    }

    public function store(UserRequest $request ) {
        $data = $request->all();
        $validate=Validator::make($data,[$this->userResource]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $user = User::create($data);
        return response([ 'User' => new UserResource($user), 
        'message' => 'User create successfully'], 200);
    }
    
    public function update(UpdateUserRequest $urequest,$data) 
    {   
        $this->user= User::where('id',$data)->first(); 
        $this->user->fill($urequest->all());
        $this->user->save();
        return response([ 'User' => $urequest->all(), 
        'message' => 'Update User successfully'], 200);
        /*if(isset($data['profile'])){
        
            $profile = Profile::where('user_id', $user->id)->first();
            $this->profileRepository->update($data['profile'],$profile);
        }
        */
    }

    public function destroy($id)
    {
        /*$message = 'No se ha podido eliminar intente luego';
        if(is_null($user->profile))
        {
            $this->profileRepository->deleteProfile($user);
        }*/
        $message = 'Ha sido eliminado con exito';
        $user = User::where('id',$id)->first();
        isset($user) ? $user->delete() : $message = 'Error al eliminar Usuario'; 
        return $message;
    }
}
