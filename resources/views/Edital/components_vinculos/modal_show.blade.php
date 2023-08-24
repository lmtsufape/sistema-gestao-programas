@canany(['admin', 'servidor', 'aluno', 'orientador'])
<div class="modal " id="modal_show{{$vinculo->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Vínculo</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: start">
        <div class="mb-3">

          <label class="tituloinfomodal form-label mt-3">Título:</label>
          <div class="textoinfomodal"> {{$vinculo->edital->titulo_edital}} </div>

          <label class="tituloinfomodal form-label mt-3">Semestre de Início:</label>
          <div class="textoinfomodal"> {{$vinculo->edital->semestre}} </div>

          <label class="tituloinfomodal form-label mt-3">Descrição:</label>
          <div class="textoinfomodal"> {{$vinculo->edital->descricao}} </div>

          <label class="tituloinfomodal form-label mt-3">Valor da Bolsa:</label>
          <div class="textoinfomodal">
          @if($vinculo->edital->valor_bolsa)
          {{$vinculo->edital->valor_bolsa}}
          @else
          {{"Não possui"}}
          @endif
          </div>

          <label class="tituloinfomodal form-label mt-3">Data de início:</label>
          <div class="textoinfomodal"> {{date_format(date_create($vinculo->edital->data_inicio), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Data de fim:</label>
          <div class="textoinfomodal"> {{date_format(date_create($vinculo->edital->data_fim), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Programa:</label>
          <div class="textoinfomodal"> {{$vinculo->edital->programa->nome}} </div>

          <label class="tituloinfomodal form-label mt-3">Disciplina(s):</label>
          <div class="textoinfomodal">
          @if(count($vinculo->edital->disciplinas) != 0)
            @foreach($vinculo->edital->disciplinas as $disciplina)
              {{$disciplina->nome}}<br>
            @endforeach
          @else
            {{"Não há disciplinas"}}
          @endif
          </div>

          <label class="tituloinfomodal form-label mt-3">Nome do Aluno:</label>
          <div class="textoinfomodal"> {{$vinculo->aluno->user->name}} </div>

          <label class="tituloinfomodal form-label mt-3">CPF do Aluno:</label>
          <div class="textoinfomodal"> {{$vinculo->aluno->cpf}} </div>

          <label class="tituloinfomodal form-label mt-3">Bolsista?:</label>
          @if($vinculo->bolsista == 1)
            <div class="textoinfomodal">Sim</div>
          @else
            <div class="textoinfomodal">Não</div>
          @endif

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
