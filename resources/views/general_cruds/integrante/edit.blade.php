@extends('layouts.layout_master')
@section('title', 'Editando Integrante')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Integrante</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-4 col-l">
							<h3>Integrante:{{$integ->name}}</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('integrante.update',[$integ->id, $band->id, $interacao->id])}}" method="post">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
									<div class="form-input">
										Funções*:<input type="text" id="functions" name="functions" class="inpt-txt inpt-100" value="{{$interacao->functions}}" required="">
									</div>
								<button class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
								<br><br>
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