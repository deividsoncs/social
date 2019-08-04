<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;

class ConteudoController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        


        return ['ok'];
        //add conteudos
        $data = $request->all();
        //usuário que está logado!
        $user = $request->user();

        $validacao = Validator::make($data, [
            'titulo' => ['required', 'string', 'max:255'],
            'texto' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, 'erros' => $validacao->errors()];
        }
        return ['status' => true, 'conteudos' => $user->conteudos];

        $conteudo = new Conteudo;
        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        $conteudo->link = $data['link'] ? $data['link'] : '#';
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : '#';
        $conteudo->data = date('Y-m-d H:i:s');

        //save quanto temos um Objeto:        
        $user->conteudos()->save($conteudo);
        return ['status' => true, 'conteudos' => $user->conteudos];

        //create usas-se quanto array para salvar:
        //     $user->conteudos()->create([
        //         'user_id' => '1',
        //         'titulo' => 'Que bacana aprender laravel!',
        //         'texto' => 'texto wow!',
        //         'imagem' => 'minha url de imagem...',
        //         'link' => 'um link qq',
        //         'data' => '2019-07-31'
        //    ]);
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
    public function update(Request $request, $id)
    {
        //
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
