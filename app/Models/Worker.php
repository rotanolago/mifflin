<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Worker extends Model
{
    use HasFactory;

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    
    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'age',
        'position',
        'office',
        'phone',
        'email'
    ];
    
    /**
     * Get all of the workers's notes.
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'target');
    }
}
