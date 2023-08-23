@extends("templates.app")

@section('body')

@canany(['admin', 'servidor', 'gestor', 'aluno'])

<div class="fundocadastrar">
    <div class="row" style="align-content: left;">
        <h1 class="titulogrande">Informações da Instituição</h1>
    </div>

    <hr style="color:#5C1C26; background-color: #5C1C26">

    <form action="{{ route('instituicao.index', ['instituicao' => $instituicao]) }}"method="post">
        @csrf
        
        <label class="titulopequeno" for="">Instituição: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->instituicao }}</div>

        <label class="titulopequeno" for="">Sigla: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->sigla }}</div>

        <label class="titulopequeno" for="">CNPJ: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->cnpj }}</div>

        <label class="titulopequeno" for="">Natureza Jurídica da Instituição: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->natureza_juridica }}</div>

        <label class="titulopequeno" for="">Endereço: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->endereco }}</div>

        <label class="titulopequeno" for="">Nº: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->numero }}</div>

        <label class="titulopequeno" for="">Complemento: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->complemento }}</div>

        <label class="titulopequeno" for="">CEP: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->CEP }}</div>

        <label class="titulopequeno" for="">Bairro: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->bairro }}</div>

        <label class="titulopequeno" for="">Cidade: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->cidade }}</div>

        <label class="titulopequeno" for="">Estado: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->estado }}</div>

        <label class="titulopequeno" for="">Representante: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->representante }}</div>

        <label class="titulopequeno" for="">Cargo do Representante: <strong style="color: #8B5558">*</strong></label>
        <div>{{ $instituicao->cargo_representante }}</div>
        
    </form>

    <br><br>
    <a href="{{ route('instituicao.edit') }}" class="btn btn-sm btn-primary">Editar</a>

</div>
</div>

@endcan
@endsection