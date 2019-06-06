@extends('layouts.layout_master')
@section('title', 'Vendo o(a) integrante: '.$nome)
@section('content')
	<div>
		<div class="col-l col-8">
			@if($nome_art!='')
				<h1>{{$nome_art}}</h1>
			@else
				<h1>{{$nome}}</h1>
			@endif
		</div>
		<div class="col-1 col-r col-pad-top">
			<a href="#" onclick="window.close()" class="btn btn-bor btn-bor-rad btn-ver">Fechar</a>
		</div>
	</div>
	<div class="col-l col-8 pula-1">
		<p>Nome: {{$nome}}</p>
		@if($data!='')
			<p>Data de nascimento: {{$data}}</p>
		@else
			<p>Data de nascimento: Não especificado</p>
		@endif
		@if($idade!='')
			<p>Idade: {{$data}}</p>
		@else
			<p>Idade: Não especificado</p>
		@endif
		@if($nome_art!='')
			<p>Nome Artístico: {{$nome_art}}</p>
		@else
			<p>Nome Artístico: Não especificado</p>
		@endif
		<p>Tag: {{$tag}}</p>
		<br>
		<p>
			Biografia:<br>
			@if($bio!='')
				{{$bio}}
			@else
				Não especificado
			@endif
		</p>

		@if($file_name!="NA")
			<img class="profile-pic medium_2-pic" src="{{url('storage/fotos_perfis/'.$file_name)}}">
		@endif
	</div>
@endsection