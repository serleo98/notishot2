<?php

namespace App\Http\Controllers\Api\Note;

use App\Models\Note\Note;
use App\Http\Controllers\Controller;
use App\Http\Resources\Note\NoteResource;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth= auth('api')->user()->id;
        $notes = Note::with(['resources'])->get()->where('user_id',$userAuth);
        $listaNotas = NoteResource::collection($notes);
        return response()->json([
            'data' => $listaNotas
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $nota = Note::with(['resources'])->where('id',$note->id)->first();
        $noteResource = new NoteResource($nota);
        return response()->json([
            'data' => $noteResource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {
        dd($request);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     * @param  \App\Models\Note\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
