@extends('templates.app')

@section('body')
    <h1><a href="/estagio/cadastrar">cadastrar</a></h1>

    @foreach ($estagios as $estagio)
        <li>
            <span style="display: inline;">{{ $estagio->descricao }} - {{ $estagio->data_inicio }} até {{ $estagio->data_fim }}</span>

            <a href="/estagio/{{ $estagio->id }}/edit" style="float: right,margin-right: 5px;;">editar</a>

            <a href="button" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $estagio->id }}">deletar </a>
            
        </li>
    @endforeach
@endsection

