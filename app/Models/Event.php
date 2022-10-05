<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Event extends Model
{
    use HasFactory, ApiTrait;

    static $rules = [
		'titulo' => 'required',
        'tipo' => 'required',
		'descripcion' => 'required',
        'fecha' => 'required',
        'category_id' => 'required',
    ];
    //endpoints, para las relaciones
    protected $allowIncluded = ['categoria'];
    //para la api, por el cual se va poder filtrar
    protected $allowFilter = ['id', 'titulo', 'tipo', 'fecha'];
    //para la api, por el cual se va poder ordenar
    protected $allowSort = ['id', 'titulo', 'tipo', 'fecha'];
    //asignacion masiva
    protected $fillable = ['id', 'titulo', 'tipo', 'descripcion','fecha', 'category_id'];


    public function categoria()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
// otra opcion
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
