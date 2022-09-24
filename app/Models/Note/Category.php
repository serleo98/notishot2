<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'description',
        'status'
        ];
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
