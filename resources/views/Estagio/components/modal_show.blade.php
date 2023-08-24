@canany(['admin', 'servidor', 'aluno', 'orientador', 'pro_reitor', 'gestor'])
<div class="modal " id="modal_show{{$estagio->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Estágio</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: start">
        <div class="mb-3">

          <label class="tituloinfomodal form-label mt-3">Status:</label>
          <div class="textoinfomodal">
            @if($estagio->status == 0)
              {{"Inativo"}}
            @else
              {{"Ativo"}}
            @endif
          </div>

          <label class="tituloinfomodal form-label mt-3">Descrição:</label>
          <div class="textoinfomodal"> {{$estagio->descricao}} </div>

          <label class="tituloinfomodal form-label mt-3">Tipo:</label>
          <div class="textoinfomodal">
            @if($estagio->tipo == "eno")
              {{"Não-Obrigatório"}}
            @else
              {{"Obrigatório"}}
            @endif
          </div>

          <label class="tituloinfomodal form-label mt-3">Data de início:</label>
          <div class="textoinfomodal"> {{date_format(date_create($estagio->data_inicio), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Data de fim:</label>
          <div class="textoinfomodal"> {{date_format(date_create($estagio->data_fim), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Data da solicitação:</label>
          <div class="textoinfomodal"> {{date_format(date_create($estagio->data_solicitacao), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Professor:</label>
          <div class="textoinfomodal"> {{$estagio->orientador->user->name}} </div>

          <label class="tituloinfomodal form-label mt-3">Estudante:</label>
          <div class="textoinfomodal"> {{$estagio->aluno->nome_aluno}} </div>


        </div>

        <div class="modal-footer border-0">
          <button type="button"  class="btn" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>

  </div>
</div>
<style>
  .btn {
    color: #fff;
    background: #34A853;
    border-color: #34A853;
    border-radius: 20px;
    width:120px;
  }

  .btn:hover {
    background-color: #40b760;
    border-color: #40b760;
    color: #fff;
  }

</style>
@else
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
