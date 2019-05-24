<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Storage;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user==null){
            return redirect()->route('inicio');
        }else{
            return view('general_cruds.user.show', ['user'=>$user]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id!=$id){
            return redirect()->route('inicio');
        }else{
            return view('general_cruds.user.edit',['user'=>User::find($id)]);
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

        $regras = [
            'name'              => 'required|string|min:3|max:75',
            'email'             => 'required|email|string|max:255|unique:users,email,'.Auth::user()->id.',id',
            'date_of_birth'     => 'nullable|date|date_format:Y-m-d|before:today',
            'age'               => 'nullable|integer|min:0',
            'artistic_name'     => 'nullable|string|max:30'
        ];
        $mensagens = [
            'name.required'     => 'O nome é obrigatório',
            'name.string'       => 'O nome deve ser um texto válido.',
            'name.min'          => 'O nome deve conter, no mínimo, 3 caracteres.',
            'name.max'          => 'O nome deve conter, no máximo, 75 caracteres. O seu possui '.strlen($request->name).' caraceteres.',

            'email.required'     => 'O email é obrigatório',
            'email.email'       => 'O email deve ser um email válido.',
            'email.string'       => 'O email deve ser um texto válido.',
            'email.max'          => 'O email deve conter, no máximo, 255 caracteres. O seu possui '.strlen($request->email).' caraceteres.',
            'email.unique'          => 'O email já está sendo utilizado.',

            'date_of_birth.date'     => 'A data de nascimento deve ser uma data válida.',
            'date_of_birth.date_format'          => 'A data de nascimento deve ter o seguinte formato: xx-xx-xxxx',
            'date_of_birth.before'          => 'A data de nascimento deve ser de antes deo dia de hoje.',

            'age.integer'     => 'A idade deve ser dada por um número inteiro.',
            'age.min'          => 'A idade deve ser maior ou igual a zero.',

            'artistic_name.string'     => 'O nome artístico deve ser um texto válido.',
            'artistic_name.max'          => 'O nome deve ter, no máximo, 30 caracteres. O seu possui '.strlen($request->name).' caraceteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth_date = $request->date_of_birth;
        $user->age = $request->age;
        $user->artistic_name = $request->artistic_name;
        $user->update();
        return redirect()->route('usuario.show', Auth::user()->id);
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

    public function mudaFoto(Request $request)
    {
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

        if(Auth::user()->file_name!='NA')
        {
            Storage::delete('public/fotos_perfis/'.Auth::user()->file_name);
        }
        //tratamento dos dados da imagem
        $imageName = date("Y_m_d-H_i_s-").kebab_case(Auth::user()->name).'.'.$request->foto->getClientOriginalExtension();
        $upload = $request->foto->storeAs('public/fotos_perfis', $imageName);
        if ( !$upload ){
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
        }
        $user = User::find(Auth::user()->id);
        $user->file_name = $imageName;
        $user->update();
        return redirect()->route('usuario.show', Auth::user()->id);
    }

    public function retiraFoto($id)
    {
        if(Auth::user()->file_name=='NA'){
            return redirect()
                        ->back()
                        ->with('error', 'Não é possível remover sua foto de perfil pois ela é a padrão.');
        }else{
            Storage::delete('public/fotos_perfis/'.Auth::user()->file_name);

            $user = User::find(Auth::user()->id);
            $user->file_name = 'NA';
            $user->update();
            return redirect()->route('usuario.show', Auth::user()->id);
        }
    }
}
