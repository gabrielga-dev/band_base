@extends('layouts.layout_master')
@section('title','Cadastrar-se!')

@section('content')
<div class="container">
    <div class="linha">
        <div class="col-4 pula-3">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <fieldset>
                    <h2 class="title title-center">Nova Conta</h2>
                    <hr>

                    <h5 class="title title-center">Email*:</h5>
                    <input type="email" name="email" id="email_fake" class="hidden" autocomplete="off" style="display: none;" />
                    <input type="email" name="email" id="email" class="inpt-txt inpt-center" placeholder="exemplo@dominio.com" value="{{old('email')}}" required>

                    <h5 class="title title-center">Senha*:</h5>
                    <input type="password" name="password" id="password_fake" class="hidden" autocomplete="off" style="display: none;" />
                    <input id="password" type="password" class="inpt-txt inpt-center" name="password" placeholder="Sua senha aqui.." required>
                    <h5 class="title title-center">Repita a Senha*:</h5>
                    <input id="password-confirm" type="password" class="inpt-txt inpt-center" name="password_confirmation" placeholder="Repita sua senha aqui...." required>

                    <h5 class="title title-center">Nome*:</h5>
                    <input type="text" name="name" id="name" class="inpt-txt inpt-center" placeholder="Nome..." value="{{old('name')}}" required>

                    <h5 class="title title-center">Tag*:</h5>
                    <input type="text" name="tag" id="tag" class="inpt-txt inpt-center" placeholder="&tag_escolhida" title="A tag é pelo que as pessoas vão lhe achar. Essa tag será só sua" value="{{old('tag')}}" required>

                    <br><br>
                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-bor btn-bor-rad btn-center btn-concluir">
                    @if($errors->any())
                        <br><br>
                        <h5 class="title title-erro">
                            {{$errors->first()}}
                        </h5>
                    @endif
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection
