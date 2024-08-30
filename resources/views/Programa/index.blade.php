@extends('templates.app')

@section('body')
    @canany(['admin', 'pro_reitor', 'gestor'])
        <div class="container-fluid">
            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Programas</strong></h1>
            </div>

            <form class="search-container" action="{{ route('programas.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca"
                    title="Digite a sua pesquisa" id="valor" name="valor" style="text-align: start">
                <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>


                @cannot(['pro_reitor', 'gestor'])
                    <button class="cadastrar-botao" type="button"
                        onclick="window.location.href = '{{ route('programas.create') }}'">Cadastrar programa</button>
                @endcannot

            </form>

            <br>
            <br>

            @if (sizeof($programas) == 0)
                <div class="empty">
                    <p>
                        Não há programas cadastrados
                    </p>
                </div>
            @else
                <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                    <div class="col-md-9 corpo p-2 px-3">
                        <table class="table">
                            <thead>
                                <tr class=table-head>
                                    <th scope="col" class="text-center align-middle">Nome</th>
                                    <th scope="col" class="text-center align-middle">Descrição</th>
                                    <th class="text-center">
                                        Ações
                                        <button type="button" class="infobutton align-bottom" data-bs-toggle="modal"
                                            data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                            <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda"
                                                style="height: 20px; width: 20px;">
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($programas as $programas)
                                <tbody>
                                    <tr>
                                        <td class="align-middle"> {{ $programas->nome }} </td>
                                        <td class="align-middle"> {{ $programas->descricao }} </td>
                                        <td class="align-middle">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_show_{{ $programas->id }}">
                                                <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                    alt="Info programa" style="height: 30px; width: 30px;">
                                            </a>
                                            @cannot(['gestor', 'pro_reitor'])
                                                <a type="button" href="{{ url("/programas/$programas->id/atribuir-servidor") }}">
                                                    <img src="{{ asset('images/add_servidor.svg') }}" title="Adicionar servidor"
                                                        alt="Add Servidor" style="height: 30px; width: 30px;">
                                                </a>
                                            @endcannot
                                            <a type="button" href="{{ url("/programas/$programas->id/editais") }}">
                                                <img src="{{ asset('images/listar_edital.svg') }}" title="Listar edital"
                                                    alt="Listar edital" style="height: 30px; width: 30px;">
                                            </a>
                                            @cannot('pro_reitor')
                                                <a type="button" href="{{ url("/programas/$programas->id/criar-edital") }}">
                                                    <img src="{{ asset('images/add_edital.svg') }}" title="Adicionar edital"
                                                        alt="Add Edital" style="height: 30px; width: 30px;">
                                                </a>
                                                <a type="button" href="{{ url("/programas/$programas->id/edit") }}">
                                                    <img src="{{ asset('images/pencil.svg') }}" title="Editar"
                                                        alt="Editar programa" style="height: 30px; width: 30px;">
                                                </a>
                                            @endcannot
                                            @cannot(['pro_reitor', 'gestor'])   
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_delete_{{ $programas->id }}">
                                                    <img src="{{ asset('images/delete.svg') }}"title="Remover"
                                                        alt="Deletar programa" style="height: 30px; width: 30px;">
                                                </a>
                                            @endcannot  
                                        </td>
                                    </tr>
                                    @include('Programa.components.modal_legenda')
                                    @include('Programa.components.modal_show', [
                                        'programa' => $programas,
                                        'servidors' => $servidors,
                                        'users' => $users,
                                    ])
                                    @include('Programa.components.modal_delete', [
                                        'programa' => $programas,
                                    ])
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                   
                </div>

        </div>

        </div>
        </div>
        <br>
        @endif
        </div>

        <script type="text/javascript">
            function exibirModalDeletar(id) {
                $('#modal_delete_' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show_' + id).modal('show');
            }
        </script>

        <!-- Exibindo erros de validacao ao criar -->
        @if (count($errors->create) > 0)
            <script type="text/javascript">
                $(function() {
                    // Bloqueando o usuario na tela de modal apos falha na validacao.
                    // Forcando ele a clicar no botao de fechar, para limpar os erros
                    $("#modal_create").modal({
                        backdrop: "static",
                        keyboard: false
                    });
                    $("#modal_create").modal('show');
                });
            </script>
        @endif

        <!-- Exibindo erros de validacao ao editar -->
        @if (count($errors->update) > 0)
            <script type="text/javascript">
                $(function() {
                    // Bloqueando o usuario na tela de modal apos falha na validacao.
                    // Forcando ele a clicar no botao de fechar, para limpar os erros
                    $("#modal_edit_{{ old('id') }}").modal({
                        backdrop: "static",
                        keyboard: false
                    });
                    $("#modal_edit_{{ old('id') }}").modal('show');
                });
            </script>
        @endif
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
