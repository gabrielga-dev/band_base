@extends('layouts.layout_master')
@section('title', 'Deletando Mídia')
@section('content')
	<div class="linha">
		<h2 class="title title-center">Deletando Mídia</h2>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<p class="title">
				Você deseja deletar @if($med->type==0) esta foto @else este vídeo @endif ?
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-l col-6 pula-2">
			<form action="{{ route('media.destroy', [$med->id, $idband]) }}" method="POST">
				{{ method_field('DELETE') }}
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-bor btn-bor-rad btn-perigo">Sim, tenho certeza!</button>
				<a href="{{route('banda.painel', $idband)}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Não! Ainda quero @if($med->type==0) ela @else ele @endif de pé!</a>
			</form>
		</div>
	</div>
@endsection