<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    use HasFactory;
    //asignacion masiva
    protected $fillable = ['id', 'url', 'urlP', 'user_id'];
    //requisitos para la asignacion masiva
    static $rules = [
        'url' => 'required',
        'urlP' => 'required',
        'user_id' => 'required',
    ];
}
