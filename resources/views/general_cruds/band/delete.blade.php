@extends('layouts.layout_master')
@section('title', 'Deletando uma Banda')
@section('content')
	<div class="linha">
		<h2 class="title title-center">Deletando Banda</h2>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<p class="title">
				Você deseja deletar a banda {{$band->name}}?
				<br>
				Ela teve {{$band->views}} visualização(ões) até agora! Não deixe o legado dela acabar assim =(
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<form action="{{ route('banda.destroy', $band->id) }}" method="POST">
				{{ method_field('DELETE') }}
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-bor btn-bor-rad btn-perigo">Sim, tenho certeza!</button>
				<a href="{{route('banda.index')}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Não! Ainda quero ela de pé!</a>
			</form>
		</div>
	</div>
@endsection