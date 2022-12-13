<?php

namespace Database\Seeders;

use App\Models\Note\Note;
use App\Models\Note\Resource;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_note = Note::where('id',1)->first();
        $created_resource_note = Resource::create([
            'note_id' => $created_note->id,
            'route' => Carbon::now()->format('YmdHis').'.jpg',
            'type' => '.jpg',
            
        ]);
    }
}