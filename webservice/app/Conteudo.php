<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conteudo extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'user_id', 'titulo', 'texto', 'imagem', 'link', 'data'
    ];

    protected $casts = [
        'data' => 'datetime',
    ];

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

}
