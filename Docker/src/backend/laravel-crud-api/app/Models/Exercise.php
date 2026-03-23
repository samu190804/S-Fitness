<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercises';
    protected $primaryKey = 'CodE';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Name','Musculo','Series','Repeticiones','Descripcion','Video','CodU'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'CodU', 'CodU');
    }

    public function rutinas()
    {
        return $this->belongsToMany(Routine::class, 'routines_exercises', 'CodE', 'CodR');
    }
}
