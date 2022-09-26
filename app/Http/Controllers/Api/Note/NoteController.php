<?php

namespace App\Http\Controllers\Api\Note;

use App\Models\Note\Note;
use App\Models\Note\Resource;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Note\NoteResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;

class NoteController extends Controller
{
    protected $NoteResource = NoteResource::class;
    public function __construct(Note $nota)
    {
        $this->nota= $nota;
    }
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
        $user = Auth::user()->id;
        $validate=Validator::make($request->all(),[$this->NoteResource]);
        $validate->fails() ? response()->json(['data' => $validate->errors()]) : $request['user_id'] = $user;
        $note = Note::create($request->all());
        if(isset($request['resource'])){
            $path = Storage::putFileAs('/public/resource/imagenes',$request['resource'],Carbon::now()->format('YmdHis').'.jpg');
            $ext = File::extension($path);
            $resource['note_id'] = $note->id;
            $resource['type'] = $ext;
            $resource['route']  = Storage::url($path);
            $resource = Resource::create($resource);
            $note = $this->nota->where('id', $note->id)->with('resources')->first();
        };        
        return response()->json(['data' => new NoteResource($note)]);
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
        $this->nota = Note::where('id',$note->id)->first();   
        $this->nota->fill($request->all());
        $this->nota->save();
        if(isset($data['resource'])){
            $resource = Resource::where('user_id', $this->user->id)->first();
            $resource->update($data['resource'],$resource);
        }
        return response(['Note' => $request->all(), 
        'message' => 'Update Note successfully'], 200);
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
