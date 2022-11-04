<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Un post pertenece a un usuario, y la consulta trae solo el name y username
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
}