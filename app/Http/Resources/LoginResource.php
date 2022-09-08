<?php

namespace App\Http\Resources;


use App\Http\Resources\User\RoleResource;
use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'nick_name'=> $this->resource->nick_name,
            'email'=> $this->resource->email,
            'token' => $this->accessToken,
            'tokenType' => 'Bearer',
            'role' => new RoleResource($this->resource->role),
            //'profile' => new ProfileResource($this->resource->profile),
            ];
    }
}
