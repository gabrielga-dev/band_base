<!DOCTYPE html>
<html>
	<head>
		<title>Band Base - @yield('title')</title>
		<meta charset="utf-8">
		@yield('links_add')
    	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/tabela_posicoes.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/botoes.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/inputs.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/titles.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/img.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/tables.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/colors.css') }}" rel="stylesheet">
	</head>
	<body>
		<header>
			<div class="linha">
				<div class=" col-l col-1">
					<a href="{{ route('inicio') }}" >
						<img class="img-home" src="{{asset('images/logo02.png')}}">
					</a>
				</div>
				@if(Auth::user())
					<div class=" col-l col-1 pula-1">
						<a href="{{route('banda.index')}}" class="btn btn-bor btn-bor-rad">Bandas</a>
					</div>
				@endif
				@if(Auth::user())
					<div class=" col-r col-1 "> 
						<a href="{{ route('logout') }}" class="btn btn-bor btn-bor-rad">Sair</a>
					</div>
					<div class=" col-r col-1 pula-0p5"> 
						<a href="{{route('usuario.show', Auth::user()->id)}}" class="">
							@if(Auth::user()->file_name=="NA")
								<img class="profile-pic small-pic" src="{{url('storage/default_images/user_default.png')}}">
							@else
								<img class="profile-pic small-pic" src="{{url('storage/fotos_perfis/'.Auth::user()->file_name)}}">
							@endif
						</a>
					</div>
				@else
					<div class=" col-r col-1 pula-0p5"> 
						<a href="{{ route('login') }}" class="btn btn-bor btn-bor-rad">Login</a>
					</div>
				@endif
					<div class=" col-r col-2">
						<form action="{{route('pesquisa')}}" method="POST">
							{!!csrf_field()!!}
							<input type="text" name="pesquisa" id="pesquisa" class="inpt-txt" placeholder="Busque alguma banda...">
							<input type="submit" value="Buscar" class="btn btn-bor btn-bor-rad">
						</form>
					</div>
				<div class="clear"></div>
			</div>
		</header>
		@yield('content')
		@yield('scripts_add')
	</body>
</html>