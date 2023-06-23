<div class="modal fade " id="modal_documents{{$aluno->pivot->aluno_id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px; text-align: center;" class="modal-title title fw-bold">Documentos do Estudante</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <div class="mb-3">
          <label for="termo_compromisso_aluno" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Termo de compromisso:</label>
          <div style="justify-content: flex-start; align-items: flex-start; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('termo_aluno.download', ['fileName' => $aluno->pivot->termo_compromisso_aluno]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>
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