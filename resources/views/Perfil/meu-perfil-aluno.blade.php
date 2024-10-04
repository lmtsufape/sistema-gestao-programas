@extends('templates.app')

@section('body')
    <div class="fundocadastrar"
        style="width: 70%; background: #FBFBFB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px; margin-bottom: 50px; margin-top: 4rem;
                                    padding: 10px 40px 30px 40px; margin-top:2rem; border-radius: 15px; border: 1px solid var(--preto-p-50, #E6E6E6); background: var(--branco, #FFF); box-shadow: 0px 1px 9px 0px rgba(106, 32, 44, 0.13);">
        <div class="container-fluid">
            <div
                style="display: flex; width: 796px; flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px;">
                <h1 style="color:#292323;"><strong>Meu Perfil</strong></h1>
            </div>

        </div>

        @auth
            @role('estudante')
                <div class="container-fluid" style="padding-top: 10px;">

                    @if ($aluno->user->image)
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 20px;">
                            <img src=" /images/fotos-perfil/{{ $aluno->user->image }}" class="img-fluid"
                                style="width: 80px; height: 80px; border-radius:50px" alt="Foto de perfil">
                            <div
                                style="color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                                {{ $aluno->user->name_social }}</div>
                        </div>
                    @else
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 20px;">
                            <img src="/images/sem-foto-perfil.png" class="img-fluid" style="width: 80px; height: 80px;"
                                alt="Foto de perfil">
                            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                <div
                                    style="color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                                    {{ $aluno->user->name_social }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- @if ($aluno->name_social != null)
                            <div style="display: flex; flex-direction: column;">
                            <label style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">Nome completo</label>
                            <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">{{ $aluno->name_social }} </div>
                            </div>
                            @endif -->

                    <br>

                    <div style="display: flex; flex-direction: column;">
                        <label
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">Nome
                            completo</label>
                        <div
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                            {{ $aluno->user->name }} </div>
                    </div>

                    <br>

                    <div style="display: flex; flex-direction: column;">
                        <label
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">E-mail</label>
                        <div
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                            {{ $aluno->user->email }} </div>

                        <br>

                        <div style="display: flex; flex-direction: column;">
                            <label
                                style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">CPF</label>
                            <div
                                style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                                {{ $aluno->cpf }} </div>

                            <br>

                            <div style="display: flex; flex-direction: column;">
                                <label
                                    style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">Semestre
                                    de Entrada</label>
                                <div
                                    style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">
                                    {{ $aluno->semestre_entrada }} </div>
                            </div>

                            @endif
                            <br>
                            <br>
                        </div>
                        {{-- editar perfil - botão  --}}
                        <div style="display:flex; justify-content:right; margin-bottom: 10px;  gap: 20px; margin-top: 20px">
                            <a href="{{ url('/alunos/' . $aluno->id . '/editarmeuperfil') }}" class="btn btn-primary"
                                style="display: flex; padding: 8.5px 15.5px; align-items: center; gap: 6px; border-radius: 10px; border: 1.5px solid var(--teste-12, #BD8184); background-color: white; color: var(--teste-11, #972E3F);
                font-family: Inter; font-size: 12px; font-style: normal; font-weight: 700; line-height: normal; align-items: flex-end;">
                                <img src="{{ asset('images/lapis-editarperfil.png') }}" style="width: 20px; height: 20px;"
                                    alt="Editar servidor"> Editar</a>
                        </div>
                    @endauth
                </div>
            @endrole
@endsection
