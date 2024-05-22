<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Note;

trait HasNotes
{
    
    /**
     * Get all of the workers's notes.
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'target');
    }

}
