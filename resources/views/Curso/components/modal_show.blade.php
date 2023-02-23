<div class="modal fade " id="modal_show_{{$curso->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #f5f5f5; font-family: 'Roboto', sans-serif;">
            <div class="modal-header" >
                <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Curso</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow: auto">
                <div class="">
                  <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Curso:</label>
                  <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #EEEEEE; width: 100%; padding: 5px; box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);">{{$curso->nome}} </div>

                  <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Disciplinas:</label>
                  <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #EEEEEE; width: 100%; padding: 5px; box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);">

                      @foreach ($curso->curso_disciplinas as $curso_disciplinas)
                              @foreach ($disciplinas as $disciplina)
                                  @if ($curso_disciplinas->id_disciplina == $disciplina->id)
                                    <label>{{$disciplina->nome}}</label><br>
                                    @break
                                  @endif
                              @endforeach
                      @endforeach
                    
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