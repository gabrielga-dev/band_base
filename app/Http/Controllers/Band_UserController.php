<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Band;
use App\User;
use App\Band_user;

use Auth;

class Band_UserController extends Controller
{
	public function delete($idband)
	{
		$band = Band::find($idband);
		if(($band==null)||(Auth::user()->imof($idband)==false)){
			return redirect()->back();
		}else{
			return view('general_cruds.user_band.delete', ['band'=>$band]);
		}
	}

	public function destroy($idband)
	{
		$band = Band::find($idband);
		if(($band==null)||(Auth::user()->imof($idband)==false)){
			return redirect()->back();
		}else{
			$ligacao = Band_user::where('band_id', '=', $idband)->where('user_id', '=', Auth::user()->id);
			$ligacao->delete();
			return redirect()->route('banda.index');
		}
	}
}
