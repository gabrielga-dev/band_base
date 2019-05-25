<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;
use Auth;

class BandController extends Controller
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
        $bandsOwn = Auth::user()->bandsOwn()->get();
        $bandsOf = Auth::user()->bandsOf()->get();

        return view('general_cruds.band.index', ['bandsOwn'=>$bandsOwn, 'bandsOf'=>$bandsOf]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general_cruds.band.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome'              => 'required|string|min:3|max:100',
            'email'             => 'required|email|string|max:255',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genero'            => 'nullable|min:3|max:100',
        ];
        $mensagens = [
            'nome.required'     => 'O nome é obrigatório',
            'nome.string'       => 'O nome deve ser um texto válido.',
            'nome.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
            'nome.max'          => 'O nome deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',

            'email.required'    => 'O email é obrigatório',
            'email.email'       => 'O email deve ser um email válido.',
            'email.string'      => 'O email deve ser um texto válido.',
            'email.max'         => 'O email deve conter, no máximo, 255 caracteres. O seu possui '.strlen($request->email).' caraceteres.',

            'foto.required'     => 'A foto é obrigatória',
            'foto.image'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
            'foto.mimes'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
            'foto.max'          =>'A foto excedeu o tamanho máximo aceitável',

            'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
            'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $imageName;
        if($request->foto==null){
            $imageName = 'NA';
        }else{
            //tratamento dos dados da imagem
            $imageName = date("Y_m_d-H_i_s-").kebab_case($request->nome).'.'.$request->foto->getClientOriginalExtension();
            $upload = $request->foto->storeAs('public/fotos_bandas', $imageName);
            if ( !$upload ){
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            }
        }
        $band = new Band();
        $band->name = $request->nome;
        $band->email = $request->email;
        $band->file_name = $imageName;
        $band->views = 0;
        if($request->genero == ""){
            $band->genre = "Não especificado.";
        }else{
            $band->genre = $request->genero;
        }
        $band->active = true;
        $band->owner_id = Auth::user()->id;
        $band->save();
        return redirect()->route('banda.index');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

}
