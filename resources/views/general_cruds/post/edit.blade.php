@extends('layouts.layout_master')
@section('title', 'Editando Post')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Post</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('post.update',[$post->id, $idband])}}" method="post">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
								<div class="form-input">
									Título*:<input type="text" id="titulo" name="titulo" class="inpt-txt inpt-100" value="{{$post->title}}" required="">
								</div>
								<div class="form-input">
									Resumo:<input type="text" id="resumo" name="resumo" class="inpt-txt inpt-100" value="{{$post->brief}}" >
								</div>
								<div class="form-input">
									Conteúdo*:<textarea class="inpt-txt inpt-100" id="conteudo" name="conteudo" required="">{{$post->content}}</textarea>
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