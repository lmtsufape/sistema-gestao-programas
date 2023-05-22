<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="nome_social" class="titulo">Nome Social:</label>
            <input class="boxinfo" type="text" id="nome_social" name="nome_social" placeholder="Digite o nome social">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="cpf" class="titulo">CPF:</label>
            <input class="boxinfo" type="text"  id="cpf" name="cpf" required placeholder="Digite o CPF">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="email" class="titulo">Email:</label>
            <input class="boxinfo" type="email" id="email" name="email" required placeholder="Digite o email">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="senha" class="titulo">Senha:</label>
            <input type="password"  class="boxinfo" id="senha" name="senha" required placeholder="Digite a senha">
            <div class="invalid-feedback"> Por favor preencha esse campo</div><br><br>

            <label for="tipoUser" class="titulo">Tipo do usuário:</label>
            <select aria-label="Default select example" class="boxinfo" name="tipoUser" id="tipoUser">
                <option>Selece o tipo de usuario</option>
                <option value="servidor" selected>Servidor</option>
                <option value="orientador">Orientador</option>
                <option value="aluno">Aluno</option>
            </select> <br><br>

            <br>
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
