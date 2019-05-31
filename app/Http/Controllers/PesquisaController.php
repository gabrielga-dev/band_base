<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;

class PesquisaController extends Controller
{
    public function pesquisa(Request $request)
    {
    	$bands = Band::where('name','like','%'.$request->pesquisa.'%')->get();
    	return view('search.search',['bands'=>$bands, 'search'=>$request->pesquisa]);
    }
}
