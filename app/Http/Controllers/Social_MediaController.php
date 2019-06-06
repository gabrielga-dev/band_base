<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social_Media;
use Auth;

class Social_MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'link'              => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'nome'              => 'required|string|min:1|max:25',
        ];
        $mensagens = [
            'link.required'     => 'O link é obrigatório',
            'link.string'       => 'O link deve ser um texto válido.',
            'link.regex'          => 'O link deve ser um link válido.',

            'nome.required'     => 'O nome é obrigatório',
            'nome.string'       => 'O nome deve ser um texto válido.',
            'nome.min'          => 'O nome deve conter, no mínimo, 1 caracteres.',
            'nome.max'          => 'O nome deve conter, no máximo, 25 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $sm = new Social_Media();
        $sm->url = $request->link;
        $sm->name = $request->nome;
        $sm->band_id = $id;
        $sm->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $idband)
    {
        $sm = Social_Media::find($id);
        if($sm==null){
            return redirect()->back();
        }else{
            return view('general_cruds.social_media.edit', ['sm'=>$sm, 'idband'=>$idband]);
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
        $sm = Social_Media::find($id);
        if($sm==null){
            return redirect()->back();
        }else{
            $regras = [
                'link'              => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'nome'              => 'required|string|min:1|max:25',
            ];
            $mensagens = [
                'link.required'     => 'O link é obrigatório',
                'link.string'       => 'O link deve ser um texto válido.',
                'link.regex'          => 'O link deve ser um link válido.',

                'nome.required'     => 'O nome é obrigatório',
                'nome.string'       => 'O nome deve ser um texto válido.',
                'nome.min'          => 'O nome deve conter, no mínimo, 1 caracteres.',
                'nome.max'          => 'O nome deve conter, no máximo, 25 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $sm->url = $request->link;
            $sm->name = $request->nome;
            $sm->update();
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
        $sm = Social_Media::find($id);
        if($sm!=null){
            if($sm->band->owner_id == Auth::user()->id){
                $sm->delete();
            }
        }
        return redirect()->route('banda.painel',$idband);
    }

    public function delete($id, $idband)
    {
        $sm = Social_Media::find($id);
        if($sm==null){
            return redirect()->back();
        }else{
            return view('general_cruds.social_media.delete', ['sm'=>$sm, 'idband'=>$idband]);
        }
    }
}
