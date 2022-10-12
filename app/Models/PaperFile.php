<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperFile extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = ['id', 'url', 'urlP', 'paper_id'];
    //requisitos para la asignacion masiva
    static $rules = [
        // 'url' => 'required',
        // 'urlP' => 'required',
        'paper_id' => 'required',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function apareces()
    {
        return $this->hasMany(Aparece::class);
    }
}
