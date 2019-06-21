@extends('layouts.layout_master')
@section('title', 'Painel de Controle')
@section('content')
	<div class="master">
		<div class="linha bg-grey">
		<h1 class="title title-center">Painel de controle da banda: {{$band->name}}</h1>
			<div class="col-l col-8 pula-1 pula-1-r">
				<fieldset>
					<legend>Dados da banda</legend>
					<form action="{{ route('banda.update',$band->id) }}" method="POST">
						{{ method_field('PUT') }}
						{!! csrf_field() !!}
						<div class="form-input">
							Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" value="{{$band->name}}" required="">
						</div>
						<div class="form-input">
							Email de Contato*:<input type="email" id="email" name="email" class="inpt-txt inpt-100" value="{{$band->email}}" required="">
						</div>
						<div class="form-input">
							Gênero:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100" value="{{$band->genre}}">
						</div>
						<div class="form-input">
							@if(Auth::user()->imOf($band->id))
								Sou integrante:<input type="checkbox" name="e_integrante" id="e_integrante" checked="">
							@else
								Sou integrante:<input type="checkbox" name="e_integrante" id="e_integrante">
							@endif
						</div>
						<div class="form-input">
							@if($functions!=null)
								Função:<input type="text" id="funcao" name="funcao" class="inpt-txt inpt-100" value="{{$functions}}">
							@else
								Função:<input type="text" id="funcao" name="funcao" class="inpt-txt inpt-100">
							@endif
						</div>
						<button type="submit" class="btn btn-bor btn-bor-rad btn-concluir">Atualizar</button>
					</form>
				</fieldset>
			</div>
			<div class="clear"></div>
			<br>
			<div class="col-l col-4 pula-1">
				@if($band->file_name == 'NA')
					<img class="profile-pic big-pic" src="{{url('storage/default_images/band_default.png')}}">
				@else
					<img class="profile-pic big-pic" src="{{url('storage/fotos_bandas/'.$band->file_name)}}">
				@endif
				<form action="{{ route('banda.muda_foto', $band->id)}}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-input">
						<input type="file" name="foto" id="foto" class="inpt-txt inpt-100" required="">
					</div>
					<div class="form-input">
						<button type="submit" class="btn btn-concluir btn-bot btn-bor-rad">Enviar Foto</button>
						@if(Auth::user()->file_name!="NA")
							<a href="{{route('banda.retira_foto', $band->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Remover foto</a>
						@endif
					</div>
					@if($errors->any())
						<p class="title-erro">{{$errors->first()}}</p>
					@endif
					<p></p>
				</form>
			</div>
			<div class="col-r col-4 ">
				<a href="{{route('banda.pagina', $band->id)}}" class="btn btn-bor btn-bor-rad" target="_blank">Página da banda</a>
			</div>
			<div class="clear"></div>
			<br>
			<!-- =======================================================itens da banda=====================================================-->
			<div class="col-l col-8 pula-1 pula-1-r">
				<fieldset>
					<legend>Itens da banda</legend>
			<!-- =======================================================POST=====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Posts</h4>
								<form action="{{route('post.store', $band->id)}}" method="post">
									{!! csrf_field() !!}
									<div class="form-input">
										Título*:<input type="text" id="titulo" name="titulo" class="inpt-txt inpt-100" required="">
									</div>
									<div class="form-input">
										Resumo:<input type="text" id="resumo" name="resumo" class="inpt-txt inpt-100" >
									</div>
									<div class="form-input">
										Conteúdo*:<textarea class="inpt-txt inpt-100" id="conteudo" name="conteudo" required=""></textarea>
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
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
												<div class="col-10">
													<a href="{{route('post.show', $post->id)}}" class="btn btn-bor btn-bor-rad">Ver mais</a>
													<a href="{{route('post.edit', [$post->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('post.delete', [$post->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= BIOGRAFIA =====================================================-->
						<div class="linha">
							
							<div class="col-l col-10">
								<h4 class="title">Biografia</h4>
								<form action="{{route('banda.muda_bio', $band->id)}}" method="post">
									{!! csrf_field() !!}
									{{ method_field('PUT') }}
									<div class="form-input">
										Conteúdo*:<br><textarea class="inpt-txt inpt-90" id="conteudo" name="conteudo" rows="17" required="">{{$band->history}}</textarea>
									</div>
									<button type="submit" class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= MIDIA =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Mídias (Fotos e Vídeos)</h4>
								<form action="{{route('media.store',$band->id)}}" method="post" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<div class="form-input">
										Tipo*:<br>
										Foto<input type="radio" id="tipo" name="tipo" value="0" required="" onclick="toggleToFoto()" checked="">
										Vídeo<input type="radio" id="tipo" name="tipo" value="1" required="" onclick="toggleToVideo()">
									</div>
									<div class="form-input" id="form-link" style="display: none;">
										Link*:<input type="text" id="link" name="link" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" id="form-file">
										Arquivo*:<input type="file" id="foto" name="foto" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" id="form-title">
										Título:<input type="text" id="titulo" name="titulo" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" id="form-desc">
										Descrição:<textarea class="inpt-txt inpt-100" id="desc" name="desc"></textarea>
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->medias)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhuma Mídia</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->medias as $med)
											<div class="col-8 pula-1">
												@if($med->type==0)
													<p>{{$med->title}}:<br><small>{{$med->description}}</small></p>
												@else
													<p>
														<a href="{{$med->url}}" target="_blank" class="link">Acessar</a>
													</p>
												@endif
												<div class="col-10">
													<a href="{{route('media.edit', [$med->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('media.delete', [$med->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= ÁLBUNS =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Álbuns</h4>
								<form action="{{route('album.store',$band->id)}}" method="post" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<div class="form-input">
										Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" >
										Data de Lançamento*:<input type="date" id="data" name="data" class="inpt-txt inpt-100">
									</div>
									<div class="form-input">
										Gravadora:<input type="text" id="gravadora" name="gravadora" class="inpt-txt inpt-100">
									</div>
									<div class="form-input">
										Gênero*:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100">
									</div>
									<div class="form-input">
										Link:<input type="text" id="link" name="link" class="inpt-txt inpt-100">
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->albums)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhum álbum</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->albums as $album)
											<div class="col-8 pula-1">
												<div class="linha">
													<div class="col-l col-10">
														<h3 class="title center">{{$album->name}}</h3>
													</div>
													<div class="clear"></div>
												</div>
												<div class="linha">
													<div class="col-l col-5">
														<h4 class="title">{{date('d/m/Y', strtotime($album->launch_date))}}</h4>
													</div>
													<div class="col-l col-5">
														<h4 class="title">{{$album->recorder}}</h4>
													</div>
													<div class="clear"></div>
												</div>
												<div class="col-10">
													<a href="{{route('album.edit', $album->id)}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('album.delete', $album->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= MÚSICAS =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Músicas</h4>
								<form action="{{route('musica.store',$band->id)}}" method="post" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<div class="form-input">
										Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" >
										Gênero*:<input type="text" id="genero" name="genero" class="inpt-txt inpt-100">
									</div>
									<div class="form-input" >
										@if(count($band->albums)==0)
											<p class="title title-center title-erro">Não há, pelo menos, um álbum para que o cadastro de músicas seja realizado</p>
										@else
											<div class="form-input">
												Álbum*:<select class="inpt-txt inpt-100" name="album" id="album">
													@foreach($band->albums as $album)
														<option value="{{$album->id}}">{{$album->name.' - '.date('d/m/Y',strtotime($album->date))}}</option>
													@endforeach
												</select>
											</div>
											<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
										@endif
									</div>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->musics)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhuma música</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->musics as $musica)
											<div class="col-8 pula-1">
												<div class="linha">
													<div class="col-l col-10">
														<h3 class="title center">{{$musica->name}}</h3>
													</div>
													<div class="clear"></div>
												</div>
												<div class="linha">
													<div class="col-l col-5">
														<h4 class="title">{{$musica->album->name}} - {{date('d/m/Y', strtotime($musica->album->launch_date))}}</h4>
													</div>
													<div class="col-l col-5">
														<h4 class="title">{{$musica->album->recorder}}</h4>
													</div>
													<div class="clear"></div>
												</div>
												<div class="col-10">
													<a href="{{route('musica.edit', $musica->id)}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('musica.delete', $musica->id)}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= EVENTOS =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Eventos</h4>
								<form action="{{route('evento.store', $band->id)}}" method="post">
									{!! csrf_field() !!}
									<div class="form-input">
										Etapas*:<br>
										Dados do Evento<input type="radio" id="tipo" name="tipo" value="0" required="" onclick="toggleToDados()" checked="">
										Dados do Local<input type="radio" id="tipo" name="tipo" value="1" required="" onclick="toggleToEndereco()">
									</div>
									<div id="form-dados_1">
										<div class="form-input">
											Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Data*:<input type="date" id="data" name="data" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Horário*:<input type="time" id="horario" name="horario" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Link para o Evento*:<input type="text" id="link" name="link" class="inpt-txt inpt-100" required="">
										</div>
									</div>
									<div id="form-dados_2" style="display: none;">
										<div class="form-input">
											Nome do local*:<input type="text" id="nome_local" name="nome_local" class="inpt-txt inpt-100">
										</div>
										<div class="form-input">
											Rua*:<input type="text" id="rua" name="rua" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Complemento:<input type="text" id="complemento" name="complemento" class="inpt-txt inpt-100">
										</div>
										<div class="form-input">
											Bairro*:<input type="text" id="bairro" name="bairro" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Cidade*:<input type="text" id="cidade" name="cidade" class="inpt-txt inpt-100" required="">
										</div>
										<div class="form-input">
											Estado*:<input type="text" id="estado" name="estado" class="inpt-txt inpt-100" required="">
										</div>
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->events)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhum Evento</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->events as $event)
											<div class="col-8 pula-1">
													<p>{{$event->name}}</p>
												<div class="col-10">
													<a href="{{route('evento.edit', [$event->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('evento.delete', [$event->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= INTEGRANTE =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Integrantes</h4>
								<form action="{{route('integrante.store',$band->id)}}" method="post" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<div class="form-input">
										Tag*:<input type="text" id="tag" name="tag" class="inpt-txt inpt-100" required="">
									</div>
									<div class="form-input">
										Funções*:<input type="text" id="functions" name="functions" class="inpt-txt inpt-100" required="">
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Recrutar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->musicians)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhum integrante</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->musicians as $mus)
											<div class="col-8 pula-1">
												<p>
													{{$mus->name}} &nbsp;<small>{{$mus->tag}}</small><br>
													<small>{{$mus->pivot->functions}}</small>
												</p>
												<div class="col-10">
													<a href="{{route('banda.integrante', [$mus->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-concluir" target="_blank">Ver Mais</a>
													<a href="{{route('integrante.edit', [$mus->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('integrante.delete', [$mus->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<!-- ======================================================= REDES SOCIAIS =====================================================-->
						<div class="linha">
							<div class="col-l col-5">
								<h4 class="title">Mídias Sociais</h4>
								<form action="{{route('social_media.store',$band->id)}}" method="post">
									{!! csrf_field() !!}
									<div class="form-input">
										Nome*:<input type="text" id="nome" name="nome" class="inpt-txt inpt-100" required="">
									</div>
									<div class="form-input">
										Link*:<input type="text" id="link" name="link" class="inpt-txt inpt-100" required="">
									</div>
									<button class="btn btn-bor btn-bor-rad btn-concluir">Salvar</button>
								</form>
							</div>
							<div class=" col-l col-4 col">
								<div class="linha">
									@if(count($band->social_medias)<1)
										<div class="col-10">
											<h3 class="title title-center">Nenhuma Mídia Social</h3>
										</div>
									@else
										<div class="scroll-div-300 tbl-bor tbl-bor-rad">
											@foreach($band->social_medias as $sm)
											<div class="col-8 pula-1">
												<p>
													{{$sm->name}} <br>
													<a href="{{$sm->url}}" target="_blank" class="link">Acessar</a>
												</p>
												<div class="col-10">
													<a href="{{route('social_media.edit', [$sm->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-cuidado">Editar</a>
													<a href="{{route('social_media.delete', [$sm->id, $band->id])}}" class="btn btn-bor btn-bor-rad btn-perigo">Excluir</a>
												</div>
												<hr>	
											</div>
											@endforeach
										</div>
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<hr>
						<div class="clear"></div>
				</fieldset>
			</div>
			<div class="clear"></div>
			<br>
		</div>
	</div>
@endsection
@section('scripts_add')
<script type="text/javascript" src="{{ asset('js/exibe_campos.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/exibe_campos.js') }}"></script>
@endsection