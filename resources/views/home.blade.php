@extends('templates.app')
@section('css')
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="../../../css/home.css">
@endsection
@section('body')
    @auth
        @hasanyrole(['tecnico', 'coordenador', 'pro-reitor', 'diretor', 'supervisor', 'administrador'])
            <div class="container-fluid">

                {{--  condição para se for admin aparacer a opão de Cadastrar programa  --}}
                <h2 class="second-title">
                    Programas
                </h2>
                <hr>
                <br>
                <div class="buttons-organization -gestor">
                    @foreach ($programas as $index => $programa)
                        <button class="botao" href="{{ url('/programas/' . $programa->id . '/editais') }}" onclick="window.location.href='{{ url('/programas/' . $programa->id . '/editais') }}'">
                            <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 10px;">
                            <p class="third-title">{{ $programa->nome }}</p>
                        </button>
                    @endforeach
                    <button class="botao" href="{{ route('estagio.index') }}" onclick="window.location.href='{{ route('estagio.index') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 10px;">
                        <p class="third-title">Estágio</p>
                    </button>
                </div>
                <br>
            </div>
            <div class="container-fluid">
                <h2 class="second-title">
                    Estágios
                </h2>
                <hr>
                <br>
                <div class="buttons-organization -gestor">
                    @foreach ($cursos as $index => $curso)
                        @if ($index % 2 == 0)
                            <button class="botao-maior" href="{{ url('/cursos/' . $curso->id . '/estagios') }}" onclick="window.location.href='{{ url('/cursos/' . $curso->id . '/estagios') }}'">
                            @else
                                <button class="botao-maior" href="{{ url('/cursos/' . $curso->id . '/estagios') }}" onclick="window.location.href='{{ url('/cursos/' . $curso->id . '/estagios') }}'">
                        @endif
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 10px;">
                        <p class="third-title">{{ $curso->nome }}</p>
                        </button>
                    @endforeach
                </div>
                <br>
            </div>
        @endhasanyrole



    @endauth

    @auth
        @role('estudante')
            <div class="container-fluid">
                <h2 class="second-title">
                    Programas
                </h2>
                <hr>
                <br>

                <div class="buttons-organization -aluno">
                    <button class="botao" ref="{{ url('/editais-aluno') }}" onclick="window.location.href='{{ url('/editais-aluno') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 10px;">
                        <p class="third-title"> Ver meus editais </p>
                    </button>

                    <button class="botao" ref="{{ route('Estagio.estagios-aluno') }}" onclick="window.location.href='{{ route('Estagio.estagios-aluno') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 10px;">
                        <p class="third-title"> Ver meus estágios </p>
                    </button>

                </div>
            </div>
        @endrole
    @endauth

    @auth
        @role('orientador')
            <div class="container-fluid">
                <h2 class="second-title">
                    Programas
                </h2>
                <hr>
                <br>

                <div class="buttons-organization -orientador">
                    <button class="botao" href="{{ url('/listar_alunos-orientador') }}" onclick="window.location.href='{{ url('/listar_alunos-orientador') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="user" style="padding-right: 20px;">
                        <p class="third-title">Listar alunos </p>
                    </button>

                    <button class="botao" href="{{ url('/estagios-orientador') }}" onclick="window.location.href='{{ url('/estagios-orientador') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 20px;">
                        <p class="third-title"> Meus estagios </p>
                    </button>

                    <button class="botao" href="{{ url('/editais-orientador') }}" onclick="window.location.href='{{ url('/editais-orientador') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 20px;">
                        <p class="third-title"> Meus editais </p>
                    </button>

                    <button class="botao" href="{{ route('edital.listar') }}" onclick="window.location.href='{{ route('edital.listar') }}'">
                        <img src="{{ asset('images/list-box.svg') }}" alt="logodoc" style="padding-right: 20px;">
                        <p class="third-title"> Todos os editais </p>
                    </button>
                </div>
                <br>
            </div>
        @endrole
    @endauth
@endsection
