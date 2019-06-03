@extends('layouts.layout_master')
@section('title', 'Editando Seu Perfil')
@section('content')
	<div class="linha">
		<div class="col-10">
			<h2 class="title title-center">Editando seu perfil</h2>
		</div>
	</div>
	<div class="linha">
		<form action="{{route('usuario.update', $user->id)}}" method="POST">
			{!! csrf_field() !!}
			{{ method_field('PUT') }}
			<div class="col-l pula-3 col-4">
				<div class="form-input">
					Nome:<input type="text" id="name" name="name" class="inpt-txt inpt-100" value="{{$user->name}}">
				</div>
				<div class="form-input">
					Email:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{$user->email}}">
				</div>
				<div class="form-input">
					Data de Nascimento:<input type="date" id="date_of_birth" name="date_of_birth" class="inpt-txt inpt-100" value="{{$user->birth_date}}">
				</div>
				<div class="form-input">
					Idade:<input type="number" id="age" name="age" class="inpt-txt inpt-100" value="{{$user->age}}" min="0">
				</div>
				<div class="form-input">
					Nome Artístico:<input type="text" id="artistic_name" name="artistic_name" class="inpt-txt inpt-100" value="{{$user->artistic_name}}">
				</div>
				<div class="form-input">
					Tag:<input type="text" id="tag" name="tag" class="inpt-txt inpt-100" value="{{$user->tag}}">
				</div>
				<div class="form-input">
					Biografia:<textarea class="inpt-txt inpt-100" style="resize: none;" rows="10" id="bio" name="bio">{{$user->history}}</textarea>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="linha">
				<div class="col-l col-l pula-3">
					<a href="{{route('usuario.show', Auth::user()->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Voltar</a>
					<button class="btn btn-bor btn-bor-rad btn-concluir">Editar</button>
				</div>
			</div>
			<div class="clear"></div>
			@if($errors->any())
				<div class="linha">
					<div class="col-l col-l pula-3">
						<p class="title-erro">{{$errors->first()}}</p>
					</div>
				</div>
			<div class="clear"></div>
			@endif
		</form>
	</div>
@endsection