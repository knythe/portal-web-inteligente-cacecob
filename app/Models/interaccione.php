<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interaccione extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

     public function cliente()
    {
        return $this->belongsTo(cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(servicio::class);
    }
}
