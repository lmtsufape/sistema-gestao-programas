<div class="modal fade " id="modal_show_{{$orientador->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
      <div class="modal-header" >
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Orientador</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div class="row mb-3">
              <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Nome:</label>
              <div  style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$orientador->user->name}}</div>
            
              <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">CPF:</label>
              <div  style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$orientador->cpf}}</div>
           
              <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">E-mail:</label>
              <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$orientador->user->email}}</div>
           
              <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" for="matricula_editar" class="form-label mt-3">Matrícula:</label>
              <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$orientador->matricula}}</div>
            </div>
          </div>

        </div>
    </div>
  </div>
</div>
<style>
  .btn-secondary{
    color: #fff;
    background-color: #2d3875;
    border-color: #2d3875;
  }
  .btn-secondary:hover{
    background-color: #4353ab;
    border-color: #4353ab;
  }
</style>
