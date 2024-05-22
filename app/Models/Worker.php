<?php

namespace App\Models;

use App\HasNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Worker extends Model
{
    use HasFactory, HasNotes;

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
    
}
