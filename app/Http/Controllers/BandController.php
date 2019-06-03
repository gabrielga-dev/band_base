<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;
use App\User;
use App\Band_User;
use Auth;
use Storage;

class BandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['show','page']);
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


        if($request->e_integrante!=null){
            $regras = [
                'funcao'              => 'required|string|min:3|max:100',
            ];
            $mensagens = [
                'funcao.required'     => 'A função é obrigatório',
                'funcao.string'       => 'A função deve ser um texto válido.',
                'funcao.min'          => 'A função deve conter, no mínimo, 3 caracteres.',
                'funcao.max'          => 'A função deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $user = User::find(Auth::user()->id);
            $user->bandsOf()->attach($band,['functions'=>$request->funcao]);
        }
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
        $regras = [
            'nome'              => 'required|string|min:3|max:100',
            'email'             => 'required|email|string|max:255',
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

            'genero.min'        => 'O gênero deve conter, no mínimo, 3 caracteres.',
            'genero.max'        => 'O gênero deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->genero).' caraceteres.',
        ];
        $this->validate($request,$regras,$mensagens);
        $band = Band::find($id);

        $band->name = $request->nome;
        $band->email = $request->email;
        if($request->genero == ""){
            $band->genre = "Não especificado.";
        }else{
            $band->genre = $request->genero;
        }
        $band->update();


        if($request->e_integrante!=null){
            $regras = [
                'funcao'              => 'required|string|min:3|max:100',
            ];
            $mensagens = [
                'funcao.required'     => 'A função é obrigatório',
                'funcao.string'       => 'A função deve ser um texto válido.',
                'funcao.min'          => 'A função deve conter, no mínimo, 3 caracteres.',
                'funcao.max'          => 'A função deve conter, no máximo, 100 caracteres. O seu possui '.strlen($request->nome).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $band->musicians()->detach(Auth::user()->id);

            $user = User::find(Auth::user()->id);
            $user->bandsOf()->attach($band,['functions'=>$request->funcao]);
        }else{
            $band->musicians()->detach(Auth::user()->id);
        }
        return redirect()->route('banda.painel',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $band = Band::find($id);
        if($band!=null){
            if($band->owner_id == Auth::user()->id){
                $band->delete();
            }
        }
        return redirect()->route('banda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $band = Band::find($id);
        if($band->owner_id != Auth::user()->id){
            return redirect()->route('banda.index');
        }else{
            return view('general_cruds.band.delete', ['band'=>$band]);
        }
    }

    public function page($id)
    {
        $band = Band::find($id);
        if($band == null){
            return redirect()->back();
        }else{
            $band->views+=1;
            $band->update();
            return view('general_cruds.band.page',['band'=>$band]);
        }
    }

    public function control_panel($id)
    {
        $band = Band::find($id);
        if(Auth::user()->id!=$band->owner_id){
            return redirct()->back();
        }else{
            $functions;
            if(!Auth::user()->imOf($id)){
                $functions = null;
            }else{
                $functions = Band_User::where([
                    ['user_id', '=', Auth::user()->id],
                    ['band_id', '=', $id],
                ])->get()->first()->functions;
            }
            return view('general_cruds.band.control_panel', ['band'=>$band, 'functions'=> $functions]);
        }
    }

    public function mudaFoto(Request $request, $id)
    {
        $band = Band::find($id);
        if($band == null){
            return redirect()->back();
        }else{
            $regras = [
                'foto'              => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ];
            $mensagens = [
                'foto.required'     => 'A foto é obrigatória',
                'foto.image'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
                'foto.mimes'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
                'foto.max'          =>'A foto excedeu o tamanho máximo aceitável'
            ];
            $this->validate($request,$regras,$mensagens);

            if($band->file_name!='NA')
            {
                Storage::delete('public/fotos_bandas/'.$band->file_name);
            }
            //tratamento dos dados da imagem
            $imageName = date("Y_m_d-H_i_s-").kebab_case($band->name).'.'.$request->foto->getClientOriginalExtension();
            $upload = $request->foto->storeAs('public/fotos_bandas', $imageName);
            if ( !$upload ){
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            }
            $band->file_name = $imageName;
            $band->update();
            return redirect()->route('banda.painel', $id);
        }
    }

    public function retiraFoto($id)
    {
        $band = Band::find($id);
        if($band->file_name=='NA'){
            return redirect()
                        ->back()
                        ->with('error', 'Não é possível remover sua foto de perfil pois ela é a padrão.');
        }else{
            Storage::delete('public/fotos_bandas/'.$band->file_name);

            $band->file_name = 'NA';
            $band->update();
            return redirect()->route('banda.painel', $id);
        }
    }

    public function mudaBio(Request $request, $id)
    {
        $band = Band::find($id);
        if($band == null){
            return redirect()->back();
        }else{
            $regras = [
                'conteudo'              => 'required|string|max:500|min:10'
            ];
            $mensagens = [
                'conteudo.required'     => 'O conteúdo é obrigatório.',
                'conteudo.string'        =>'O conteúdo deve ser um texto válido.',
                'conteudo.max'        =>'O conteúdo deve ter, no máximo, 500 caracteres.',
                'conteudo.min'          =>'O conteúdo deve ter, pelo menos, 10 caracteres.'
            ];
            $this->validate($request,$regras,$mensagens);
            $band->history = $request->conteudo;
            $band->update();
            return redirect()->route('banda.painel', $id);
        }
    }
}
