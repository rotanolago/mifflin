<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Worker $user)
    {
        return response()->json([ 
            'success' => true, 
            'data' => $user->notes()->orderBy('created_at')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $noteData = [
                'author' => auth()->user()->name,
                'content' => $request->content
            ];

            $note = Note::findOrFail($id);
            $note->content = json_encode($noteData);
            $note->save();

            return response()->json([ 
                'success' => true,
                'data' => Worker::with(['notes' => fn ($query) => $query->orderBy('created_at', 'ASC')])->get()->all() 
            ]);

        } catch (\Exception $e){
            throw new \Exception($e->getMessage(),400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        
        return response()->json([ 
            'success' => true,
            'data' => Worker::with(['notes' => fn ($query) => $query->orderBy('created_at', 'ASC')])->get()->all() 
        ]);

    }
}
