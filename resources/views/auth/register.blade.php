@extends('layouts.guest')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Cadastro de Usuário</h1>

    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                @foreach ([
                    ['name', 'Nome', 'text'],
                    ['email', 'Email', 'email'],
                    ['password', 'Senha', 'password'],
                    ['password_confirmation', 'Confirmar Senha', 'password']
                ] as [$field, $label, $type])
                    <div class="mb-4">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>

                        @if (in_array($field, ['password', 'password_confirmation']))
                            <div class="position-relative">
                                <input
                                    type="password"
                                    name="{{ $field }}"
                                    id="{{ $field }}"
                                    class="form-control @error($field) is-invalid @enderror"
                                />
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary btn-sm position-absolute"
                                    style="top: 50%; right: 32px; transform: translateY(-50%);"
                                    onclick="togglePassword('{{ $field }}')"
                                    tabindex="-1"
                                >
                                    👁️
                                </button>
                                 @error($field)
                                    <div class="invalid-feedback position-absolute">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @else
                            <input
                                type="{{ $type }}"
                                name="{{ $field }}"
                                id="{{ $field }}"
                                class="form-control @error($field) is-invalid @enderror"
                                value="{{ old($field) }}"
                            />
                        @endif

                        @error($field)
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach

                <div class="card-footer d-flex justify-content-end gap-2 px-0 border-0">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="{{ route('login') }}" class="btn btn-link">Já tem conta? Entrar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
@endsection
