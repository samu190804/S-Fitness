<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'CodU';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'Name',
        'UserName',
        'Email',
        'Password',
        'admin',
        'Img'
    ];

    protected $hidden = [
        'Password',
        'remember_token'
    ];
    
    protected $authPasswordName = 'Password'; // columna real de password
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function ejercicios()
    {
        return $this->hasMany(Exercise::class, 'CodU', 'CodU');
    }

    public function rutinas()
    {
        return $this->hasMany(Routine::class, 'CodU', 'CodU');
    }
}
