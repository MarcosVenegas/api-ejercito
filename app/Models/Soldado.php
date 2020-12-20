<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soldado extends Model
{
    use HasFactory;


    protected $primaryKey = 'numeroPlaca';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['updated_at','created_at'];



    public function equipos(){
    	return $this->belongsToMany(Equipo::class,'equipos-soldados','numeroPlaca','equipo_id');
    }
}