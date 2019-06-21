@extends('layouts.layout_master')
@section('title', 'Músicas e Álbuns da banda '.$band->name)
@section('content')

<div class="linha">
	<div class="col-10 col-l">
		<h1 class="title title-center">Músicas</h1>
	</div>
	<div class="clear"></div>
</div>
@if(count($band->albums)==0)
	<div class="linha">
		<div class="col-l col-10">
			<h2 class="title title-center">Esta banda não possui álbuns cadastrados</h2>
		</div>
	</div>
@else
	@foreach($band->albums as $album)
	<div class="linha border">
		<div class="col-1 col-l col">
			<h3 class="title">{{$album->name}}</h3>
		</div>
		<div class="col-0p5 col-l">
			<small>{{$album->recorder}} {{date('d/m/Y', strtotime($album->launch_date))}}</small>
		</div>
		<div class="col-0p5 col-r col">
			@if($album->buy_url!='')
				<a href="{{$album->buy_url}}">
					<img src="{{asset('images/play-button.png')}}" class="play-icon">
				</a>
			@endif
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-l col-8 pula-1 border">
			@if(count($album->musics)>0)
				<div class="scroll-div-max">
					@foreach($album->musics as $musica)
						<div class="linha">
							<div class="col-l col-6 col">
								<p> {{$musica->name}} </p>
							</div>
							<div class="clear"></div>
						</div>
					@endforeach
					<hr>
				</div>
			@endif
		</div>
		<div class="clear"></div>
	</div>
	<br>
	@endforeach
@endif

@endsection