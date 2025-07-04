@extends('templates.app')

@section('body')
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-evenly; align-items: center;">
        <h1 class="titulo"><strong>Meus Editais - Vinculos Ativos</strong></h1>
    </div>

    <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor"
            name="valor" style="text-align: start">
        <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
    </form>

    <br>
    <br>

    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table">
                <thead class=table-head>
                    <tr>
                        <th scope="col" class="text-center align-middle">Título</i></th>
                        <th scope="col" class="text-center align-middle">Data de início</th>
                        <th scope="col" class="text-center align-middle">Data de fim</th>
                        <th scope="col" class="text-center align-middle">Programa</th>
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
                @foreach ($editais as $edital)
                    @isset($edital)
                        <tbody>
                            <tr>

                                <td class="align-middle">{{ $edital->titulo_edital }}</td>
                                <td class="align-middle">{{ date_format(date_create($edital->data_inicio), 'd/m/Y') }}</td>
                                <td class="align-middle">{{ date_format(date_create($edital->data_fim), 'd/m/Y') }}</td>
                                <td class="align-middle">{{ $edital->programa->nome }}</td>
                                <td class="align-middle">

                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{ $edital->id }}">
                                        <img src="{{ asset('images/information.svg') }}" alt="Info edital"
                                            style="height: 30px; width: 30px;" title="Informações do Edital">
                                    </a>
                                    <a type="button" alt="Listar orientadores"
                                        href="{{ route('edital.listar_orientadores', ['id' => $edital->id]) }}">
                                        <img src="{{ asset('images/orientadores.svg') }}" alt="Listar orientadores"
                                            style="height: 30px; width: 30px;" title="Professores Vinculados">
                                    </a>
                                    @if ($edital->programa->nome == 'Monitoria')
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_frequencia">
                                            <img src="{{ asset('images/add_edital.svg') }}" alt="Frequencia"
                                                style="height: 30px; width: 30px; ">
                                        </a>
                                        @foreach ($pivos as $pivo)
                                            @php
                                                $latestFrequencia = null;
                                            @endphp

                                            @foreach ($pivo->frequencias as $frequencia)
                                                @if ($frequencia->frequencia_mensal != null)
                                                    @php
                                                        $latestFrequencia = $frequencia;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            @if ($latestFrequencia)
                                                <a type="button"
                                                    href="{{ route('frequencia.download', ['fileName' => $latestFrequencia->frequencia_mensal]) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('images/download.svg') }}" alt="baixar arquivo"
                                                        style="height: 30px; width: 30px; ">
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif

                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modal_relatorio_{{ $edital->id }}">
                                        <img src="{{ asset('images/file-plus_red.svg') }}" alt="Relatorio"
                                            style="height: 30px; width: 30px; " title="Relatório Final">
                                    </a>

                                </td>
                            </tr>

                        </tbody>
                        @include('Edital.components.modal_show', ['edital' => $edital])
                        @include('Alunos.components.modal_frequencia')
                        @include('Alunos.components.modal_relatorio')
                    @endisset
                @endforeach
            </table>
        </div>
    </div>

    @include('Alunos.components.modal_legenda_editais_aluno')
@endsection
