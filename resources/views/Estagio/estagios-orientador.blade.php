@extends('templates.app')

@section('body')
    <style>
        pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 10px 4px;
        }

        .pagination a.active {
            background-color: #3B864F;
            color: white;
            border: 1px solid #3B864F;
        }

        .pagination a:hover:not(.active) {
            background-color: #34A853;
        }

        .textolegenda {
            font-style: normal;
            font-weight: 400;
            font-size: 15px;
            line-height: 130%;
            margin: 5px
        }
    </style>

    <div class="container-fluid">
        @if (session('sucesso'))
            <div class="alert alert-success" style="width: 100%;">
                {{ session('sucesso') }}
            </div>
        @endif


        <div style="display: flex; justify-content: space-evenly; align-items: center;">
            <h1 class="titulo"><strong>Estágios vinculados</strong></h1>
        </div>

        <form class="search-container" action="{{ route('Estagio.estagios-aluno') }}" method="GET">
            <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                id="valor" name="valor" style="text-align: start">
            <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
            <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                onclick="window.location.href = '{{ route('estagio.create') }}'">Cadastrar estágio</button>
        </form>

    </div>
    <br>
    <br>

    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table">
                <thead>
                    <tr class="table-head">
                        <th scope="col" class="text-center align-middle">Status</th>
                        <th scope="col" class="text-center align-middle">Descrição</i></th>
                        <th scope="col" class="text-center align-middle">Curso</i></th>
                        <th scope="col" class="text-center align-middle">Data de solicitação</i></th>
                        <th scope="col" class="text-center align-middle">Data de início</th>
                        <th scope="col" class="text-center align-middle">Data de fim</th>
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
                <tbody>
                    @forelse ($estagios as $estagio)
                        <tr>
                            <td class="align-middle">
                                @if ($estagio->status == 1)
                                    <span class="badge badge-success"
                                        style="background-color: green; color: white;">Ativo</span>
                                @else
                                    <span class="badge badge-danger"
                                        style="background-color: red; color: white;">Inativo</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $estagio->descricao }}</td>
                            <td class="align-middle">{{ $estagio->curso->nome }}</td>
                            <td class="align-middle">{{ date_format(date_create($estagio->data_solicitacao), 'd/m/Y') }}
                            </td>
                            <td class="align-middle">{{ date_format(date_create($estagio->data_inicio), 'd/m/Y') }}</td>
                            <td class="align-middle">{{ date_format(date_create($estagio->data_fim), 'd/m/Y') }}</td>
                            <td>
                                <a type="button" href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}">
                                    <img src="{{ asset('images/mostrar-documentos.svg') }}" alt="Acessar Documentos"
                                        title="Documentos do estágio" style="height: 30px; width: 30px;">
                                </a>
                            @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum estágio encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
                @include('Estagio.components.modal_legenda')
            </table>
        </div>
    </div>

    </div>
@endsection
