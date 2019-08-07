<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //realiza o login     
    public function login(Request $request){
        $data = $request->all();

        //realiza validação
        $validacao = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        if ($validacao->fails()) {
            return ['status'=> false, 'validacao' => true, 'erros' => $validacao->errors()];
        }        
        try { 
        //autentica o usuário
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = auth()->user();
                //criar o token do usuário com base no email(unique)
                $user->token = $user->createToken($user->email)->accessToken;
                //asset helper do Laravel que monta o caminho relativo para a imagem
                //$user->imagem = asset($user->imagem);            
                return ['status' => true, 'usuario' => $user];
            } else {
                return ['status' => false];
            }
        }catch (Exception $e){
            return  ['status' => false, 'exceptions' => $e->getMessage()];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //return $data;

        $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    
        if ($validacao->fails()) {
            return ['status'=> false, 'validacao' => true, 'erros' => $validacao->errors()];
        }
        
    
        $user = User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'imagem' => 'perfis/semfoto.png'
            ]
        );
        //criar o token do usuário com base no email(unique)
        $user->token = $user->createToken($user->email)->accessToken;
        
        if ($user->id > 0){
            return ['status'=> true, 'usuario' => $user];
            
        }else{
            return ['status'=> false, 'validacao' => false];
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->all();

        if (isset($data['password'])) {
            $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            if ($validacao->fails()) {
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
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
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
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
                return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
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
                //tabalho para retirar o URL da imagem externa para verificar na pasta
                $imgUser = str_replace(asset('/'), '', $user->imagem);

                if(file_exists($imgUser)){
                    //remove o arquivo.
                    unlink($imgUser);
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
        //$user->imagem = asset($user->imagem);

        //criar o token do usuário com base no email(unique)
        $user->token = $user->createToken($user->email)->accessToken;
        return ['status' => true, 'validacao' => false, 'usuario' => $user];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
