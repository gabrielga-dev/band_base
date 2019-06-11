<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;
use App\Event;
use Auth;

class EventController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth')->except(['']);
    }
    public function store(Request $request, $idband)
    {
    	$band = Band::find($idband);
    	if(($band==null)||($band->owner_id!=Auth::user()->id)){
    		return redirect()->back();
    	}
        $regras = [
            'nome'              => 'required|string|min:2|max:50',
            'data'              => 'required|date',
            'horario'           => 'required|date_format:H:i',
            'link'              => 'required|string',
            'nome_local'        => 'nullable|string|min:2|max:75',
            'rua'              	=> 'required|string|min:2|max:75',
            'complemento'       => 'nullable|string|min:2|max:75',
            'bairro'            => 'required|string|min:2|max:75',
            'cidade'            => 'required|string|min:2|max:75',
            'estado'            => 'required|string|min:2|max:75',
        ];
        $mensagens = [

        	'horario.required'=> 'O horário é obrigatório.',
        	'horario.date_format'=>	'O horário deve seguir o formato XX:xx.',

        	'data.required'=> 'A data é obrigatória.',
        	'data.date'=>	'A data deve ser uma data válida.',


        	'nome.required'=> 'O nome é obrigatório.',
        	'nome.string'=>	'O nome deve ser um texto válido.',
        	'nome.min'=> 'O nome deve ter, pelo menos, 2 caracteres.',
        	'nome.max'=> 'O nome deve ter, no máximo, 50 caracteres.',

        	
        	'nome.required'=> 'O nome é obrigatório.',
        	'nome.string'=>	'O nome deve ser um texto válido.',
        	'nome.min'=> 'O nome deve ter, pelo menos, 2 caracteres.',
        	'nome.max'=> 'O nome deve ter, no máximo, 50 caracteres.',
        	
        	'link.required'=> 'O link é obrigatório.',
        	'link.string'=>	'O link deve ser um texto válido.',
        	'link.min'=> 'O link deve ter, pelo menos, 2 caracteres.',
        	'link.max'=> 'O link deve ter, no máximo, 75 caracteres.',
        	
        	'nome_local.string'=>	'O nome do local deve ser um texto válido.',
        	'nome_local.min'=> 'O nome do local deve ter, pelo menos, 2 caracteres.',
        	'nome_local.max'=> 'O nome do local deve ter, no máximo, 75 caracteres.',
        	
        	'rua.required'=> 'A rua é obrigatória.',
        	'rua.string'=>	'A rua deve ser um texto válido.',
        	'rua.min'=> 'A rua deve ter, pelo menos, 2 caracteres.',
        	'rua.max'=> 'A rua deve ter, no máximo, 75 caracteres.',
        	
        	'complemento.string'=>	'O complemento deve ser um texto válido.',
        	'complemento.min'=> 'O complemento deve ter, pelo menos, 2 caracteres.',
        	'complemento.max'=> 'O complemento deve ter, no máximo, 75 caracteres.',
        	
        	'bairro.required'=> 'O bairro é obrigatório.',
        	'bairro.string'=>	'O bairro deve ser um texto válido.',
        	'bairro.min'=> 'O bairro deve ter, pelo menos, 2 caracteres.',
        	'bairro.max'=> 'O bairro deve ter, no máximo, 75 caracteres.',
        	
        	'cidade.required'=> 'A cidade é obrigatória.',
        	'cidade.string'=>	'A cidade deve ser um texto válido.',
        	'cidade.min'=> 'A cidade deve ter, pelo menos, 2 caracteres.',
        	'cidade.max'=> 'A cidade deve ter, no máximo, 75 caracteres.',
        	
        	'estado.required'=> 'O estado é obrigatório.',
        	'estado.string'=>	'O estado deve ser um texto válido.',
        	'estado.min'=> 'O estado deve ter, pelo menos, 2 caracteres.',
        	'estado.max'=> 'O estado deve ter, no máximo, 75 caracteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $evento = new Event();
        $evento->name = $request->input('nome');
        $evento->date = $request->input('data');
        $evento->time = $request->input('horario');
        $evento->Buy_url = $request->input('link');
        $evento->local_name = $request->input('nome_local');
        $evento->street = $request->input('rua');
        $evento->complement = $request->input('complemento');
        $evento->neighborhood = $request->input('bairro');
        $evento->city = $request->input('cidade');
        $evento->state = $request->input('estado');
        $evento->band_id = $idband;
        $evento->save();

        return redirect()->route('banda.painel', $idband);

    }

    public function delete($id, $idband)
    {
        $evento = Event::find($id);
        if($evento==null){
            return redirect()->back();
        }else{
            return view('general_cruds.event.delete', ['evento'=>$evento, 'idband'=>$idband]);
        }
    }

    public function destroy($id, $idband)
    {
        $evento = Event::find($id);
        if($evento!=null){
            if($evento->band->owner_id == Auth::user()->id){
                $evento->delete();
            }
        }
        return redirect()->route('banda.painel',$idband);
    }


    public function edit($id, $idband)
    {
        $evento = Event::find($id);
        if($evento==null){
            return redirect()->back();
        }else{
            return view('general_cruds.event.edit', ['evento'=>$evento, 'idband'=>$idband]);
        }
    }

    public function update(Request $request, $id, $idband)
    {

    	$band = Band::find($idband);
    	$evento = Event::find($id);
    	if(($band==null)||($band->owner_id!=Auth::user()->id)||($evento->band->id!=$idband)||($evento==null)||($evento->band->owner_id!=Auth::user()->id)){
    		return redirect()->back();
    	}
        $regras = [
            'nome'              => 'required|string|min:2|max:50',
            'data'              => 'required|date',
            'horario'           => 'required|date_format:H:i',
            'link'              => 'required|string',
            'nome_local'        => 'nullable|string|min:2|max:75',
            'rua'              	=> 'required|string|min:2|max:75',
            'complemento'       => 'nullable|string|min:2|max:75',
            'bairro'            => 'required|string|min:2|max:75',
            'cidade'            => 'required|string|min:2|max:75',
            'estado'            => 'required|string|min:2|max:75',
        ];
        $mensagens = [

        	'horario.required'=> 'O horário é obrigatório.',
        	'horario.date_format'=>	'O horário deve seguir o formato XX:xx.',

        	'data.required'=> 'A data é obrigatória.',
        	'data.date'=>	'A data deve ser uma data válida.',

        	
        	'nome.required'=> 'O nome é obrigatório.',
        	'nome.string'=>	'O nome deve ser um texto válido.',
        	'nome.min'=> 'O nome deve ter, pelo menos, 2 caracteres.',
        	'nome.max'=> 'O nome deve ter, no máximo, 50 caracteres.',
        	
        	'link.required'=> 'O link é obrigatório.',
        	'link.string'=>	'O link deve ser um texto válido.',
        	'link.min'=> 'O link deve ter, pelo menos, 2 caracteres.',
        	'link.max'=> 'O link deve ter, no máximo, 75 caracteres.',
        	
        	'nome_local.string'=>	'O nome do local deve ser um texto válido.',
        	'nome_local.min'=> 'O nome do local deve ter, pelo menos, 2 caracteres.',
        	'nome_local.max'=> 'O nome do local deve ter, no máximo, 75 caracteres.',
        	
        	'rua.required'=> 'A rua é obrigatória.',
        	'rua.string'=>	'A rua deve ser um texto válido.',
        	'rua.min'=> 'A rua deve ter, pelo menos, 2 caracteres.',
        	'rua.max'=> 'A rua deve ter, no máximo, 75 caracteres.',
        	
        	'complemento.string'=>	'O complemento deve ser um texto válido.',
        	'complemento.min'=> 'O complemento deve ter, pelo menos, 2 caracteres.',
        	'complemento.max'=> 'O complemento deve ter, no máximo, 75 caracteres.',
        	
        	'bairro.required'=> 'O bairro é obrigatório.',
        	'bairro.string'=>	'O bairro deve ser um texto válido.',
        	'bairro.min'=> 'O bairro deve ter, pelo menos, 2 caracteres.',
        	'bairro.max'=> 'O bairro deve ter, no máximo, 75 caracteres.',
        	
        	'cidade.required'=> 'A cidade é obrigatória.',
        	'cidade.string'=>	'A cidade deve ser um texto válido.',
        	'cidade.min'=> 'A cidade deve ter, pelo menos, 2 caracteres.',
        	'cidade.max'=> 'A cidade deve ter, no máximo, 75 caracteres.',
        	
        	'estado.required'=> 'O estado é obrigatório.',
        	'estado.string'=>	'O estado deve ser um texto válido.',
        	'estado.min'=> 'O estado deve ter, pelo menos, 2 caracteres.',
        	'estado.max'=> 'O estado deve ter, no máximo, 75 caracteres.',
        ];
        $this->validate($request,$regras,$mensagens);

        $evento->name = $request->input('nome');
        $evento->date = $request->input('data');
        $evento->time = $request->input('horario');
        $evento->Buy_url = $request->input('link');
        $evento->local_name = $request->input('nome_local');
        $evento->street = $request->input('rua');
        $evento->complement = $request->input('complemento');
        $evento->neighborhood = $request->input('bairro');
        $evento->city = $request->input('cidade');
        $evento->state = $request->input('estado');
        $evento->band_id = $idband;
        $evento->update();

        return redirect()->route('banda.painel', $idband);
    }

}
