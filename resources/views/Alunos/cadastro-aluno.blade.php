@extends("templates.app")

@section("body")
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container-fluid p-5" style="margin: auto">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card card-cadastro bg-white shadow">
                <div class="card-body p-5">
                    <form class="row needs-validation" novalidate style="text-align:start;">
                        <h2 class="fw-bold mb-3 text-start ">Cadastro</h2>
                        <hr>
                        <div class="col-12">
                            <label for="inputName" class="form-label fw-bold">Nome Completo:</label>
                            <input type="text" class="form-control" id="inputName" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-6">
                            <label for="inputCpf" class="form-label fw-bold">CPF:</label>
                            <input type="text" class="form-control" id="inputCpf" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>    
                        <div class="col-6">
                            <label for="inputSemestre" class="form-label fw-bold">Semestre de Entrada:</label>
                            <input type="text" class="form-control" id="inputSemestre" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-12">
                            <label for="inputInstituicao" class="form-label fw-bold">Instituição:</label>
                            <input type="text" class="form-control" id="inputInstituicao" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-12">
                            <label for="inputCurso" class="form-label fw-bold">Curso:</label>
                            <input type="text" class="form-control" id="inputCurso" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label fw-bold">Email:</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="email@upe.br" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-6">
                            <label for="inputPassword4" class="form-label fw-bold">Senha:</label>
                            <input type="password" class="form-control" id="inputPassword4" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        <div class="col-6">
                            <label for="confirmPassword" class="form-label fw-bold">Confirme sua Senha:</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                            <div class="invalid-feedback"> Por favor preencha esse campo</div>
                        </div>
                        
                       
                         <div class="buttons-group d-flex justify-content-between mt-4">
                            <a href="#" class="btn btn-secondary" id="botao1">Voltar <a> 
                            <button type="submit" class="btn btn-primary" id="botao2">Cadastrar</button>
                        </div>                      
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
   (() => {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
        }, false)
    })
    })()
</script>

@endsection