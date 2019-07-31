<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
//Cadastro de Usuários
Route::post('/login/cadastro', function (Request $request) {

    $data = $request->all();

    $validacao = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    if ($validacao->fails()) {
        return $validacao->errors();
    }
    

    $user = User::create(
        [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'imagem' => 'perfil/semfoto.png'
        ]
    );
    //criar o token do usuário com base no email(unique)
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

//Login de Usuários
Route::post('/login', 'UserController@login', function (Request $request){});

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/perfil', function (Request $request) {
    $user = $request->user();
    $data = $request->all();

    if (isset($data['password'])) {
        $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validacao->fails()) {
            return $validacao->errors();
        }
        //return $data['password'];
        $data['password'] = Hash::make($data['password']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

    } else {
        $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        
        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
    }
    
    //verifica se mandou imagem, se sim tenta armazenar img no servidor e url no BD
    if (isset($data['imagem'])){
        //cria regra de validação para imagem. (mover isso para outro lugar Util... sei lá)
        Validator::extend('base64image', function($attribute, $value, $parameters, $validator) {
            $explode = explode(',', $value);
            $allow = ['png', 'jpg', 'svg', 'jpeg'];
            $format = str_replace(
                [
                    'data:image/',
                    ';',
                    'base64',
                ],
                [
                    '', '', '',
                ],
                $explode[0]
            );
        
            if (!in_array($format, $allow)){
                return false;
            }
            if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])){
                return false;
            }
            return true;
        });

        //aplica a regra de validação de imagem
        $validacao = Validator::make($data, [
            'imagem' => ['base64image'],
            
        ],['base64image' => 'imagem inválida!']);
        
        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $time = time();
        $diretorioPai = 'perfis';
        $diretorioImagem = $diretorioPai . DIRECTORY_SEPARATOR . $user->id;
        //pegar a estensão da imagem
        $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
        //return [$ext];
        $urlImagem = $diretorioImagem . DIRECTORY_SEPARATOR .$time . '.' . $ext;

        $file = str_replace('data:image/' . $ext . ';base64,', '', $data['imagem']);
        $file = base64_decode($file);
        
        //se não existir cria diretório
        if (!file_exists($diretorioPai)){
            mkdir($diretorioPai, 0700);
        }

        //se exitir a image e irei apagá-la
        if ($user->imagem){
            if(file_exists($user->imagem)){
                //remove o arquivo.
                unlink($user->imagem);
            }
        }

        //se não existir cria diretório
        if (!file_exists($diretorioImagem)){
            mkdir($diretorioImagem, 0700);
        }
        
        file_put_contents($urlImagem, $file);

        $user->imagem = $urlImagem;
    }

    //se tudo ocorreu certo, atualiza;
    $user->save();    

    //asset helper do Laravel que monta o caminho relativo para a imagem
    $user->imagem = asset($user->imagem);

    //criar o token do usuário com base no email(unique)
    $user->token = $user->createToken($user->email)->accessToken;
    return $user;
});
