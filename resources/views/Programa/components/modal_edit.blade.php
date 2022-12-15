<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$programa->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create" style="background-color: #FFFFFF; padding: 0 10px;">
      <div class="modal-header" >
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;">
        Informações do programa</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('home')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$programa->id}}">
        <div class="modal-body">
          <div class="mb-3" style="">
            <label for="nome_edit" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
            Nome:</label>
            {{--  <input name="name" type="text" placeholder="Digite o nome" value="{{old('name', $programa->nome)}}"
            class="@if(!empty($errors->update->first('name'))) is-invalid @endif" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
            <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            {{old('name', $programa->nome)}}</div>
            @if(!empty($errors->update->first('name')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('name')}} </strong>
                  </span>
            @endif
          </div>       
          </div>
          {{--  <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px; background-color: #2D3875;
          font-weight: 700; font-size: 20px; line-height: 29px;">Fechar</button>  --}}
        </div>
      </form>
    </div>
  </div>
</div>

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