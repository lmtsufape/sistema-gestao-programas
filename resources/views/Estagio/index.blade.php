@extends('templates.app')

@section('body')
    <h1><a href="/estagio/cadastrar">cadastrar</a></h1>

    @foreach ($estagios as $estagio)
        <li>{{ $estagio->descricao }} - {{ $estagio->data_inicio }} até {{ $estagio->data_fim }}</li>
    @endforeach

@endsection
