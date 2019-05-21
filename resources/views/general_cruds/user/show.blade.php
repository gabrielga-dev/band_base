@extends('layouts.layout_master')
@section('title', 'Seu Perfil')
@section('content')
	<div class="linha">
		<div class="col-l col-4 pula-1">
			<div class="col-l col-5">
				@if($user->file_name == 'NA')
					<img class="profile-pic big-pic" src="{{url('storage/default_images/user_default.png')}}">
				@else
					<img class="profile-pic big-pic" src="{{url('storage/users_images/'.$user->file_name)}}">
				@endif
			</div>
			<div class="col-l col-5">
				<div class="form-input">
					Tag:<input type="text" id="tag" name="tag" class="inpt-txt inpt-90" value="{{$user->tag}}" readonly="">
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col-l col-4">
			<div class="form-input">
				Nome:<input type="text" id="name" name="name" class="inpt-txt inpt-100" value="{{$user->name}}" readonly="">
			</div>
			<div class="form-input">
				Email:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{$user->email}}" readonly="">
			</div>
			<div class="form-input">
				Data de Nascimento:<input type="text" id="data_nasc" name="data_nasc" class="inpt-txt inpt-100" value="{{$user->date_of_birth}}" readonly="">
			</div>
			<div class="form-input">
				Idade:<input type="text" id="age" name="age" class="inpt-txt inpt-100" value="{{$user->age}}" readonly="">
			</div>
			<div class="form-input">
				Nome Artístico:<input type="text" id="artistic_name" name="artistic_name" class="inpt-txt inpt-100" value="{{$user->artistic_name}}" readonly="">
			</div>
		</div>
		<div class="clear"></div>
		<div class="linha">
			<div class="col-r col-l pula-1-r">
				<a href="#" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
			</div>
			<div class="col-r col-l">
				<a href="{{route('inicio')}}" class="btn btn-bor btn-bor-rad btn-perigo">Voltar</a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
@endsection