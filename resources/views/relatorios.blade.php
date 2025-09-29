@extends('templates.app')
@section('css')
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    <link rel="stylesheet" href="../../../css/home.css">
@endsection
@section('body')

<div class="container-lg pb-5">
    <div class="shadow card p-2 my-5">
        <div class="card-header bg-white">
            <h3 class="">Painel de Filtros</h3>
        </div>
        <div class="card-body row my-5">
            <form action="{{route('relatorios')}}" method="get">
                <div class="col-md-3">
                    <input type="date" class="form-control" name="filter[data_inicial]"
                        value="{{ request('filter.data_inicial') }}" placeholder="Data inicial">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="filter[data_final]"
                        value="{{ request('filter.data_final') }}" placeholder="Data final">
                </div>

                <div class="col-md-2">
                    <select class="form-control" name="filter[tipo_vinculo]">
                        <option value="" hidden class="text-center">Tipo de vínculo</option>
                        <option value="" @selected(request('filter.tipo_vinculo') === null || request('filter.tipo_vinculo') === '')>
                            Todos os vínculos
                        </option>
                        <option value="bolsista"   @selected(request('filter.tipo_vinculo')==='bolsista')>Bolsista</option>
                        <option value="voluntario" @selected(request('filter.tipo_vinculo')==='voluntario')>Voluntário</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" name="filter[semestre]"
                        placeholder="2025.1" value="{{ request('filter.semestre') }}">
                </div>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>


    @foreach ($infos_por_programas as $quadroIndex => $info)
        @php
            $semestres = collect([
                ...array_keys($info['tipo']['total']['por_semestre'] ?? []),
                ...array_keys($info['tipo']['bolsistas']['por_semestre'] ?? []),
                ...array_keys($info['tipo']['voluntarios']['por_semestre'] ?? []),
            ])->unique()->sort()->values();

            $rows = [];
            if (!empty($info['tipo']['bolsistas']['total']) || !empty($info['tipo']['bolsistas']['por_semestre'])) {
                $rows[] = ['label' => 'Bolsista',   'key' => 'bolsistas'];
            }
            if (!empty($info['tipo']['voluntarios']['total']) || !empty($info['tipo']['voluntarios']['por_semestre'])) {
                $rows[] = ['label' => 'Voluntária', 'key' => 'voluntarios'];
            }
            $temTotal = count($rows) >= 2;
        @endphp

        <div class="mb-6">
            <div class="text-center font-semibold mb-1">
                Quadro {{ $loop->iteration }} - Quantidade de Discentes Atendidos pelo Programa
            </div>

            <table class="table border">
                <thead>
                <tr>
                    <th rowspan="2" class="p-2 text-left border">Nº</th>
                    <th rowspan="2" class="p-2 text-left border">Programa Acadêmico</th>
                    <th rowspan="2" class="p-2 text-center border">Tipo</th>
                    <th rowspan="2" class="p-2 text-right border">Quant. Discentes</th>
                    <th class="p-2 text-center border" colspan="{{ $semestres->count() }}">Semestre</th>
                    <th rowspan="2" class="p-2 text-center border">Eventos</th>
                    <th rowspan="2" class="p-2 text-center border">Editais</th>
                </tr>
                <tr>
                    @foreach ($semestres as $sem)
                        <th class="p-2 text-center border">{{ $sem }}</th>
                    @endforeach
                </tr>
                </thead>

                <tbody>
                    @foreach ($rows as $rIdx => $r)
                        <tr>
                            <td class="border p-2 text-left">{{ $rIdx + 1 }}</td>
                            <td class="border p-2 text-left">{{ $info['programa_nome'] }}</td>
                            <td class="border p-2 text-center">{{ $r['label'] }}</td>

                            @php
                                $totalTipo = (int) ($info['tipo'][$r['key']]['total'] ?? 0);
                            @endphp
                            <td class="border p-2 text-right">{{ $totalTipo }}</td>

                            @foreach ($semestres as $sem)
                                @php
                                    $val = (int) ($info['tipo'][$r['key']]['por_semestre'][$sem] ?? 0);
                                @endphp
                                <td class="border p-2 text-center">{{ $val }}</td>
                            @endforeach

                            @if ($rIdx === 0)
                                <td class="border p-2 text-center" rowspan="{{ count($rows) }}">
                                    {{ $info['eventos'] ?? 0}}
                                </td>
                                <td class="border p-2 text-center" rowspan="{{ count($rows) }}">
                                    {{ (int) ($info['total_editais'] ?? 0) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    @if ($temTotal)
                        <tr>
                            <td class="border p-2"></td>
                            <td class="border p-2"></td>
                            <td class="border p-2"><strong>Total</strong></td>
                            <td class="border p-2 text-right">
                                <strong>{{ (int)($info['tipo']['total']['geral'] ?? 0) }}</strong>
                            </td>
                            @foreach ($semestres as $sem)
                                <td class="border p-2 text-center">
                                    <strong>{{ (int)($info['tipo']['total']['por_semestre'][$sem] ?? 0) }}</strong>
                                </td>
                            @endforeach
                            <td class="border p-2"></td>
                            <td class="border p-2"></td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    @endforeach
</div>


@endsection
