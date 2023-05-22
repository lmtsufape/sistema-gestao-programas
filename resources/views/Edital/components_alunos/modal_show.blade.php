<div class="modal fade " id="modal_show_{{$aluno->pivot->edital_id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px; text-align: center;" class="modal-title title fw-bold">Informações do Aluno</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <div class="mb-3">
          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Nome do aluno:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{  $aluno->nome_aluno  }} </div>
          
          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Edital:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{  $edital->titulo_edital }}</div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Início do edital:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{  $aluno->pivot->data_inicio }} </div>
          
          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Fim do edital:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{  $aluno->pivot->data_fim }}</div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Bolsa:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{  $aluno->pivot->bolsa }}</div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Informações complementares:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{  $aluno->pivot->info_complementares }}</div>
          
          
        </div>
        <div class="modal-footer">
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

  .link{
    background: #EEEEEE; 
    border-radius: 13px; 
    border: 1px #D3D3D3;
    width: 100%; 
    display:flex; 
    flex-direction:row; 
    flex-wrap:wrap; 
    justify-content:center; 
    align-items:center; 
    padding:5px; 
    margin:2px;
    text-decoration: none;
    color: #2D3875;
  }

  .link:hover{
    text-decoration: none;
    color:#34A853;
  }
</style>

