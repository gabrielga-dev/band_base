@extends('layouts.layout_master')
@section('title', 'Início')
@section('content')
	<h1 class="title title-center">Band Base</h1>
	<h3 class="title">Sobre nós:</h3>
	<p class="">
		Nós somosuma equipe que pretende exaltar todas as pequenas bandas que não possuem seu espaço conquistado e ainda se permanessem nas sombras.
	</p>
	<br><br>
	<div class="bg-grey bg-eventos">
		<h3 class="title">Próximos eventos:</h3>
		<hr>
		@if(count($eventos)<=0)
			<h2 class="title title-center">Não há eventos =(</h2>
		@else
			<div class="scroll-div-max">
				@foreach($eventos as $evento)
					<div class="linha">
						<div class="col-l col-2">
							{{$evento->name}}
						</div>
						<div class="col-l col-2">
							{{$evento->band->name}}
						</div>
						<div class="col-l col-2">
							{{date('d/m/Y', strtotime($evento->date))}}
						</div>
						<div class="col-l col-4">
							{{$evento->city.' '.$evento->state}}
						</div>
						<div class="clear"></div>
					</div>
					<hr>
				@endforeach
			</div>
		@endif
	</div>
@endsection