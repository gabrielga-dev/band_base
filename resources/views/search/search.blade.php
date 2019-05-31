@extends('layouts.layout_master')
@section('title', 'Início')
@section('content')
	<div class="linha">
		<div class=" div-global">
			<div class="">
				<h1 class="fonte title-center">Resultados para: {{$search}}</h1>
				<div class="linha">
					<div class="col-8 pula-1">
						@if(count($bands)<1)
							<h2 class="title title-center">Nenhuma banda encontrada</h2>
						@else
							<div class="bg-grey scroll-div-big">
								@foreach($bands as $band)
									<br>
									<div class="linha">
										<div class="col col-l col-1">
											@if($band->file_name == 'NA')
												<img src="{{url('storage/default_images/band_default.png')}}" class="img">
											@else
												<img src="{{url('storage/fotos_bandas/'.$band->file_name)}}" class="img">
											@endif
										</div>
										<div class="col-l col-2">
											<h2>{{$band->name}}</h2>
										</div>
										<div class="col-l col-2">
											<h3>{{$band->genre}}</h3>
										</div>
										<div class="col-l col-2">
											<h4>{{$band->views}} visualizações</h4>
										</div>
										<div class=" col-r col-1">
											<a class="btn-ver btn-bor btn-bor-rad"> Ver </a>
										</div>
										<br>
										<div class="clear"></div>
									</div>
									<hr>
								@endforeach
							</div>
							<div class="linha">
								<div class="col-r col-2">
									{{count($bands)}} resultado(s)
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection