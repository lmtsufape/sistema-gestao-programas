@canany(['admin', 'servidor'])
<div class="modal fade " id="modal_show{{$edital->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Edital</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <div class="mb-3">

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Título:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->titulo_edital}} </div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Semestre:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->semestre}} </div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Descrição:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->descricao}} </div>
          
          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Valor da Bolsa:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->valor_bolsa}} </div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Data de início:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{date_format(date_create($edital->data_inicio), "d/m/Y")}}</div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Data de fim:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{date_format(date_create($edital->data_fim), "d/m/Y")}}</div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Programa:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->programa->nome}} </div>

          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Disciplina:</label>
          <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$edital->disciplina->nome}} </div>
          
          @canany(['admin', 'servidor'])
          <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Alunos:</label> 
          <div style=" display:flex; flex-wrap:wrap; justify-content:center; align-items:center;">
            <a class="link" alt="Listar alunos" href="{{  route('edital.vinculo', ['id' => $edital->id]) }}" class="link">
              <img src="{{asset("images/bx_user.png")}}" >
              Listar alunos
            </a> 
          </div> 
          @endcan
          
        </div>

        <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Orientador:</label>
        <div style=" display:flex; flex-wrap:wrap; justify-content:center; align-items:center;">
          <a class="link" alt="Listar orientadores" href="{{  route('edital.listar_orientadores', ['edital_id' => $edital->id]) }}" style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3;width: 100%; display:flex; flex-direction:row; flex-wrap:wrap; justify-content:center; align-items:center; padding:5px; margin:2px;">
            <img src="{{asset("images/bx_user.png")}}" >
            Listar orientadores
          </a> <br>
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
    color: #2D3875;
    text-decoration: none;
  }

  .link:hover{
    color: #34A853;
    text-decoration: none;
  }
</style>
@else
<h3 style="margin-top: 1rem">Você não possui permissão!</h3>
<a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
