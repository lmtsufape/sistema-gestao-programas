@extends("templates.app")

@section("body")

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
@if (session('sucesso'))
    <div class="alert alert-success" style="width: 100%;">
        {{session('sucesso')}}
    </div>
@endif


<div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">

    <h1 style="color:#2D3875;"><strong>Meus Programas</strong></h1>
    <div style="margin: auto"></div>
    <form action="" method="GET">
        <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px;  margin-right: 10px">

        <input type=" submit" value="" style="background-image: url('/images/searchicon.png');
              background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              width: 40px;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              position: absolute;
              margin: auto;" />
    </form>
</div>
<br>

<div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
        <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
        min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
           <thead>
          <tr>
            <th scope="col">Título</i></th>
            <th scope="col">Data de início</th>
            <th scope="col">Data de fim</th>
            <th scope="col">Programa</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($editais as $edital)
          <tr>
            <td style="border-right: 1px solid #d3d3d3;">{{ $edital->titulo_edital}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($edital->data_inicio), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($edital->data_fim), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{$edital->programa->nome}}</td>
            <td>


              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$edital->id}}">
                <img src="{{asset("images/info.png")}}" alt="Info edital" style="height: 30px; width: 30px;">
              </a>
              @if ($edital->programa->nome == 'Monitoria')
                <a class="link" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                  <img src="{{asset("images/document.png")}}" alt="Frequencia" style="height: 40px; width: 40px;">
                </a>
              @endif
              <a class="link" alt="Listar orientadores" href="{{  route('edital.listar_orientadores', ['id' => $edital->id]) }}" >
                <img src="{{asset("images/orientadores.png")}}" alt="Listar orientadores" style="height: 40px; width: 40px;">
              </a>

            </td>
          </tr>
          <tr>
            {{-- Não apagar esse tr  --}}
          </tr>
        </tbody>
        @include("Edital.components.modal_show", ["edital" => $edital])
        @endforeach
                </tbody>
            </table>
        </div>

        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
            width: 150px; height: 50%;">
            <div style="align-self: center; margin-right: auto">
                <br>
                <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
            </div>

            <div style="align-self: center; margin-right: auto">
                <div style="display: flex; margin: 10px">
                    <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
                    <p class="textolegenda">Informações</p>
                </div>
                <div style="display: flex; margin: 10px">
                    <a><img src="{{asset('images/searchicon.png')}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
                    <p class="textolegenda">Pesquisar</p>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Frequencia Mensal do Monitor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="container form"
              action="{{ Route('frequencia.enviar') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body" style="text-align: start">
                  <label>Frequencia Mensal:</label>
                  <input class="w-75 form-control" type="file" name="frequencia_mensal" id="frequencia_mensal"
                      title="Envie sua frequencia" required>
              </div>
              <input type="hidden" name="edital_id" value="{{$edital->id}}">
              <div class="modal-footer border-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success">Enviar</button>
              </div>
          </form>

      </div>
  </div>
</div>

@endsection
