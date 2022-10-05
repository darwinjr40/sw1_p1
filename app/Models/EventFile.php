<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFile extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = ['id', 'url', 'urlP', 'event_id'];
    //requisitos para la asignacion masiva
    static $rules = [
        'url' => 'required',
        'urlP' => 'required',
        'event_id' => 'required',
    ];
}
