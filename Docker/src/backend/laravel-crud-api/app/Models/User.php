<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
     protected $table = 'usuarios';
    protected $primaryKey = 'CodU';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Name', 'UserName', 'Email', 'Password', 'admin', 'Img'
    ];

    public function ejercicios()
    {
        return $this->hasMany(Exercise::class, 'CodU', 'CodU');
    }

    public function rutinas()
    {
        return $this->hasMany(Routine::class, 'CodU', 'CodU');
    }
}
