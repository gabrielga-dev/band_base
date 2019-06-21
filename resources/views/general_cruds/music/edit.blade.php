@extends('layouts.layout_master')
@section('title', 'Editando Música')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Música</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('musica.update',[$musica->id])}}" method="post">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
									<div class="form-input">
										Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{$musica->name}}">
									</div>
									<div class="form-input" >
										Gênero*:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100" value="{{$musica->genre}}">
									</div>
									<div class="form-input">
										Álbum*:<select class="inpt-txt inpt-100" name="album" id="album">
											@foreach($band->albums as $album)
												@if($album->id == $musica->album_id)
													<option value="{{$album->id}}" selected="">{{$album->name.' - '.date('d/m/Y',strtotime($album->date))}}</option>
												@else
													<option value="{{$album->id}}">{{$album->name.' - '.date('d/m/Y',strtotime($album->date))}}</option>
												@endif
											@endforeach
										</select>
									</div>
								<button class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
							</form>
						</div>
					</div>
					@if($errors->any())
						<div class="linha">
							<p class="title-erro">{{$errors->first()}}</p>
						</div>
					@endif
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

@endsection