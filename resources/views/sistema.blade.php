@extends("templates.app")


@section("body")
    @include("auth.modal_criar_aluno")

    {{-- <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif --}}
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        <p style="color: green">{{session('sucesso')}}</p>
    </div>
    @endif
    <br>

    <div class="container" style="padding-top: 5%">

        <div class="row" style="text-align: left;">
        <h1>Sobre o sistema</h1>
<h3 style="padding-top: 10px;">O que é o sistema de gestão de programas acadêmicos (SGPA)?</h3>
<p>É uma aplicação web desenvolvida no âmbito da cooperação técnica UFAPE-LMTS / UPE com o objetivo de facilitar o gerenciamento de programas acadêmicos, auxiliando os responsáveis nas suas rotinas de trabalho, como increver alunos e professores nos programas, etc.</p>

<h3>Principais funcionalidades</h3>
<ul style="padding-left: 5%">
    <li>Administrador</li>
    <ul>
        <li>Cadastrar, editar, consultar e excluir:</li>
        <ul>
            <li>Usuários</li>
            <li>Programas</li>
            <li>Editais</li>
            <li>Disciplinas</li>
            <li>Cursos</li>
        </ul>
        <li>Vincular em Editais:</li>
        <ul>
            <li>Alunos</li>
            <li>Professores</li>
        </ul>
    </ul>
</ul>
<ul style="padding-left: 5%">
    <li>Técnico Administrativo</li>
    <ul>
        <li>Cadastrar, editar, consultar e excluir:</li>
        <ul>
            <li>Programas</li>
            <li>Editais</li>
            <li>Disciplinas</li>
            <li>Cursos</li>
            <li>Alunos</li>
            <li>Professores</li>
        </ul>
    </ul>
</ul>

<ul style="padding-left: 5%">
    <li>Pró-Reitor e Gestor Institucional</li>
    <ul>
        <li>Consultar:</li>
        <ul>
            <li>Usuários</li>
            <li>Programas</li>
            <li>Editais</li>
            <li>Disciplinas</li>
            <li>Cursos</li>
        </ul>
    </ul>
</ul>

<ul style="padding-left: 5%">
    <li>Professor</li>
    <ul>
        <li>Consultar:</li>
        <ul>
            <li>Alunos que orienta ou já orientou</li>
            <li>Quanto tempo durou a orientação</li>
            <li>Tipo de bolsa associada ao programa</li>
        </ul>
    </ul>
</ul>

<ul style="padding-left: 5%">
    <li>Aluno</li>
    <ul>
        <li>Consultar:</li>
        <ul>
            <li>Programas que está inscrito</li>
            <li>Tipo de bolsa associada ao(s) programa(s) que está inscrito</li>
        </ul>
    </ul>
</ul>

        </div>
            
    </div>
@endsection
