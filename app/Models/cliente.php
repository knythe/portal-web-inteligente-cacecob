<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function interacciones()
    {
        return $this->hasMany(interaccione::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(recomendacione::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
