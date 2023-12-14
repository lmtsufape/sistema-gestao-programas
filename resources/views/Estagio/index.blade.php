@extends('templates.app')

@section('body')
    @canany(['admin', 'servidor', 'pro_reitor', 'gestor'])

        <style>
            .sortable a {
                color: inherit;
                text-decoration: none;
            }

            .sortable a:hover {
                color: inherit;
                text-decoration: none;
            }

            .ascending::after {
                content: " \25B2";
                /* Triângulo para cima */
            }

            .descending::after {
                content: " \25BC";
                /* Triângulo para baixo */
            }
        </style>

        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" style="width: 100%;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('falha'))
                <div class="alert alert-danger">
                    {{ session('falha') }}
                </div>
            @endif
            <br>

            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Estágios</strong></h1>
            </div>

            <form class="search-container" action="{{ route('estagio.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
                <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                    onclick="window.location.href = '{{ route('estagio.verificarAluno') }}'">Cadastrar estágio</button>
                <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                    onclick="window.location.href = '{{ route('estagio.editConfig') }}'">Configurar estágios</button>
                <button class="cadastrar-botao" style="margin-right: 10px" type="button"
                    onclick="window.location.href = '{{ route('instituicao.index') }}'">Informações da instituição</button>
                <button class="cadastrar-botao" type="button"
                    onclick="window.location.href = '{{ route('estagio.export-form') }}'">Exportar dados</button>
            </form>



            <br>
            <br>

            <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                <div class="col-md-10 corpo p-2 px-3">
                    <table class="table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('status', 'Status')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('descricao', 'Descrição')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('data_solicitacao', 'Data de solicitação')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('data_inicio', 'Data de início')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('data_fim', 'Data de fim')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('curso.nome', 'Curso')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('orientador.id', 'Professor')</th>
                                <th scope="col" class="text-center align-middle sortable">@sortablelink('aluno.nome_aluno', 'Estudante')</th>
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
                            @foreach ($estagios as $estagio)
                                @php
                                    $id_curso = $estagio->curso_id;
                                    $curso = $cursos->firstWhere('id', $id_curso);
                                @endphp
                                <tr>
                                    <td class="align-middle">
                                        @if ($estagio->status == 0)
                                            {{ 'Inativo' }}
                                        @else
                                            {{ 'Ativo' }}
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $estagio->descricao }}</td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->created_at), 'd/m/Y') }}</td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->data_inicio), 'd/m/Y') }}
                                    </td>
                                    <td class="align-middle">{{ date_format(date_create($estagio->data_fim), 'd/m/Y') }}</td>
                                    <td class="align-middle"> {{ $curso->nome }}</td>
                                    <td class="align-middle">{{ $estagio->orientador->user->name }}</td>
                                    <td class="align-middle">{{ $estagio->aluno->nome_aluno }}</td>
                                    <td>


                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_show{{ $estagio->id }}">
                                            <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                alt="Info Estagio" style="height: 30px; width: 30px;">
                                        </a>

                                        <a type="button" href="{{ route('estagio.documentos', ['id' => $estagio->id]) }}">

                                            <img src="{{ asset('images/document.svg') }}" title="Documentos"
                                                alt="Visualizar documentos" style="height: 30px; width: 30px;">

                                        </a>

                                        <a type="button" href="{{ route('estagio.edit', ['id' => $estagio->id]) }}">
                                            <img src="{{ asset('images/pencil.svg') }}" title="Editar" alt="Editar Estagio"
                                                style="height: 30px; width: 30px;">
                                        </a>

                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_delete_{{ $estagio->id }}">
                                            <img src="{{ asset('images/delete.svg') }}"title="Remover" alt="Deletar Estagio"
                                                style="height: 30px; width: 30px;">
                                        </a>


                                    </td>
                                </tr>
                                <tr>
                                    {{-- Não apagar esse tr  --}}
                                </tr>
                        </tbody>
                        @include('Estagio.components.modal_legenda')
                        @include('Estagio.components.modal_show', ['estagio' => $estagio])
                        @include('Estagio.components.modal_delete', ['estagio' => $estagio])
                        @endforeach
                    </table>

                    {{ $estagios->links('vendor.pagination.bootstrap-4') }}

                </div>

            </div>
            <br>
            <br>
        </div>

        <script type="text/javascript">
            function exibirModalDeletar(id) {
                $('#modal_delete_' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show' + id).modal('show');
            }

            // Algorítmo de ordenação de tabelas
            // $(document).ready(function() {
            //     $('.sortable').click(function() {
            //         const table = $(this).parents('table').eq(0);
            //         const rows = table.find('tr:gt(0)').toArray();
            //         const index = $(this).index();

            //         if ($(this).hasClass('ascending')) {
            //             rows.sort(comparer(index, true));
            //             $(this).removeClass('ascending').addClass('descending');
            //         } else {

            //             table.find('.sortable').removeClass('ascending descending');
            //             $(this).addClass('ascending');
            //             rows.sort(comparer(index, false));
            //         }

            //         for (let i = 0; i < rows.length; i++) {
            //             table.append(rows[i]);
            //         }
            //     });
            // });

            // function comparer(index, reverse) {
            //     return function(a, b) {
            //         const valA = getCellValue(a, index);
            //         const valB = getCellValue(b, index);

            //         if (reverse) {
            //             return compareValues(valB, valA);
            //         } else {
            //             return compareValues(valA, valB);
            //         }
            //     };
            // }

            // function getCellValue(row, index) {
            //     return $(row).children('td').eq(index).text();
            // }

            // function compareValues(valueA, valueB) {
            //     if (valueA === valueB) return 0;
            //     const dateA = parseDate(valueA);
            //     const dateB = parseDate(valueB);
            //     if (dateA !== null && dateB !== null) {
            //         return dateA - dateB;
            //     }
            //     return valueA.localeCompare(valueB, undefined, {
            //         numeric: true,
            //         sensitivity: 'base'
            //     });
            // }

            // function parseDate(dateStr) {
            //     const parts = dateStr.split('/');
            //     if (parts.length === 3) {
            //         const day = parseInt(parts[0], 10);
            //         const month = parseInt(parts[1], 10) - 1;
            //         const year = parseInt(parts[2], 10);
            //         if (day >= 1 && day <= 31 && month >= 0 && month <= 11 && year >= 1000) {
            //             return new Date(year, month, day);
            //         }
            //     }
            //     return null;
            // }
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
