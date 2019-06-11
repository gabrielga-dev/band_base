@extends('layouts.layout_master')
@section('title', 'Galeria da banda: '.$banda->name)
@section('content')
		<div class="linha">
			<div class="col-l col-5">
				<h1>Imagens</h1>
			</div>
			<a href="{{route('banda.pagina', $banda->id)}}" class="btn btn-bor btn-bor-rad col-r" style="margin-right: 10px;">Voltar</a>
		</div>
		<div class="scroll-div-max">
			@if(count($fotos)<1)
				<div class="col-l col-10">
					<h2 class="title title-center">A banda não possui fotos cadastradas</h2>
				</div>
				<div class="clear"></div>
			@else
				@foreach($fotos as $foto)
					<div class="col-l col-2">
						<a href="#">
							<img src="{{url('storage/media/'.$foto->file_name)}}" alt="{{$foto->title}}" class="big-pic">
						</a>
					</div>
				@endforeach
			@endif
		</div>
		<hr>
		<div>
			<h1>Vídeos</h1>
		</div>
		<div class="scroll-div-max">
			@if(count($videos)<1)
				<div class="col-l col-10">
					<h2 class="title title-center">A banda não possui vídeos cadastradas</h2>
				</div>
				<div class="clear"></div>
			@else
				@foreach($videos as $video)
				<div class="col-l col-2">
					<iframe class="big-pic" src="http://www.youtube.com/embed/{{App\Media::key($video->url)}}" frameborder="0" allowfullscreen></iframe>
					
				</div>
				@endforeach
			@endif
		</div>
@endsection