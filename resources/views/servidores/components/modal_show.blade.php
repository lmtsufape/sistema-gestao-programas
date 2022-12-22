<div class="modal fade " id="modal_show_{{$servidor->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content modal-create" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
      <div class="modal-header" >
        <h5 class="modal-title title fw-bold">Informações</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div class="row pb-3">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label"><strong>Nome</strong></label>
              <div  style="background: #F5F5F5; padding:3px; height: 30px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25); border-radius: 45px;"> {{$servidor->user->name}}</div>
            </div> 
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label"><strong>CPF</strong></label>
              <div  style="background: #F5F5F5; padding:3px; height: 30px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25); border-radius: 45px;"> {{$servidor->cpf}}</div>
            </div> 
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label"><strong>E-mail</strong></label>
              <div class="modal-ver" style="background: #F5F5F5; padding:3px; height: 30px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25); border-radius: 45px;">{{$orientador->user->email}}</div>
            </div> 
            <div class="col-sm- 12 col-md-6 mb-3">
              <label class="form-label"><strong>Tipo de servidor</strong></label>
              <div  style="background: #F5F5F5; padding:3px; height: 30px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25); border-radius: 45px;"> {{$servidor->tipo_servidor}}</div>
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
