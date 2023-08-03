@extends('templates.app')

@section('body')
    <h1><a href="/estagio/cadastrar">Cadastrar</a></h1>

    @foreach ($estagios as $estagio)
        <li>
            <span style="display: inline;">{{ $estagio->descricao }} - {{ $estagio->data_inicio }} até {{ $estagio->data_fim }}</span>

            <a href="/estagio/{{ $estagio->id }}/edit" style="float: right,margin-right: 5px;">Editar
            </a>

            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$estagio->id}}">
                <img src="{{asset("images/delete.png")}}" alt="Deletar estágio" style="height: 30px; width: 30px;">
              </a>
            
        </li>
        
    @include("Estagio.components.modal_delete", ["estagio" => $estagio])
    @endforeach

@endsection

