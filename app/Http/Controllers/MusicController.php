<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Band;
use App\Album;
use App\Music;
use Auth;

class MusicController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth')->except([]);
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
                'genero'          => 'required|string|min:3|max:100',
                'album'            => 'required',
            ];
            $mensagens = [
                'nome.required'     => 'O nome é obrigatório',
                'nome.string'       => 'O nome deve ser um texto válido.',
                'nome.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
                'nome.max'          => 'O nome deve conter, no máximo, 35 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',

                'genero.required'       => 'O gênero é obrigatório.',
                'genero.string'        => 'O gênero deve ser um texto válido.',
                'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
                'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',

                'album.required'       => 'O álbum é obrigatório.',
            ];
            $this->validate($request,$regras,$mensagens);

            $albumsBand = $band->albums;
            $boo = false;
            foreach ($albumsBand as $alb){
                if($alb->id == $request->album){
                    $boo = true;
                }
            }
            if($boo==false){
                return redirect()->back();
            }else{
                $musica = new Music();
                $musica->name =$request->nome;
                $musica->genre =$request->genero;
                $musica->album_id =$request->album;
                $musica->band_id =$idband;

                $musica->save();

                return redirect()->route('banda.painel', $idband);
            }
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
        $musica = Music::find($id);
        $band = Band::find($musica->band_id);
        if(($musica==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{
            return view('general_cruds.music.edit', ['musica'=>$musica, 'band'=>$band]);
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
        $musica = Music::find($id);
        $band = Band::find($musica->band_id);
        if(($musica==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{

            $regras = [
                'nome'            => 'required|string|min:3|max:35',
                'genero'          => 'required|string|min:3|max:100',
                'album'            => 'required',
            ];
            $mensagens = [
                'nome.required'     => 'O nome é obrigatório',
                'nome.string'       => 'O nome deve ser um texto válido.',
                'nome.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
                'nome.max'          => 'O nome deve conter, no máximo, 35 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',

                'genero.required'       => 'O gênero é obrigatório.',
                'genero.string'        => 'O gênero deve ser um texto válido.',
                'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
                'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',

                'album.required'       => 'O álbum é obrigatório.',
            ];
            $this->validate($request,$regras,$mensagens);

            $albumsBand = $band->albums;
            $boo = false;
            foreach ($albumsBand as $alb){
                if($alb->id == $request->album){
                    $boo = true;
                }
            }
            if($boo==false){
                return redirect()->back();
            }else{
                $musica->name =$request->nome;
                $musica->genre =$request->genero;
                $musica->album_id =$request->album;

                $musica->update();

                return redirect()->route('banda.painel', $band->id);
            }
        }
    }

    public function delete($id)
    {
        $musica = Music::find($id);
        $band = Band::find($musica->band_id);
        if(($musica==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{
            return view("general_cruds.music.delete", ['music'=>$musica]);
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
        $musica = Music::find($id);
        $band = Band::find($musica->band_id);
        if(($musica==null)||($band==null)||($band->owner_id!=Auth::user()->id)){
            return redirect()->back();
        }else{
            $musica->delete();
            return redirect()->route('banda.painel', $band->id);
        }

    }
}
