<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;
    
    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public $incrementing = false;

    protected $keyType = 'string';
    
    /**
     * Get the parent anotable model (post or video).
     */
    public function target(): MorphTo
    {
        return $this->morphTo();
    }
}
