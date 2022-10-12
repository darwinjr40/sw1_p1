<?php

namespace App\Models;

use App\Http\Controllers\ApareceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cliente', 'nit', 'fecha', 'total', 'pago'];

    public function apareces()
    {
      return $this->hasMany(Aparece::class);
    }
}
