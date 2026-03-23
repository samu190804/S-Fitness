<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $table = 'routines';
    protected $primaryKey = 'CodR';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Name','Dias','Duracion','Nivel','Musculos','Descripcion','CodU'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'CodU', 'CodU');
    }

    public function ejercicios()
    {
        return $this->belongsToMany(Exercise::class, 'routines_exercises', 'CodR', 'CodE');
    }
}
