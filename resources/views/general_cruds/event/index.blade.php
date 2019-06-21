@extends('layouts.layout_master')
@section('title', 'Eventos da banda: '.$band->name)
@section('content')
<div class="linha">
	<div class="col-l col-10">
		<h2 class="title title-center">Agenda da banda: {{$band->name}}</h2>
	</div>
	<div class="clear"></div>
</div>
<div class="scroll-div-max bg-black">
	@if(count($band->events)==0)
		<div class="linha">
			<h1 class="title title-center">Essa banda não possui um evento cadastrado :(</h1>
		</div>
	@else
		@foreach($band->events as $event)
			<div class="linha">
				<div class=" col-l col-2p5">

					<div class="linha">
						<div class="col-l col-10">
							<h2 class="title-center">{{date('d/m/Y', strtotime($event->date))}}</h2>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<p class="title title-center"><img src="{{asset('images/local_icon.jpg')}}" class="play-icon"> {{$event->city}} - {{$event->state}} </p>
						</div>
						<div class="clear"></div>
					</div>

				</div>
				<div class=" col-l col-5">
					<h1 class="title-center">{{$event->name}}</h1>
				</div>
				<div class=" col-l col-2p5">
					<a href="{{$event->Buy_url}}" class="btn btn-bor btn-bor-rad btn-concluir">Comprar Tickets</a>
				</div>
				<div class="clear"></div>
			</div>
			<br><br><br>
			<hr>
		@endforeach
	@endif
	
</div>
@endsection