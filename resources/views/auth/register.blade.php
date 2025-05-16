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
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="{{ $type }}"
                            name="{{ $field }}"
                            id="{{ $field }}"
                            class="form-control @error($field) is-invalid @enderror"
                            value="{{ $type !== 'password' ? old($field) : '' }}"
                        />
                        @error($field)
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach

                <div class="card-footer d-flex justify-content-end gap-2 px-0 border-0">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
