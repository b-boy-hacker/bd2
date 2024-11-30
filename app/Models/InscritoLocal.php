<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscritoLocal extends Model
{
    public function inscritoCantidads()
    {
        
        return $this->hasMany(InscritoCantidad::class, 'local_id');
    }

}
