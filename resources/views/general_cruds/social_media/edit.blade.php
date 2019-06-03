@extends('layouts.layout_master')
@section('title', 'Editando Mídia Social')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Mídia Social</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('social_media.update',[$sm->id, $idband])}}" method="post">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
								<div class="form-input">
									Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{$sm->name}}" required="">
								</div>
								<div class="form-input">
									Link*::<input type="text" id="link" name="link" class="inpt-txt inpt-100" value="{{$sm->url}}" >
								</div>
								<br>
								<button class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
								<a href="{{route('banda.painel', $idband)}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Cancelar</a>
							</form>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

@endsection