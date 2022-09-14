<?php

namespace App\Http\Controllers\Api\User;


use App\Models\User\User;
use App\Models\User\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRequest = UserRequest::class;
    protected $resource = UserResource::class;
    
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
        $validate=Validator::make($data,[$this->resource]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $user = User::create($data);
        return response([ 'User' => new UserResource($user), 
        'message' => 'Success'], 200);
    }
    
    public function update($user, Array $data) 
    {        
        /*if(isset($data['profile'])){
        
            $profile = Profile::where('user_id', $user->id)->first();
            $this->profileRepository->update($data['profile'],$profile);
        }
        $user = User::create($data);
        return response([ 'User' => new UserResource($user), 
        'message' => 'Success'], 200);*/
    }

   /* public function destroy($user)
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
