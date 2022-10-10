<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparece extends Model
{
    use HasFactory;
    protected $primaryKey = ['paper_id', 'paper_file_id'];
    //asignacion masiva
    protected $fillable = ['paper_id', 'paper_file_id', 'url', 'urlP'];
}
