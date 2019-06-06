<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Band;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['show']);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $regras = [
            'titulo'              => 'required|string|min:1|max:30',
            'resumo'             => 'nullable|string|max:255',
            'conteudo'            => 'required|min:3|max:500',
        ];
        $mensagens = [
            'titulo.required'     => 'O título é obrigatório',
            'titulo.string'       => 'O título deve ser um texto válido.',
            'titulo.min'          => 'O título deve conter, no mínimo, 1 caracteres.',
            'titulo.max'          => 'O título deve conter, no máximo, 30 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',

            'resumo.string'       => 'O resumo deve ser um texto válido.',
            'resumo.min'          => 'O resumo deve conter, no mínimo, 1 caracteres.',
            'resumo.max'          => 'O resumo deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->resumo).' caraceteres.',

            'conteudo.required'     => 'O conteúdo é obrigatório',
            'conteudo.string'       => 'O conteúdo deve ser um texto válido.',
            'conteudo.min'          => 'O conteúdo deve conter, no mínimo, 3 caracteres.',
            'conteudo.max'          => 'O conteúdo deve conter, no máximo, 500 caracteres. O seu possui '.strlen($request->conteudo).' caraceteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $post = new Post();
        $post->title = $request->titulo;
        $post->brief = $request->resumo;
        $post->content = $request->conteudo;
        $post->band_id = $id;
        $post->save();
        return redirect()->route('banda.painel', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post==null){
            return redirect()->back();
        }else{
            return view('general_cruds.post.show', ['post'=>$post]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $idband)
    {
        $post = Post::find($id);
        if($post==null){
            return redirect()->back();
        }else{
            return view('general_cruds.post.edit', ['post'=>$post, 'idband'=>$idband]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idband)
    {
        $post = Post::find($id);
        $ownid = $post->band->owner_id;
        if($ownid != Auth::user()->id){
            return redirect()->back();
        }else{
            $regras = [
                'titulo'              => 'required|string|min:1|max:30',
                'resumo'             => 'nullable|string|max:255',
                'conteudo'            => 'required|min:3|max:500',
            ];
            $mensagens = [
                'titulo.required'     => 'O título é obrigatório',
                'titulo.string'       => 'O título deve ser um texto válido.',
                'titulo.min'          => 'O título deve conter, no mínimo, 1 caracteres.',
                'titulo.max'          => 'O título deve conter, no máximo, 30 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',

                'resumo.string'       => 'O resumo deve ser um texto válido.',
                'resumo.min'          => 'O resumo deve conter, no mínimo, 1 caracteres.',
                'resumo.max'          => 'O resumo deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->resumo).' caraceteres.',

                'conteudo.required'     => 'O conteúdo é obrigatório',
                'conteudo.string'       => 'O conteúdo deve ser um texto válido.',
                'conteudo.min'          => 'O conteúdo deve conter, no mínimo, 3 caracteres.',
                'conteudo.max'          => 'O conteúdo deve conter, no máximo, 500 caracteres. O seu possui '.strlen($request->conteudo).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $post->title = $request->titulo;
            $post->brief = $request->resumo;
            $post->content = $request->conteudo;
            $post->update();
            return redirect()->route('banda.painel', $idband);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idband)
    {
        $post = Post::find($id);
        if($post!=null){
            if($post->band->owner_id == Auth::user()->id){
                $post->delete();
            }
        }
        return redirect()->route('banda.painel',$idband);
    }

    public function delete($id, $idband)
    {
        $post = Post::find($id);
        if($post==null){
            return redirect()->back();
        }else{
            return view('general_cruds.post.delete', ['post'=>$post, 'idband'=>$idband]);
        }
    }
}
