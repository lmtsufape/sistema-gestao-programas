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
                <h1 class="titulo"><strong>Servidores</strong></h1>
            </div>

            {{-- TODO: Falta adicionar um modal com os possiveis filtros  --}}
            <form class="search-container" action="{{ route('servidores.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <button class="search-button" title="Fazer a pesquisa" type="submit" value=""></button>
                @if (auth()->user()->typage->tipo_servidor != 'pro_reitor' && auth()->user()->typage->tipo_servidor != 'gestor')
                    <button class="cadastrar-botao" type="button"
                        onclick="window.location.href = '{{ route('servidores.create') }}'"">Cadastrar servidor</button>
                @endif
            </form>

            <br>
            <br>

            @if (empty($servidores))
                <div class="empty">
                    <p>
                        Não há servidores cadastrados
                    </p>
                </div>
            @else
                <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                    <div class="col-md-9 corpo p-2 px-3">
                        <table class="table">
                            <thead>
                                <tr class=table-head>
                                    <th scope="col" class="text-center">Nome</th>
                                    <th scope="col" class="text-center">E-mail</th>
                                    <th scope="col" class="text-center">CPF</th>
                                    <th scope="col" class="text-center">Tipo de Servidor</th>
                                    <th class="text-center">
                                        Ações
                                        <button type="button" class="infobutton" data-bs-toggle="modal"
                                            data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                            <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda"
                                                style="height: 20px; width: 20px;">
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($servidores as $servidor)
                                <tbody>
                                    <tr>
                                        <td class="align-middle">{{ $servidor->user->name }}</td>
                                        <td class="align-middle">{{ $servidor->user->email }}</td>
                                        <td class="align-middle">{{ $servidor->cpf }}</td>
                                        @switch($servidor->tipo_servidor)
                                            @case('adm')
                                                <td class="align-middle">Administrador</td>
                                            @break

                                            @case('pro_reitor')
                                                <td class="align-middle">Pró-reitor</td>
                                            @break

                                            @case('servidor')
                                                <td class="align-middle">Técnico Administrativo</td>
                                            @break

                                            @case('gestor')
                                                <td class="align-middle">Gestor Institucional</td>
                                            @break
                                        @endswitch

                                        <td class="align-middle">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_show_{{ $servidor->id }}">
                                                <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                    alt="Info servidor" style="height: 30px; width: 30px;">
                                            </a>
                                            @if (auth()->user()->typage->tipo_servidor != 'pro_reitor' && auth()->user()->typage->tipo_servidor != 'gestor')
                                                <a href="{{ url('/servidores/' . $servidor->id . '/edit') }}">
                                                    <img src="{{ asset('images/pencil.svg') }}" title="Editar"
                                                        alt="Editar servidor" style="height: 30px; width: 30px;">
                                                </a>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_delete_{{ $servidor->id }}">
                                                    <img src="{{ asset('images/delete.svg') }}" title="Remover"
                                                        alt="Deletar servidor" style="height: 30px; width: 30px;">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    @include('servidores.components.modal_legenda')
                                    @include('servidores.components.modal_delete', [
                                        'servidor' => $servidor,
                                    ])
                                    @include('servidores.components.modal_show', ['servidor' => $servidor])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--
                                            <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                                                        <div style="align-self: center; margin-right: auto">
                                                            <br>
                                                            <h4 class="fw-bold"style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
                                                        </div>
                                              <div style="align-self: center; margin-right: auto">
                                                <div style="display: flex; margin: 10px">
                                                  <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
                                                  <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
                                                </div>
                                              </div>
                                              <div style="align-self: center; margin-right: auto">
                                                <div style="display: flex; margin: 10px">
                                                  <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
                                                  <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
                                                </div>
                                                <div style="display: flex; margin: 10px">
                                                  <a><img src="{{ asset('images/delete.png') }}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
                                                  <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
                                                </div>

                                                <div style="display: flex; margin: 10px">
                                                  <a><img src="{{ asset('images/searchicon.png') }}" alt="Procurar" style="width: 20px; height: 20px;"></a>
                                                  <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
                                                </div>
                                              </div>
                                                </div>
                                              </div>
                                              <br>
                                              <br>
        @endif
                                              -->
                </div>

        </div>

        <script type="text/javascript">
            function exibirModalAdicionaPermissao(id) {
                $('#modal_adicionaPermissao_' + id).modal('show');
            }

            function exibirModalDeletar(id) {
                $('#modal_delete_' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show_' + id).modal('show');
            }
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
