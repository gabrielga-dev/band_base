@extends('layouts.layout_master')
@section('title', 'Bandas')
@section('content')
	<div class="linha">
		<div class="col-10">
			<h2 class="title title-center">Bandas</h2>
		</div>
	</div>
	<div class="linha">
		<div class="col-l col-1 pula-1">
			<h4 class="title">Suas Bandas</h4>
		</div>
		<div class="col-l col-1">
			<a href="{{ route('banda.create') }}" class="btn btn-bor btn-bor-rad btn-prosseguir">Cadastrar</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-8 pula-1 pula-1-r">
			@if(count($bandsOwn)<=0)
				<h3 class="title title-center">Você não possui nenhuma banda</h3>
			@else
				<div class="scroll-div-300 tbl-bor tbl-bor-rad">
					@foreach($bandsOwn as $band)
						<div class="linha">
							<div class="col-l col-2">
								@if($band->file_name=='NA')
									<img src="{{url('storage/default_images/band_default.png')}}" class="medium-pic">
								@else
									<img src="{{url('storage/fotos_bandas/'.$band->file_name)}}" class="medium-pic">
								@endif
							</div>
							<div class="col-l col-4">
								<div class="linha">
									<div class="col-l col-2">
										<h4 class="title">{{$band->name}}</h4>
									</div>
								</div>
								<div class="clear"></div>
								<div class="linha">
									<div class="col-l col-2">
										<h5 class="title">{{$band->genre}}</h5>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="col-l col-2">
								<h4 class="title title-center">
									{{$band->views}}
									<br>
									Visualizações
								</h4>
							</div>
							<div class="col-l col-2">
								<div class="linha">
									<div class="col-l col-5">
										<a href="{{route('banda.pagina',$band->id)}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Acessar</a>
									</div>
									<div class="col-l col-5">
										<a href="{{route('banda.delete',$band->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="linha">
									<div class="col-10">
										<a href="{{route('banda.painel', $band->id)}}" class="btn btn-bor btn-bor-rad btn-concluir btn-100">Painel de controle</a>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
					@endforeach
				</div>
			@endif
		</div>
	</div>


	<div class="linha">
		<div class="col-3 pula-1">
			<h4 class="title">Bandas que você faz parte</h4>
		</div>
		<div class="clear"></div>
	</div>
	<div class="linha">
		<div class="col-8 pula-1 pula-1-r">
			@if(count($bandsOf)<=0)
				<h3 class="title title-center">Você não faz parte de nenhuma banda</h3>
			@else
				<div class="scroll-div-300 tbl-bor tbl-bor-rad">
					@foreach($bandsOf as $band)
						<div class="linha">
							<div class="col-l col-2">
								@if($band->file_name=='NA')
									<img src="{{url('storage/default_images/band_default.png')}}" class="medium-pic">
								@else
									<img src="{{url('storage/fotos_bandas/'.$band->file_name)}}" class="medium-pic">
								@endif
							</div>
							<div class="col-l col-4">
								<div class="linha">
									<div class="col-l col-2">
										<h4 class="title">{{$band->name}}</h4>
									</div>
								</div>
								<div class="clear"></div>
								<div class="linha">
									<div class="col-l col-2">
										<h5 class="title">{{$band->genre}}</h5>
									</div>
								</div>
								<div class="clear"></div>
								<div class="linha">
									<div class="col-l col-2">
										<h6 class="title">{{$band->pivot->functions}}</h6>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="col-l col-2">
								<h4 class="title title-center">
									{{$band->views}}
									<br>
									Visualizações
								</h4>
							</div>
							<div class="col-l col-2">
								<a href="{{route('banda.pagina',$band->id)}}" class="btn btn-bor btn-bor-rad btn-prosseguir">Acessar</a>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
					@endforeach
				</div>
			@endif
		</div>
	</div>
@endsection