@canany(['admin', 'servidor', 'pro_reitor', 'gestor'])
<div class="modal " id="modal_show_{{$orientador->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Orientador</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">

            <div class="modal-body">
              @if ($orientador->user->image)
              <img src="/images/fotos-perfil/{{ $orientador->user->image }}"  class="img-fluid mt-3" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">
              @else

              <img src="/images/sem-foto-perfil.png"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">

              @endif
            </div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome:</label>
            <div class="textoinfomodal"> {{$orientador->user->name}}</div>

            @if ($orientador->user->name_social != null)
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
            <div class="textoinfomodal"> {{$orientador->user->name_social}}</div>
            @endif

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">CPF:</label>
            <div class="textoinfomodal"> {{$orientador->cpf}}</div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">E-mail:</label>
            <div class="textoinfomodal">{{$orientador->user->email}}</div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" for=" matricula_editar" class="form-label mt-3">Matrícula:</label>
            <div class="textoinfomodal"> {{$orientador->matricula}}</div>

            <label class="tituloinfomodal form-label mt-3">Curso(s):</label>
            <div class="textoinfomodal">
            @foreach($orientador->cursos as $curso)
              {{$curso->nome}}<br>
            @endforeach
            </div>

            <label class="tituloinfomodal form-label mt-3">Instituição:</label>
            <div class="textoinfomodal"> {{$orientador->instituicaoVinculo}}</div>
        </div>
        <div class="modal-footer border-0">
          <button type="button"  class="btn " data-bs-dismiss="modal">Fechar</button>
        </div>
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
