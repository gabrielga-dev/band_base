<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Band;
use Auth;

class IntegranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['show']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idband)
    {
        $integ = User::where('tag','=', $request->tag)->first();
        $band = Band::find($idband);

        if(($band==null)||($band->owner_id != Auth::user()->id)){
            return redirect()->back();

        }else if($integ==null){
            return redirect()
                        ->back()
                        ->with('Não há alguém com essa tag');

        }else if($this->verifica($band->id,$integ->id)==true){
            return redirect()
                        ->back()
                        ->with('Esta pessoa já faz parte desta banda.');

        }else{
            $regras = [
                'functions'       => 'required|string|min:3|max:100',
                'tag'             => 'required|string|max:50',
            ];
            $mensagens = [
                'functions.required'     => 'As funções são obrigatórias',
                'functions.string'       => 'As funções devem ser um texto válido.',
                'functions.min'          => 'As funções devem conter, no mínimo, 3 caracteres.',
                'functions.max'          => 'As funções devem conter, no máximo, 100 caracteres. As suas possuem '.strlen($request->functions).' caraceteres.',

                'tag.required'           => 'A tag é obrigatório',
                'tag.min'                => 'A tag deve conter, no mínimo, 1 caracteres.',
                'tag.max'                => 'A tag deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->tag).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $band->musicians()->attach($integ->id,['functions'=>$request->functions]);
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

    private function verifica($idband,$idInteg)
    {
        $boo = false;
        $band = Band::find($idband);
        foreach ($band->musicians as $mus) {
            if($mus->id==$idInteg){
                $boo = true;
            }
        }
        return $boo;
    }
}
