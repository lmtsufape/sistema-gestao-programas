@canany(['admin', 'servidor'])
<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$aluno->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header" >
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Estudante</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('home')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$aluno->id}}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nome_edit" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;">
            Nome:</label>
            {{--  <input name="name" type="text" placeholder="Digite o nome" value="{{old('name', $aluno->user->name)}}"
            class="@if(!empty($errors->update->first('name'))) is-invalid @endif"
            style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            {{old('name', $aluno->user->name)}}</div>
            @if(!empty($errors->update->first('name')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('name')}} </strong>
                  </span>
            @endif
          </div>

          @if ($aluno->nome_social != null)
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> </div>
          @endif

          <div class="mb-3">
            <label for="email_edit" class="form-label"
            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;">E-mail:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
              {{old('name', $aluno->user->email)}}</div>
            {{--  <input name="email" type="text" placeholder="Digite o email" value="{{old('email', $aluno->user->email)}}"
            class="@if(!empty($errors->update->first('email'))) is-invalid @endif"
            style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
            @if(!empty($errors->update->first('email')))
                <span class="invalid-feedback d-block">
                  <strong> {{$errors->update->first('email')}} </strong>
                </span>
            @endif
          </div>

            <div class="mb-3">
              <label for="cpf_edit" class="form-label"style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"">
                CPF:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                  {{old('name', $aluno->cpf)}}</div>
              {{--  <input name="cpf" id="cpf_edit" type="text" placeholder="Digite o CPF" value="{{old('cpf', $aluno->cpf)}}"
              class="@if(!empty($errors->update->first('cpf'))) is-invalid @endif"
              style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> --}}
              @if(!empty($errors->update->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('cpf')}} </strong>
                  </span>
              @endif
            </div>
            {{--  <!-- TODO: Editar as infos do back -->  --}}


          <div class="row">
            <div class="mb-3">
              <label for="curso_edit" class="form-label"
              style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"">
              Curso:</label>
              <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $aluno->curso->nome)}}</div>
              {{--  <input name="curso" type="text" placeholder="Digite o curso" value="{{old('curso', $aluno->curso)}}"
              class="@if(!empty($errors->update->first('curso'))) is-invalid @endif"
              style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('curso')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('curso')}} </strong>
                  </span>
              @endif
            </div>

            <div class="mb-4">
              <label for="curso_edit" class="form-label"
              style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"">
              Semestre de entrada:</label>
              <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $aluno->semestre_entrada)}}</div>
              {{--  <input name="curso" type="text" placeholder="Digite o curso" value="{{old('curso', $aluno->curso)}}"
              class="@if(!empty($errors->update->first('curso'))) is-invalid @endif"
              style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('semestra_entrada')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('semestra_entrada')}} </strong>
                  </span>
              @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn " data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </form>
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
<script type="text/javascript">
    $(function () {
      $('#cpf_edit').mask('000.000.000-00');
    });
</script>

<script type="text/javascript">
    $(function () {
      $('#semestre_entrada_edit').mask('0000.0');
    });
</script>

@elsecan
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/home")}}">Voltar</a>
@endcan
