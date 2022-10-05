<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    //endpoints, para las relaciones
    protected $allowIncluded = ['eventos'];
    //para la api, por el cual se va poder filtrar
    protected $allowFilter = ['id', 'nombre', 'descripcion'];
    //para la api, por el cual se va poder ordenar
    protected $allowSort = ['id', 'nombre', 'descripcion'];
    //asignacion masiva
    protected $fillable = ['id', 'nombre', 'descripcion'];

    public function eventos()
    {
        return $this->hasMany(Event::class);
    }
}
