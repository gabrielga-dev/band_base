@extends('layouts.layout_master')
@section('title', $band->name)
@section('content')
		<div class="linha">
			<div class="col-l col-1 pula-0p5">
				@if($band->file_name == 'NA')
					<img src="{{url('storage/default_images/band_default.png')}}" class="img">
				@else
					<img src="{{url('storage/fotos_bandas/'.$band->file_name)}}" class="img">
				@endif
			</div>
			<div class="col-l col-2">
				<h2>{{$band->name}}</h2>
			</div>
			<div class="col-r col-2">
				<h5>{{$band->email}}</h5>
			</div>
			<div class="clear"></div>
		</div>
		<div class="linha">
			<div class=" col bg-grey pula-0p5 pula-0p5-r">
				<h2 class="pula-1">Notícias</h2>
					@if(count($band->posts)<1)
						<div class="col-10">
							<h3 class="title title-center">Nenhuma notícia</h3>
						</div>
					@else
						<div class="scroll-div-300 tbl-bor tbl-bor-rad">
							@foreach($band->posts as $post)
							<div class="col-8 pula-1">
								<p>
									{{$post->title}} <br><br>
									{{$post->brief}}
								</p>
								<div class="col-1">
									<a href="{{route('post.show', $post->id)}}" class="btn btn-bor btn-bor-rad">Ver mais</a>
								</div>
								<hr>	
							</div>
							@endforeach
						</div>
					@endif
				<br>
			</div>
			<div class=" col bg-grey pula-0p5 pula-0p5-r">
				<h2 class="pula-1">Biografia</h2>
					@if($band->history=="")
						<div class="col-10">
							<h3 class="title title-center">Biografia não escrita ainda!</h3>
						</div>
					@else
						<div class="scroll-div-300 tbl-bor tbl-bor-rad">
							<div class="col-8 pula-1">
								<p>
									{{$band->history}}
								</p>	
							</div>
						</div>
					@endif
					<h3 class="pula-1">Integrantes</h3>
					<div class="pula-1 linha">
						<div class="col-l col-1">
							@if($band->owner->file_name=="NA")
								<img class="profile-pic medium_2-pic" src="{{url('storage/default_images/user_default.png')}}">
							@else
								<img class="profile-pic medium_2-pic" src="{{url('storage/fotos_perfis/'.$band->owner->file_name)}}">
							@endif
						</div>
						<div class="col-l col-2">
							<h3 class="title">Dono da banda</h3>
							<h4 class="title">{{$band->owner->name}}</h4>
						</div>
						<div class="clear"></div>
					</div>
					@if(count($band->musicians)<1)
						<h3 class="title title-center">Não há integrantes nessa banda</h3>
					@else
						<div class="scroll-div-300 tbl-bor tbl-bor-rad">
							@foreach($band->musicians as $mus)
								<div class="linhas">
									<div class="col col-l col-1">
										@if($band->owner->file_name=="NA")
											<img class="profile-pic medium_2-pic" src="{{url('storage/default_images/user_default.png')}}">
										@else
											<img class="profile-pic medium_2-pic" src="{{url('storage/fotos_perfis/'.$mus->file_name)}}">
										@endif
									</div>
									<div class="col col-l col-2">
										<h4 class="title">{{$mus->name}}</h4>
										<h4 class="title">{{$mus->pivot->functions}}</h4>
									</div>
									<div class="clear"></div>
									<hr>
								</div>
							@endforeach
						</div>
					@endif
				<br>
			</div>
		</div>
		<br>
		<div class="bg-grey">
			<div class="linha">
				<div class="col-10">
					<h2 class="title title-center">Redes Sociais</h2>
				</div>
			</div>
			<div class="linha">
				@if(count($band->social_medias)<1)
					<div class="col-l col-10">
						<h3 class="title title-center">Não há redes sociais ainda!</h3>
					</div>
					<div class="clear"></div>
				@else
					<div class="col-l col-4 pula-3">
						@foreach($band->social_medias as $sm)
							<div class="col-l col-sm">
								<a href="{{$sm->url}}" class="sm-link" target="_blank">
									@if(App\Social_Media::is_conhecida($sm->name))
										<img src="{{url('storage/default_images/'.$sm->name.'.png')}}" class="social_media-pic">
									@else
										{{$sm->name}}
									@endif
								</a>
							</div>
						@endforeach
						<div class="clear"></div>
					</div>
				@endif
				
				<div class="clear"></div>
			</div>
		</div>
@endsection