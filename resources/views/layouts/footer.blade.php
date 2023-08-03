@section('css')
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="../../../css/footer.css">
@endsection

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <!-- Logos à esquerda -->
            <div class="col-3" style="margin-top: 20px; padding-left: 100px">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="http://ufape.edu.br/" target="_blank" style=>
                        <img src="{{asset('images/sgpa-branco 1.svg')}}" alt="Logo SGPA" style="margin-left: 20px">
                    </a>
                </div>
            </div>

            <!-- Logos do centro -->
            <div class="col-6 d-flex justify-content-center" style="margin-top: 14px">
                <div class="d-flex justify-content-around">
                    <a href="http://ufape.edu.br/" target="_blank" style="padding-right:20px">
                        <img src="{{ asset('images/logo_ufape_vertical.png') }}" alt="Logo UFAPE" class="logo-box" style="height:70px; width: 95px">
                    </a>
                    <a href="http://lmts.uag.ufrpe.br/" target="_blank" style="padding-right:20px">
                        <img src="{{ asset('images/logo_ufape_color.png') }}" alt="Logo LMTS" class="logo-box" style="height:70px; width: 95px">
                    </a>
                    <a href="https://upe.br/" target="_blank">
                        <img src="{{ asset('images/logoupe.png') }}" alt="Logo UPE" class="logo-box" style="height:70px; width: 95px">
                    </a>
                </div>
            </div>

            <!-- Logos à direita -->
            <div class="col-3">
                <div class="d-flex align-items-center justify-content-end" style="margin-top: 30px; padding-right: 100px">
                    <a href="https://www.facebook.com/LMTSUFAPE/" target="_blank">
                        <img src="{{asset('images/logo_facebook_branco.svg')}}" alt="Logo Facebook" style="height: 40px; padding-right:20px">
                    </a>
                    <a href="https://www.instagram.com/lmts_ufape/" target="_blank">
                        <img src="{{asset('images/logo_instagram_branco.svg')}}" alt="Logo Instagram" style="height: 40px; padding-right: 20px">
                    </a>
                    <a href="mailto:lmts@ufrpe.br" target="_blank">
                        <img src="{{asset('images/logo_google_branco.svg')}}" alt="Logo Google" style="height: 40px; padding-right: 20px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>