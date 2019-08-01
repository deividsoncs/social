<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'conteudo_id', 'user_id', 'texto', 'data'
    ];

    protected $casts = [
        'data' => 'datetime'
    ];

    
}
