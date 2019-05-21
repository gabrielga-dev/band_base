@extends('layouts.layout_master')
@section('title', 'Início')
@section('content')
	<h1 class="title title-center">Band Base</h1>
	<h3 class="title">Sobre nós:</h3>
	<p class="">
		Nós somosuma equipe que pretende exaltar todas as pequenas bandas que não possuem seu espaço conquistado e ainda se permanessem nas sombras.
	</p>
	<br><br>
	<h3 class="title">Próximos eventos:</h3>
	@if(count($eventos)<=0)
		<h2 class="title title-center">Não há eventos =(</h2>
	@else
		<div class="scroll-div">
		</div>
	@endif
@endsection