@extends('layouts.layout_master')
@section('title', 'Editando Evento')
@section('content')

<div class="master">
	<div class="linha">
		<div class="col-l col-8 pula-1 pula-1-r bg-grey">
			<div class="linha">
				<div class="col-l col-8 pula-1 pula-1-r">
					<div class="linha">
						<div class="col-l col-10">
							<h3 class="title titlle-center">Editando Eveto</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="linha">
						<div class="col-l col-10">
							<form action="{{route('evento.update',[$evento->id, $idband])}}" method="post" enctype="multipart/form-data">
								{!! csrf_field() !!}
								{{ method_field('PUT') }}
								<div class="form-input">
									Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" required="" value="{{$evento->name}}">
								</div>
								<div class="form-input">
									Data*:<input type="date" id="data" name="data" class="inpt-txt inpt-100" required="" value="{{$evento->date}}">
								</div>
								<div class="form-input">
									Horário*:<input type="time" id="horario" name="horario" class="inpt-txt inpt-100" required="" value="{{substr($evento->time.'',0,5)}}">
								</div>
								<div class="form-input">
									Link para o Evento*:<input type="text" id="link" name="link" class="inpt-txt inpt-100" required="" value="{{$evento->Buy_url}}">
								</div>
								<div class="form-input">
									Nome do local*:<input type="text" id="nome_local" name="nome_local" class="inpt-txt inpt-100" value="{{$evento->local_name}}">
								</div>
								<div class="form-input">
									Rua*:<input type="text" id="rua" name="rua" class="inpt-txt inpt-100" required="" value="{{$evento->street}}">
								</div>
								<div class="form-input">
									Complemento:<input type="text" id="complemento" name="complemento" class="inpt-txt inpt-100" value="{{$evento->complement}}">
								</div>
								<div class="form-input">
									Bairro*:<input type="text" id="bairro" name="bairro" class="inpt-txt inpt-100" required="" value="{{$evento->neighborhood}}">
								</div>
								<div class="form-input">
									Cidade*:<input type="text" id="cidade" name="cidade" class="inpt-txt inpt-100" required="" value="{{$evento->city}}">
								</div>
								<div class="form-input">
									Estado*:<input type="text" id="estado" name="estado" class="inpt-txt inpt-100" required="" value="{{$evento->state}}">
								</div>
								<br>
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