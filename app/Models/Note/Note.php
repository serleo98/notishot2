<?php

namespace App\Models\Note;

use App\Models\User\User;
use App\Models\Note\Category;
use App\Models\Note\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notes';

    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'location',
        'body',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
    /*public function comments()
    {
        return $this->hasMany(Comment::class);
    }*/
}
