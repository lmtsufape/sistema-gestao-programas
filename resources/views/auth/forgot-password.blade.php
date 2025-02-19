@extends('templates.app')


@section('body')

    @if (session('sucesso'))
        <div class="alert alert-sucess">
            <p style="color: green">{{ session('sucesso') }}</p>
        </div>
    @endif
    <br>

    <div class="container">
        <div class="login row">

            <div class="col div-paragraph">
                <h2 class="title-login">O que é?</h2>
                <p class="paragraph">
                    O sistema tem como intuito auxiliar no gerenciamento dos programas acadêmicos, como bolsas, monitorias e
                    estágios.
                    Desenvolvido para simplificar e automatizar, a plataforma proporciona controle e eficiência nas
                    funções acadêmicas e garante que cada parte envolvida tenha visibilidade e participação ativa em todo o
                    processo.
                    Promove, desse modo, uma comunicação clara e otimizada.
                </p>
            </div>

            <div class="col form-card">
                <div class="form-content">
                    <h2 class="title-form">Redefinir Senha</h2>
                    <hr class="divisor-login">
                </div>

                <form class="form-content" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="form-body">
                        <div class="field">
                            <label for="email" class="titulo-login">E-mail</label>
                            <input id="email" placeholder="Digite seu e-mail" name="email"
                                class="input-login form-control input-modal-create" type="text">
                        </div>

                        <div class="form-buttons">
                            <a href="{{ route('login') }}" class="register-button">Voltar</a>
                            <button type="submit" class="red-button">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
