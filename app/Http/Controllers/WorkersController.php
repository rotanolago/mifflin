<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Note;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Worker::with(['notes' => fn ($query) => $query->orderBy('created_at', 'ASC')])->get()->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Add note to worker
     */
    public function addNote(Request $request, Worker $worker){

        try{

            $noteData = [
                'author' => auth()->user()->name,
                'content' => $request->content
            ];

            $note = new Note();
            $note->content = json_encode($noteData);
            $worker->notes()->save($note);

            return response()->json([ 
                'success' => true, 
                'data' => Worker::with(['notes' => fn ($query) => $query->orderBy('created_at', 'ASC')])->get()->all() 
            ]);
            
        } catch (\Exception $e){
            throw new \Exception($e->getMessage(),400);
        }
    }
}
