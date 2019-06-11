@extends('layouts.layout_master')
@section('title', 'Foto da banda: '.$banda->name)
@section('content')
		<div>
			<div class="col-10">
				<div class="linha">
					
					<div class="pula-9">
						<button  onclick="window.close()" class="btn btn-bor btn-bor-rad ">Fechar</button>
					</div>
				</div>
				<div class="col-8 pula-2">
					<div>
						<img src="{{url('storage/media/'.$foto->file_name)}}" class="big-pic-max">
					</div>
				</div>
			</div>
			<div div class="col-10 pula1">
				<h1 class="title-center">{{$foto->title}}</h1>
				<p>{{$foto->description}}</p>
			</div>
		</div>
@endsection