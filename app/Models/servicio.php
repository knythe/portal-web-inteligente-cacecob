<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }

    public function interacciones()
    {
        return $this->hasMany(interaccione::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(recomendacione::class);
    }
}
