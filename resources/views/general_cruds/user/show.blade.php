@extends('layouts.layout_master')
@section('title', 'Seu Perfil')
@section('content')
	<div class="linha">
		<div class="col-l col-4 pula-1">
			<div class="col-l col-5">
				@if($user->file_name == 'NA')
					<img class="profile-pic big-pic" src="{{url('storage/default_images/user_default.png')}}">
				@else
					<img class="profile-pic big-pic" src="{{url('storage/fotos_perfis/'.$user->file_name)}}">
				@endif
				<form action="{{ route('usuario.muda_foto')}}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-input">
						<input type="file" name="foto" id="foto" class="inpt-txt inpt-100" required="">
					</div>
					<div class="form-input">
						<button type="submit" class="btn btn-concluir btn-bot btn-bor-rad">Enviar Foto</button>
						@if(Auth::user()->file_name!="NA")
							<a href="{{route('usuario.retira_foto', Auth::user()->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Remover foto</a>
						@endif
					</div>
					@if($errors->any())
						<p class="title-erro">{{$errors->first()}}</p>
					@endif
					<p></p>
				</form>
			</div>
		</div>
		<div class="col-l col-4">
			<div class="form-input">
				Nome:<input type="text" id="name" name="name" class="inpt-txt inpt-100" value="{{$user->name}}" readonly="">
			</div>
			<div class="form-input">
				Email:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{$user->email}}" readonly="">
			</div>
			<div class="form-input">
				@if(Auth::user()->birth_date==null)
					Data de Nascimento:<input type="text" id="data_nasc" name="data_nasc" class="inpt-txt inpt-100" value="" readonly="">
				@else
					Data de Nascimento:<input type="text" id="data_nasc" name="data_nasc" class="inpt-txt inpt-100" value="{{date('m/d/Y', strtotime($user->birth_date))}}" readonly="">
				@endif
			</div>
			<div class="form-input">
				Idade:<input type="text" id="age" name="age" class="inpt-txt inpt-100" value="{{$user->age}}" readonly="">
			</div>
			<div class="form-input">
				Nome Artístico:<input type="text" id="artistic_name" name="artistic_name" class="inpt-txt inpt-100" value="{{$user->artistic_name}}" readonly="">
			</div>
			<div class="form-input">
				Tag:<input type="text" id="tag" name="tag" class="inpt-txt inpt-100" value="{{$user->tag}}" readonly="">
			</div>
			<div class="form-input">
				Biografia:<textarea class="inpt-txt inpt-100" style="resize: none;" rows="10" readonly="">{{$user->history}}</textarea>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="linha">
			<div class="col-r col-l pula-1-r">
				<a href="{{route('usuario.edit', Auth::user()->id)}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
			</div>
			<div class="col-r col-l">
				<a href="{{route('inicio')}}" class="btn btn-bor btn-bor-rad btn-perigo">Voltar</a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
@endsection