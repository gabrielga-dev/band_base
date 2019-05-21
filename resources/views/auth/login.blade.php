@extends('layouts.layout_master')
@section('title','Login')

@section('content')
<div class="container">
    <div class="linha">
        <div class="col-4 pula-3">
            <fieldset>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h2 class="title title-center">Login</h2>
                    <hr>
                    <h5 class="title title-center">Email:</h5>
                    <input type="email" name="email" id="email" class="inpt-txt inpt-center" required>
                    <h5 class="title title-center">Senha:</h5>
                    <input type="password" name="password" id="password" class="inpt-txt inpt-center" required>
                    <br><br>
                    <input type="submit" name="logar" value="Logar" class="btn btn-bor btn-bor-rad btn-center btn-concluir">
                </form>
                @if($errors->any())
                <br><br>
                    <h5 class="title title-erro">
                        {{$errors->first()}}
                    </h5>
                @endif
                <hr>
                <h5 class="title title-center">Esqueceu sua senha? Recupere-a <a href="#">aqui</a>!</h5>
                <h5 class="title title-center"><a href="{{ route('register') }}">Crie uma conta nova!</a></h5>
            </fieldset>
        </div>
    </div>
</div>
@endsection
