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
<h3>O que é o sistema de gestão de programas acadêmicos (SGPA)?</h3>
<p>É uma aplicação web desenvolvida no âmbito da cooperação técnica UFAPE-LMTS / UPE com o objetivo de facilitar o gerenciamento de programas acadêmicos, auxiliando os responsáveis nas suas rotinas de trabalho, como increver alunos e professores nos programas, etc.</p>

<h3>Principais funcionalidades</h3>
<ul style="padding-left: 5%">
    <li>Administrador</li>
    <ul>
        <li>Cadastrar e editar:</li>
        <ul>
            <li>Usuários</li>
            <li>Materiais</li>
            <li>Depósitos</li>
        </ul>
    </ul>

    <ul>
        <li>Consultar:</li>
        <ul>
            <li>Estoque total de materiais</li>
            <li>Materiais por depósito</li>
            <li>Histórico de solicitações</li>
        </ul>
    </ul>
    <ul>
        <li>Gerenciar estoque:</li>
        <ul>
            <li>Entrada de material</li>
            <li>Saída de material</li>
            <li>Transferência de material entre depósitos</li>
        </ul>
    </ul>
    <ul>
        <li>Gerenciar solicitações:</li>
        <ul>
            <li>Analisar solicitação:</li>
            <ul>
                <li>Aprovar solicitação totalmente</li>
                <li>Aprovar solicitação parcialmente</li>
                <li>Negar solicitação</li>
                <li>Retirar pedido</li>
                <li>Entregar materiais</li>
                <li>Cancelar solicitação</li>
                
            </ul>
        </ul>
    </ul>
</ul>
<ul style="padding-left: 5%">
    <li>Requerente</li>
    <ul>
        <li>Editar:</li>
        <ul>
            <li>Dados do próprio perfil</li>
            <li>Senha</li>
        </ul>
    <li>Fazer solicitação:</li>
    <ul>
        <li>De um ou mais materiais</li>
        <li>Para o próprio requerente buscar ou outra pessoa especificada</li>
        <li>Consultar histórico de solicitações:</li>
    </ul>
    </ul>
</ul>

        </div>
            
    </div>
@endsection
