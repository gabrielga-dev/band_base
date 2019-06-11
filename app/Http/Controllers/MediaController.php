<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Band;
use Auth;
use Storage;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'galeria']);
    }

    public function galeria($idband)
    {
        $banda = Band::find($idband);
        if($banda==null){
            return redirect()->back();
        }else{
            $fotos = $banda->medias->where('type','=',0);
            $videos = $banda->medias->where('type','=',1);
            return view('general_cruds.band.galery', ['fotos'=>$fotos, 'videos'=>$videos, 'banda'=>$banda]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //dd($request->tipo);
        $med = new Media();
        $med->type = $request->tipo;
        if($request->tipo==0){
            $regras = [
                'titulo'              => 'nullable|string|min:2|max:50',
                'desc'              => 'nullable|string|min:2|max:500',
                'foto'              => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $mensagens = [
                'titulo.string'       => 'O título deve ser um texto válido.',
                'titulo.min'          => 'O título deve conter, no mínimo, 2 caracteres.',
                'titulo.max'          => 'O título deve conter, no máximo, 50 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',

                'desc.string'       => 'A descrição deve ser um texto válido.',
                'desc.min'          => 'A descrição deve conter, no mínimo, 2 caracteres.',
                'desc.max'          => 'A descrição deve conter, no máximo, 500 caracteres. A sua possui '.strlen($request->titulo).' caraceteres.',

                'foto.required'     => 'A foto é obrigatória',
                'foto.image'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
                'foto.mimes'        =>'A foto deve ser uma imagem (jpeg,png,jpg)',
                'foto.max'          =>'A foto excedeu o tamanho máximo aceitável'
            ];
            $this->validate($request,$regras,$mensagens);

            //MANIPULACAO DO NOME DA IMAGEM
            $imageName = date("Y_m_d-H_i_s-").kebab_case(Band::find($id)->name).'.'.$request->foto->getClientOriginalExtension();
            $upload = $request->foto->storeAs('public/media', $imageName);
            if ( !$upload ){
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            }

            $med->file_name = $imageName;
            $med->title = $request->titulo;
            $med->description = $request->desc;
            $med->band_id = $id;
            $med->save();
            return redirect()->route('banda.painel', $id);


        }else if($request->tipo==1){
            $regras = [
                'link'              => 'required',
            ];
            $mensagens = [
                'link.required'     => 'O link é obrigatório',
            ];
            $this->validate($request,$regras,$mensagens);

            $med->url = $request->link;
            $med->band_id = $id;
            $med->save();
            return redirect()->route('banda.painel', $id);

            
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idband)
    {
        $banda = Band::find($idband);
        $foto = Media::find($id);
        if(($banda==null)||($foto==null)||($foto->type==1)){
            return redirect()->back();
        }else{
            return view('general_cruds.media.show', ['foto'=>$foto, 'banda'=>$banda]);
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
        $med = Media::find($id);
        if($med==null){
            return redirect()->back();
        }else{
            return view('general_cruds.media.edit', ['med'=>$med, 'idband'=>$idband]);
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
        $med = Media::find($id);
        if($med->type==0){
            $regras = [
                'titulo'              => 'nullable|string|min:2|max:50',
                'desc'              => 'nullable|string|min:2|max:500',
            ];
            $mensagens = [
                'titulo.string'       => 'O título deve ser um texto válido.',
                'titulo.min'          => 'O título deve conter, no mínimo, 2 caracteres.',
                'titulo.max'          => 'O título deve conter, no máximo, 50 caracteres. O seu possui '.strlen($request->titulo).' caraceteres.',

                'desc.string'       => 'A descrição deve ser um texto válido.',
                'desc.min'          => 'A descrição deve conter, no mínimo, 2 caracteres.',
                'desc.max'          => 'A descrição deve conter, no máximo, 500 caracteres. A sua possui '.strlen($request->titulo).' caraceteres.',
            ];
            $this->validate($request,$regras,$mensagens);

            $med->title = $request->titulo;
            $med->description = $request->desc;
            $med->update();
            return redirect()->route('banda.painel', $idband);


        }else if($med->type==1){
            $regras = [
                'link'              => 'required',
            ];
            $mensagens = [
                'link.required'     => 'O link é obrigatório',
            ];
            $this->validate($request,$regras,$mensagens);

            $med->url = $request->link;
            $med->update();
            return redirect()->route('banda.painel', $idband);

            
        }else{
            return redirect()->back();
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
        $med = Media::find($id);
        if($med!=null){
            if($med->band->owner_id == Auth::user()->id){
                Storage::delete('public/media/'.$med->file_name);
                $med->delete();
            }
        }
        return redirect()->route('banda.painel',$idband);
    }

    public function delete($id, $idband)
    {
        $med = Media::find($id);
        if($med==null){
            return redirect()->back();
        }else{
            return view('general_cruds.media.delete', ['med'=>$med, 'idband'=>$idband]);
        }
    }
}
