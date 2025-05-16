@extends('layouts.index')

@section('title', 'Criar Evento')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Criar Novo Evento</h1>

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" />
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" />
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">Estado:</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" />
                    @error('state')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Cidade:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" />
                    @error('city')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="neighborhood" class="form-label">Bairro:</label>
                    <input type="text" name="neighborhood" id="neighborhood" class="form-control" value="{{ old('neighborhood') }}" />
                    @error('neighborhood')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="zipcode" class="form-label">CEP:</label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ old('zipcode') }}" />
                    @error('zipcode')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Número:</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{ old('number') }}" />
                    @error('number')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="complement" class="form-label">Complemento:</label>
                    <input type="text" name="complement" id="complement" class="form-control" value="{{ old('complement') }}" />
                    @error('complement')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Data:</label>
                    <input type="datetime-local" name="date" id="date" class="form-control" value="{{ old('date') }}" />
                    @error('date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card-footer d-flex justify-content-end gap-2 px-0 border-0">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
