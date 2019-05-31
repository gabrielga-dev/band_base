@extends('layouts.layout_master')
@section('title', 'Painel de Controle')
@section('content')
	<div class="master">
		<h1 class="title title-center">Painel de controle da banda: {{$band->name}}</h1>
		<div class="linha bg-grey">
			<div class="col-l col-8 pula-1 pula-1-r">
				<fieldset>
					<legend>Dados da banda</legend>
					<form action="{{ route('banda.update',$band->id) }}" method="POST">
						{{ method_field('PUT') }}
						{!! csrf_field() !!}
						<div class="form-input">
							Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{$band->name}}" required="">
						</div>
						<div class="form-input">
							Email de Contato*:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{$band->email}}" required="">
						</div>
						<div class="form-input">
							Gênero:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100" value="{{$band->genre}}">
						</div>
						<div class="form-input">
							@if(Auth::user()->imOf($band->id))
								Sou integrante:<input type="checkbox" name="e_integrante" id="e_integrante" checked="">
							@else
								Sou integrante:<input type="checkbox" name="e_integrante" id="e_integrante">
							@endif
						</div>
						<div class="form-input">
							@if($functions!=null)
								Função:<input type="text" id="funcao" name="funcao" class="inpt-txt inpt-100" value="{{$functions}}">
							@else
								Função:<input type="text" id="funcao" name="funcao" class="inpt-txt inpt-100">
							@endif
						</div>
						<button type="submit" class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
					</form>
				</fieldset>
			</div>
			<div class="clear"></div>
			<br>
			<div class="col-l col-8 pula-1 pula-1-r">
				@if($band->file_name == 'NA')
					<img class="profile-pic big-pic" src="{{url('storage/default_images/band_default.png')}}">
				@else
					<img class="profile-pic big-pic" src="{{url('storage/fotos_bandas/'.$band->file_name)}}">
				@endif
				<form action="{{ route('banda.muda_foto', $band->id)}}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-input">
						<input type="file" name="foto" id="foto" class="inpt-txt inpt-100" required="">
					</div>
					<div class="form-input">
						<button type="submit" class="btn btn-concluir btn-bot btn-bor-rad">Enviar Foto</button>
						@if(Auth::user()->file_name!="NA")
							<a href="{{route('banda.retira_foto', $band->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Remover foto</a>
						@endif
					</div>
					@if($errors->any())
						<p class="title-erro">{{$errors->first()}}</p>
					@endif
					<p></p>
				</form>
			</div>
			<div class="clear"></div>
			<br>
		</div>
	</div>
@endsection