<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Band;
use App\Album;
use Auth;

class AlbumController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth')->except(['index']);
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
    public function store(Request $request, $idband)
    {
        $band = Band::find($idband);
        if(($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{

            $regras = [
                'nome'            => 'required|string|min:3|max:35',
                'data'            => 'required|date',
                'gravadora'       => 'required|string|min:2|max:50',
                'genero'          => 'required|string|min:3|max:100',
                'link'            => 'nullable',
            ];
            $mensagens = [
                'nome.required'     => 'O nome é obrigatório',
                'nome.string'       => 'O nome deve ser um texto válido.',
                'nome.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
                'nome.max'          => 'O nome deve conter, no máximo, 35 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',

                'gravadora.required'     => 'A gravadora é obrigatória.',
                'gravadora.string'       => 'A gravadora deve ser um texto válido.',
                'gravadora.min'          => 'A gravadora deve conter, no mínimo, 2 caracteres.',
                'gravadora.max'          => 'A gravadora deve conter, no máximo, 50 caracteres. O seu possui '.strlen($request->gravadora).' caraceteres.',

                'data.required'     => 'A data é obrigatória.',
                'data.date'       => 'A data deve ser uma data válida.',

                'genero.required'       => 'O gênero é obrigatório.',
                'genero.string'        => 'O gênero deve ser um texto válido.',
                'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
                'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $album = new Album();
            $album->name =$request->nome;
            $album->launch_date =$request->data;
            $album->recorder =$request->gravadora;
            $album->genre =$request->genero;
            $album->buy_url =$request->link;
            $album->band_id =$idband;

            $album->save();

            return redirect()->route('banda.painel', $idband);
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
        $album = Album::find($id);
        $band = Band::find($album->band_id);
        if(($album==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{
            return view('general_cruds.album.edit', ['album'=>$album]);
        }
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
        $album = Album::find($id);
        $band = Band::find($album->band_id);
        if(($album==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{
            $regras = [
                'nome'            => 'required|string|min:3|max:35',
                'data'            => 'required|date',
                'gravadora'       => 'required|string|min:2|max:50',
                'genero'          => 'required|string|min:3|max:100',
                'link'            => 'nullable',
            ];
            $mensagens = [
                'nome.required'     => 'O nome é obrigatório',
                'nome.string'       => 'O nome deve ser um texto válido.',
                'nome.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
                'nome.max'          => 'O nome deve conter, no máximo, 35 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',

                'gravadora.required'     => 'A gravadora é obrigatória.',
                'gravadora.string'       => 'A gravadora deve ser um texto válido.',
                'gravadora.min'          => 'A gravadora deve conter, no mínimo, 2 caracteres.',
                'gravadora.max'          => 'A gravadora deve conter, no máximo, 50 caracteres. O seu possui '.strlen($request->gravadora).' caraceteres.',

                'data.required'     => 'A data é obrigatória.',
                'data.date'       => 'A data deve ser uma data válida.',

                'genero.required'       => 'O gênero é obrigatório.',
                'genero.string'        => 'O gênero deve ser um texto válido.',
                'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
                'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $album->name =$request->nome;
            $album->launch_date =$request->data;
            $album->recorder =$request->gravadora;
            $album->genre =$request->genero;
            $album->buy_url =$request->link;

            $album->update();

            return redirect()->route('banda.painel', $band->id);
        }
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
