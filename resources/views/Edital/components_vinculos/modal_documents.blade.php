<div class="modal " id="modal_documents{{$vinculo->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px; text-align: center;" class="modal-title title fw-bold">Documentos do Vínculo</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <div class="mb-3">
          @if($vinculo->termo_aluno != null)
          <label for="termo_aluno" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Termo do Aluno:</label>
          <div style="justify-content: flex-start; align-items: center; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('aluno_termo.download', ['fileName' => $vinculo->termo_aluno]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>

          <label for="termo_orientador" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Termo do Orientador:</label>
          <div style="justify-content: flex-start; align-items: center; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('orientador_termo.download', ['fileName' => $vinculo->termo_orientador]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>

          <label for="historico_escolar" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Histórico Escolar:</label>
          <div style="justify-content: flex-start; align-items: center; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('historico_escolar.download', ['fileName' => $vinculo->historico_escolar]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>
          @endif

          @if($vinculo->comprovante_bancario != null)
          <label for="comprovante_bancario" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Comprovante bancário:</label>
          <div style="justify-content: flex-start; align-items: center; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('comprovante_bancario.download', ['fileName' => $vinculo->comprovante_bancario]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>
          @endif
          <div class="modal-footer">
          <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .link{
    color: #2D3875;
    border: #2D3875;
    margin-top: 5px;
    margin-bottom: 5px;
  }
  .link:hover{
    color: #34A853;
  }

  .btn-secondary {
    color: #fff;
    background-color: #2d3875;
    border-color: #2d3875;
  }

  .btn-secondary:hover {
    background-color: #4353ab;
    border-color: #4353ab;
  }
</style>
