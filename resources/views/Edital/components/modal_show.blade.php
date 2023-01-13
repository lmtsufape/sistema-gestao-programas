<div class="modal fade " id="modal_show_{{$edital->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #EEEEEE; font-family: 'Roboto', sans-serif;">
            <div class="modal-header" >
                <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Edital</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow: auto">
                <div class="">
                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Data de início:</label>
                    <div  style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{date_format(date_create($edital->data_inicio), "d/m/Y")}}</div>

                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Data de fim:</label>
                    <div  style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> {{date_format(date_create($edital->data_fim), "d/m/Y")}}</div>

                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Semestre:</label>
                    <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$edital->semestre}}</div>

                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Curso:</label>
                    <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$edital->curso->nome}}</div>

                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Programa:</label>
                    <div style="background: #F9F9F9; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$edital->programa->nome}}</div>

                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833;" class="form-label mt-3">Orientadores:</label>
                    <div>
                        @foreach ($edital->edital_orientadors as $edital_orientadors)
                            @foreach ($orientadores as $orientador)
                                @if ($edital_orientadors->id_orientador == $orientador->id)
                                    <label>{{$orientador->user->name}}</label><br>
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