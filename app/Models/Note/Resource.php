<?php

namespace App\Models\Note;

use App\Models\Note\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory ,SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resources';

    protected $fillable = [
        'id',
        'type',
        'note_id',
        'route'
    ];
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
