@extends('layouts.layout_master')
@section('title', 'Notícia '.$post->title)
@section('content')
	<div class="linha">
		<div class="col col-l col-10">
			<div class="linha">
				<div class=" col-l col-9">
					<h1 class="title">{{$post->title}}</h1>
				</div>
				<div class=" col-l col-1">
					<a href="{{route('banda.pagina',$post->band->id)}}" class="btn btn-bor btn-bor-rad">Voltar</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="linha">
				<div class="col col-l col-10">
					<h3 class="title">{{$post->brief}}</h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="linha">
				<div class="col col-l col-10">
					<p>
						{{$post->content}}
					</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
@endsection