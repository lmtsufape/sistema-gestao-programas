@canany(['admin', 'pro_reitor'])
  <div class="modal fade " id="modal_show_{{$servidor->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header" >
          <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Servidor</h5>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="row mb-3">
                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Nome:</label>
                <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->user->name}}</div>

                @if($servidor->nome_social != null)
                  <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Nome social:</label>
                  <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->nome_social}}</div>
                @endif

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">CPF:</label>
                <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->cpf}}</div>

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">E-mail:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$servidor->user->email}}</div>
                
                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Tipo do servidor:</label>
                @switch($servidor->tipo_servidor)
                  @case('adm')
                    <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> Administrador</div>
                    @break
                  @case('pro_reitor')
                    <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> Pró-Reitor</div>
                    @break
                  @case('servidor')
                    <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> Servidor</div>                   
                @endswitch
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
@elsecan
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan
