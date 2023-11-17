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
                <h1 class="titulo"><strong>Supervisores</strong></h1>
            </div>

            {{-- TODO: Falta adicionar um modal com os possiveis filtros  --}}
            <form class="search-container" action="{{ route('supervisor.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <button class="search-button" title="Fazer a pesquisa" type="submit" value=""></button>
                <button class="cadastrar-botao" type="button"
                    onclick="window.location.href = '{{ route('supervisor.create') }}'"">Cadastrar supervisor</button>
            </form>

            <br>
            <br>

            @if (empty($supervisors))
                <div class="empty">
                    <p>
                        Não há supervisores cadastrados
                    </p>
                </div>
            @else
                <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                    <div class="col-md-9 corpo p-2 px-3">
                        <table class="table">
                            <thead>
                                <tr class=table-head>
                                    <th scope="col" class="text-center align-middle">Nome</th>
                                    <th scope="col" class="text-center align-middle">E-mail</th>
                                    <th scope="col" class="text-center align-middle">CPF</th>
                                    <th scope="col" class="text-center align-middle">Formação</th>
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
                            @foreach ($supervisors as $supervisor)
                                <tbody>
                                    <tr>
                                        <td class="align-middle">{{ $supervisor->nome }}</td>
                                        <td class="align-middle">{{ $supervisor->email }}</td>
                                        <td class="align-middle">{{ $supervisor->cpf }}</td>
                                        <td class="align-middle">{{ $supervisor->formacao }}</td>

                                        <td class="align-middle">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_show_{{ $supervisor->id }}">
                                                <img src="{{ asset('images/information.svg') }}" title="Informações" alt="Info supervisor"
                                                    style="height: 30px; width: 30px;">
                                            </a>
                                            <a type="button" href="{{ url('/supervisor/' . $supervisor->id . '/edit') }}">
                                                <img src="{{ asset('images/pencil.svg') }}" title="Editar" alt="Editar supervisor"
                                                    style="height: 30px; width: 30px;">
                                            </a>
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_delete_{{ $supervisor->id }}">
                                                <img src="{{ asset('images/delete.svg') }}" title="Remover" alt="Deletar supervisor"
                                                    style="height: 30px; width: 30px;">
                                            </a>
                                        </td>
                                    </tr>

                                    @include('Supervisor.components.modal_legenda')
                                    @include('Supervisor.components.modal_delete', [
                                        'supervisor' => $supervisor,
                                    ])
                                    @include('Supervisor.components.modal_show', ['supervisor' => $supervisor])
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
