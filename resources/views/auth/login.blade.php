@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h2 class="mb-4 text-center">Entrar na sua conta</h2>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    autofocus
                />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                    />
                    <button
                        type="button"
                        class="btn btn-outline-secondary btn-sm"
                        onclick="togglePasswordVisibility('password', this)"
                        tabindex="-1"
                    >
                        👁️
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('register') }}">Não tem uma conta? Cadastre-se</a>
        </div>
    </div>
</div>

{{-- Script para alternar visualização da senha --}}
<script>
    function togglePasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection
