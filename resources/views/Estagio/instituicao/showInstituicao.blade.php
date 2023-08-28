@extends("templates.app")

@section('body')

@canany(['admin', 'servidor', 'gestor', 'aluno'])

<div class="fundocadastrar">
    <div class="container-fluid">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Informações da Instituição</h1>
        </div>

        <br>

        <form action="{{ route('instituicao.index', ['instituicao' => $instituicao]) }}"method="post">
            @csrf
            
            <label class="input-informacao" for="">Instituição</label>
            <p class="output-informacao">{{ $instituicao->instituicao }}</p>

            <br>

            <label class="input-informacao" for="">Sigla</label>
            <p class="output-informacao">{{ $instituicao->sigla }}</p>

            <br>

            <label class="input-informacao"  for="">CNPJ</label>
            <p class="output-informacao">{{ $instituicao->cnpj }}</p>

            <br>

            <label class="input-informacao"  for="">Natureza Jurídica da Instituição</label>
            <p class="output-informacao">{{ $instituicao->natureza_juridica }}</p>

            <br>

            <label class="input-informacao"  for="">Endereço</label>
            <p class="output-informacao">{{ $instituicao->endereco }}</p>

            <br>

            <label class="input-informacao"  for="">Nº</label>
            <p class="output-informacao">{{ $instituicao->numero }}</p>

            <br>

            <label class="input-informacao"  for="">Complemento</label>
            <p class="output-informacao">{{ $instituicao->complemento }}</p>

            <br>

            <label class="input-informacao"  for="">CEP</label>
            <p class="output-informacao">{{ $instituicao->CEP }}</p>

            <br>

            <label class="input-informacao"  for="">Bairro</label>
            <p class="output-informacao">{{ $instituicao->bairro }}</p>

            <br>

            <label class="input-informacao"  for="">Cidade</label>
            <p class="output-informacao">{{ $instituicao->cidade }}</p>

            <br>

            <label class="input-informacao"  for="">Estado</label>
            <p class="output-informacao">{{ $instituicao->estado }}</p>

            <br>

            <label class="input-informacao"  for="">Representante</label>
            <p class="output-informacao">{{ $instituicao->representante }}</p>
            
            <br>

            <label class="input-informacao"  for="">Cargo do Representante</label>
            <p class="output-informacao">{{ $instituicao->cargo_representante }}</p>
            
        </form>

        <br>
        <br>
            <div style="display:flex; justify-content:right; margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <a href="{{url('/estagio/instituicao/edit')}}" class="btn btn-primary"
                style="display: flex; padding: 8.5px 15.5px; align-items: center; gap: 6px; border-radius: 10px; border: 1.5px solid var(--teste-12, #BD8184); background-color: white; color: var(--teste-11, #972E3F);
                font-family: Inter; font-size: 12px; font-style: normal; font-weight: 700; line-height: normal; align-items: center;">
                <img src="{{asset("images/lapis-editarperfil.png")}}" style="width: 20px; height: 20px;" alt="Editar servidor"> Editar</a>
        </div>
        </div>
    </div>
</div>

@endcan
@endsection