<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Conteudo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//#################################################################################
//                              USERS
//cadastro de usuários
Route::post('/login/cadastro', 'UserController@store');

//login de usuários
Route::post('/login', 'UserController@login');

//atualizando usuários
Route::middleware('auth:api')->put('/perfil', 'UserController@update');

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

//#################################################################################
//                              CONTEÚDOS
Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoController@store');

Route::middleware('auth:api')->get('/conteudo/lista', 'ConteudoController@lista');

//#################################################################################
//                              TESTES
Route::get('/testes', function(){
    //$user = User::find(1);

    //add conteudos
    // $user->conteudos()->create([
    //     'user_id' => '1',
    //     'titulo' => 'Que bacana aprender laravel!',
    //     'texto' => 'texto wow!',
    //     'imagem' => 'minha url de imagem...',
    //     'link' => 'um link qq',
    //     'data' => '2019-07-31'
    // ]);

    //return $user->conteudos;

    //add comentarios em conteudo
    // $conteudo = Conteudo::find(1);
    // $conteudo->comentarios()->create([
    //     'conteudo_id' => '1',
    //     'user_id' => '1',
    //     'texto' => 'Todos nós sabemos Thiago!',
    //     'data' => '2019-07-31 21:47:00'
    // ]);
    //return $conteudo->comentarios;

    //add amigos

    //$user = User::find(1);
    //$user2 = User::find(2);

    //permite repetição
    //$user->amigos()->attach($user2->id);
    //$user->amigos()->toggle($user2->id);
    //remover todas ocorrencias de amigos    
    //$user->amigos()->detach($user2->id);
    //tira ou retira o amigos, excelentes comando!
    //$user->amigos()->toggle($user2->id);


    //return [$user->amigos];
    //return $user->amigos;

     $user2 = User::find(2);
    // $conteudo = Conteudo::find(1);
    // $conteudo->curtidas()->toggle($user2->id);

    //return $conteudo->curtidas;


    //apaga conteudos:
    // $conteudos = Conteudo::all();
    // foreach($conteudos as $key => $value){
    //     $value->delete();
    // }

    return $user2->curtidas;

});