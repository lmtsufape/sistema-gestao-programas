@extends('templates.app')


@section('body')
    <div class="container">
        <div class="form-card">
            <div class="form-content">
                <h2 class="title-form">Redefinição de Senha</h2>
                <hr class="divisor-login">
            </div>

            <form class="form-content" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-body">
                    <div class="field mb-2">
                        <label for="email" class="titulo-login">E-mail</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field mb-2">
                        <label for="password" class="titulo-login">Nova senha</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password" class="titulo-login">Confirmar senha</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="red-button">Refefinir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
