@extends('layouts.layout_master')
@section('title', 'Saindo de uma Banda')
@section('content')
	<div class="linha">
		<h2 class="title title-center">Saindo de uma Banda</h2>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<p class="title">
				Você deseja sair da banda {{$band->name}}?
				<br>
				Ela teve {{$band->views}} visualização(ões) até agora! Não saia do legado dela assim =(
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<form action="{{ route('band_user.destroy', $band->id) }}" method="POST">
				{{ method_field('DELETE') }}
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-bor btn-bor-rad btn-perigo">Sim, tenho certeza!</button>
				<a href="{{route('banda.index')}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Não! Ainda quero fazer parte dela!</a>
			</form>
		</div>
	</div>
@endsection