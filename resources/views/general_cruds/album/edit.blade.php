@extends('layouts.layout_master')
@section('title', 'Editando Álbum')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Álbum</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('album.update',[$album->id])}}" method="post">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
									<div class="form-input">
										Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{$album->name}}">
									</div>
									<div class="form-input" >
										Data de Lançamento*:<input type="date" id="data" name="data" class="inpt-txt inpt-100" value="{{$album->launch_date}}">
									</div>
									<div class="form-input">
										Gravadora:<input type="text" id="gravadora" name="gravadora" class="inpt-txt inpt-100" value="{{$album->recorder}}">
									</div>
									<div class="form-input">
										Gênero*:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100" value="{{$album->genre}}">
									</div>
									<div class="form-input">
										Link:<input type="text" id="link" name="link" class="inpt-txt inpt-100" value="{{$album->buy_url}}">
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