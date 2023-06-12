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
    margin:5px
  }
</style>



  <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
        <h1><strong>Modelos de documentos</strong></h1>
        <p> </p>
        <p class="textolegenda">Aqui você pode visualizar os modelos de documentos disponíveis para download.</p>
        <div style="margin: auto"></div>
  </div>

<div style="padding-bottom: 6px">
    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="align-middle">Modelo</td>
                        <td class="align-middle">Descrição do documento</td>
                        <td class="align-middle">Download</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                <div style="align-self: center; margin-right: auto">
                    <br>
                    <h4 style="font-size: 15px">Legenda dos ícones:</h4>
                </div>

                <div style="align-self: center; margin-right: auto">
                    <div style="display: flex; margin: 10px">
                        <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
                        <p class="textolegenda">Informações</p>
                    </div>
                    <div style="align-self: center; margin-right: auto">
                        <div style="display: flex; margin: 10px">
                            <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
                            <p class="textolegenda">Editar</p>
                        </div>
                        <div style="display: flex; margin: 10px">
                            <a><img src="{{asset("images/delete.png")}}" alt="Deletar aluno" style="width: 20px; height: 20px;"></a>
                            <p class="textolegenda">Deletar</p>
                        </div>
                        <div style="display: flex; margin: 10px">
                        <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
                        <p class="textolegenda">Pesquisar</p>
                    </div>
                    </div>

                </div>
        </div>

    </div>

</div>

@endsection
