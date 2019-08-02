<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'imagem'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];    
    
    public function conteudos()
    {
        return $this->hasMany('App\Conteudo');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function amigos(){
        return $this->belongsToMany('App\User', 'amigos', 'user_id', 'amigo_id');
    }

    public function curtidas()
    {
      return $this->belongsToMany('App\Conteudo', 'curtidas', 'user_id', 'conteudo_id');
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
}
