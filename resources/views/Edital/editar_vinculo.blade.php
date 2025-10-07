@extends("templates.app")

@section("body")

@can('editar vinculo estudante-edital')

<style>
    select[multiple] {
        overflow: hidden;
        background: #f5f5f5;
        width: 100%;
        height: auto;
        padding: 0px 5px;
        margin: 0;
        border-width: 2px;
        border-radius: 5px;
        -moz-appearance: menulist;
        -webkit-appearance: menulist;
        appearance: menulist;
    }

    /* select single */
    .required .chosen-single {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }

    /* select multiple */
    .required .chosen-choices {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 0px 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }

    .titulo {
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        display: flex;
        color: #131833;
    }

    .boxinfo {
        background: #F5F5F5;
        border-radius: 6px;
        border: 1px #D3D3D3;
        width: 100%;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }

    .boxlink {
        background: #F5F5F5;
        color: #000;
        border-radius: 6px;
        border: 1px #D3D3D3;
        width: 100%;
        padding: 5px;
    }

    .boxchild {
        background: #FFFFFF;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        padding: 34px;
        width: 65%;
    }

    .link{
        color: #2D3875;
        border: #2D3875;
        margin-top: 5px;
        margin-bottom: 5px;
        text-decoration: none;
    }

    .link:hover{
        color: #34A853;
    }

</style>
<div class="container-fluid" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; flex-direction: column;">
    @if (session('sucesso'))
    <div class="alert alert-success" style="width: 100%;">
        {{session('sucesso')}}
    </div>
    @endif
    <br>

    <div class="fundocadastrar">
        <div class="row" style="align-content: left;">
            <h1 class="titulogrande">Editar vínculo do aluno em {{$edital->titulo_edital}}</h1>
            <p style="textolegenda">{{$edital->descricao}}</p>
        </div>

        <br>

        <form action="{{  route('edital.update_vinculo', ['id' => $vinculo->id])  }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <label class="titulopequeno" for="nome_aluno">Nome do Aluno</label>
            <input type="text" id="nome_aluno" class="boxcadastrar" placeholder="Nome do aluno" value="{{$aluno->user->name}}" disabled>
            <br><br>

            <label class="titulopequeno" for="info_complementares">Informações complementares</label>
            <input type="text" id="info_complementares" class="boxcadastrar" name="info_complementares" placeholder="Informações complementares" value="{{$vinculo->info_complementares}}">
            <br>
            <br>

            <div style="display:flex; align-items: center; justify-content: space-around;">
                <div class="col-9">
                    <label class="titulopequeno" for="termo_compromisso_aluno">Termo de compromisso do aluno<strong style="color: #8B5558">*</strong></label>
                    <input type="file" id="termo_compromisso_aluno" class="form-control boxcadastrar" name="termo_compromisso_aluno">
                </div>
                <div class="col-3"">
                        <a class="titulopequeno" href="{{ route('termo_aluno.download', ['fileName' => $vinculo->termo_compromisso_aluno]) }}" target="_blank">
                            <img src="{{asset('images/download.svg')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
                            Baixar termo
                        </a>
                </div>
            </div>
            <br>
            <br>

            <div style="display:flex; align-items: center; justify-content: space-around;">
                <div class="col-9">
                    <label class="titulopequeno" for="plano_projeto">Plano de trabalho<strong style="color: #8B5558">*</strong> </label>
                    <input type="file" id="plano_projeto" class="form-control boxcadastrar" name="plano_projeto" value="{{ old('plano_projeto') }}">
                </div>
                <div class="col-3">
                        <a class="titulopequeno" href="{{ route('plano_trabalho.download', ['fileName' => $vinculo->plano_projeto]) }}" target="_blank" class="link">
                            <img src="{{asset('images/download.svg')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
                            Baixar plano
                        </a>
                </div>
            </div>
            <br>
            <br>

            <div style="display:flex; align-items: center; justify-content: space-around;">
                <div class="col-9">
                    <label class="titulopequeno" for="outros_documentos">Outros documentos</label>
                    <input type="file" id="outros_documentos" class="form-control boxcadastrar" name="outros_documentos" value="{{ old('outros_documentos') }}">
                </div>
                <div class="col-3">
                    @if($vinculo->outros_documentos != null)
                        <a class="titulopequeno" href="{{ route('outros_documentos.download', ['fileName' => $vinculo->outros_documentos]) }}" target="_blank" class="link">
                            <img src="{{asset('images/download.svg')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
                            Baixar Documentos
                        </a>
                    @else
                    <p class="titulopequeno">Não há documentos cadastrados.</p>
                    @endif
                </div>
            </div>
            <br>
            <br>

            <div class="botoessalvarvoltar">
                        <input type="button" value="Voltar" href="{{ route('edital.index')}}" onclick="window.location.href='{{ route("edital.index")}}'" class="botaovoltar">
                        <input class="botaosalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <br>
    <br>
</div>

@endcan
<script src="{{ mix('js/app.js') }}">
</script>

@endsection
