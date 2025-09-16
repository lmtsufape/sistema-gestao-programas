@extends('templates.app')

@section('body')
    <div class="container">
        <h1 class="mb-4">Gerenciar Tokens de Integração</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('integrations.upsert') }}" method="POST">
            @csrf

            @foreach ($systems as $system)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ $system }}</span>
                    </div>

                    <div class="card-body row">
                        <div class="col-md-12">
                            <label class="form-label">Token para {{ $system }}</label>
                            <div class="input-group">
                                <input type="password" name="systems[{{ $system }}]" id="token-{{ $loop->index }}"
                                    class="form-control" placeholder="Insira o token do {{ $system }}"
                                    value="{{ old('systems.' . $system) }}">
                            </div>
                            <small class="text-muted">
                                @if (isset($tokens[$system]) && !empty($tokens[$system]))
                                    Um token já está salvo. Deixe em branco para não alterar.
                                @else
                                    Nenhum token cadastrado ainda.
                                @endif
                            </small>
                            @error('systems.' . $system)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    @if (isset($tokens[$system]) && !empty($tokens[$system]))
                        <div class="card-footer">
                            <form action="{{ route('integrations.delete', ['name' => $system]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir o token de {{ $system }}?')">
                                    Deletar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Salvar Tokens</button>
        </form>
    </div>
@endsection
