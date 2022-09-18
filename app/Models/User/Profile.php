<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'last_name',
        'cel_phone',
        'phone',
        'profile_photo',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'blog_personal_url',
        'city',
        'province',
        'country',
        'postal_code',
        'accepted',
        'accepted_by',
        'accepted_at'
    ];

    public function acceptedBy(){
        return $this->hasOne(User::class, 'id', 'accepted_by');
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
