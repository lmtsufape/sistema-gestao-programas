@canany(['admin', 'pro_reitor', 'gestor'])
  <div class="modal " id="modal_show_{{$servidor->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header" >
          <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Servidor</h5>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body" style="text-align: start">
            <div class="mb-3">

              <div class="modal-body" style="text-align: start">
                @if ($servidor->user->image)
                <img src="/images/fotos-perfil/{{ $servidor->user->image }}" class="img-fluid profilepic mb-3"
                                alt="Foto de perfil">
                @else

                <img src="/images/sem-foto-perfil.png"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">

                @endif
              </div>

                <label class="tituloinfomodal form-label mt-3">Nome</label>
                <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->user->name}}</div>

                @if($servidor->nome_social != null)
                  <label class="tituloinfomodal form-label mt-3">Nome social</label>
                  <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->nome_social}}</div>
                @endif

                <label class="tituloinfomodal form-label mt-3">CPF</label>
                <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{$servidor->cpf}}</div>

                <label class="tituloinfomodal form-label mt-3">E-mail</label>
                <div class="textoinfomodal">{{$servidor->user->email}}</div>

                <label class="tituloinfomodal form-label mt-3">Tipo do servidor</label>
                @switch($servidor->tipo_servidor)
                  @case('adm')
                    <div class="textoinfomodal"> Administrador</div>
                    @break
                  @case('pro_reitor')
                    <div class="textoinfomodal"> Pró-Reitor</div>
                    @break
                  @case('servidor')
                    <div class="textoinfomodal"> Servidor</div>
                    @break
                  @case('gestor')
                    <div class="textoinfomodal"> Gestor Institucional</div>
                    @break

                @endswitch
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button"  class="btn " data-bs-dismiss="modal">Fechar</button>
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
@elsecan
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan
