@extends('layouts.layout_master')
@section('title', 'Editando Media')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Media</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('media.update',[$med->id, $idband])}}" method="post" enctype="multipart/form-data">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
								@if($med->type==0)
									<div class="form-input">
										<img class="big-pic" src="{{url('storage/media/'.$med->file_name)}}">
									</div>
									<div class="form-input">
										Título:<input type="text" id="titulo" name="titulo" class="inpt-txt inpt-100" value="{{$med->title}}">
									</div>
									<div class="form-input">
										Descrição:<textarea class="inpt-txt inpt-100" id="desc" name="desc">{{$med->description}}</textarea>
									</div>
								@else
									<div class="form-input">
										Link:<input type="text" id="link" name="link" class="inpt-txt inpt-100" value="{{$med->url}}" required="">
									</div>
								@endif
								<button class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
								<a href="{{route('banda.painel', $idband)}}" class="btn btn-bor btn-bor-rad btn-perigo">Cancelar</a>
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