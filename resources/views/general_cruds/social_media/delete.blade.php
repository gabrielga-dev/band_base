@extends('layouts.layout_master')
@section('title', 'Deletando uma Mídia Social')
@section('content')
	<div class="linha">
		<h2 class="title title-center">Deletando Mídia Social</h2>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<p class="title">
				Você deseja deletar esta mídia social?
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<form action="{{ route('social_media.destroy', [$sm->id, $idband]) }}" method="POST">
				{{ method_field('DELETE') }}
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-bor btn-bor-rad btn-perigo">Sim, tenho certeza!</button>
				<a href="{{route('banda.painel', $idband)}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Não! Ainda quero ele de pé!</a>
			</form>
		</div>
	</div>
@endsection