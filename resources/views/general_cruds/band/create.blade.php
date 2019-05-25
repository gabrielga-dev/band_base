@extends('layouts.layout_master')
@section('title', 'Cadastro de Banda')
@section('content')
	<div class="linha">
		<div class="col-10">
			<h2 class="title title-center">Cadastrar Uma Banda</h2>
		</div>
	</div>
	<div class="linha">
		<form action="{{route('banda.store')}}" method="POST" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="col-l col-6 pula-2">
				<div class="form-input">
					Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{old('nome')}}" required="">
				</div>
				<div class="form-input">
					Email de Contato*:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{old('email')}}" required="">
				</div>
				<div class="form-input">
					Foto:<input type="file" id="foto" name="foto" class="inpt-txt inpt-100">
				</div>
				<div class="form-input">
					Gênero:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100" value="{{old('genero')}}">
				</div>
				<div class="form-input">
					Sou integrante:<input type="checkbox" name="e_integrante" id="e_integrante">
				</div>
				<div class="form-input">
					Função:<input type="text" id="funcao" name="funcao" class="inpt-txt inpt-100" value="{{old('funcao')}}">
				</div>
			</div>
			<div class="clear"></div>
			<div class="linha">
				<div class="col-l col-3 pula-2">
					<button type="submit" class="btn btn-bor btn-bor-rad btn-concluir">Cadastrar</button>
					<a href="{{route('banda.index')}}" class="btn btn-bor btn-bor-rad btn-perigo">Cancelar</a>
				</div>
			</div>
		</form>
	</div>
	@if($errors->any())
		<div class="linha">
			<div class="col-l col-3 pula-2">
				<p class="title title-erro">{{$errors->first()}}</p>
			</div>
		</div>
		<div class="clear"></div>
	@endif
	
@endsection