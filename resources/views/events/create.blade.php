@extends('layout')

@section('title', 'Criar Evento')

@section('content')
<h1>Criar Nova Evento</h1>

<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição:</label>
        <input
            type="text"
            name="description"
            id="description"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="state" class="form-label">Estado:</label>
        <input
            type="text"
            name="state"
            id="state"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Cidade:</label>
        <input
            type="text"
            name="city"
            id="city"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="neighborhood" class="form-label">Bairro:</label>
        <input
            type="text"
            name="neighborhood"
            id="neighborhood"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="zipcode" class="form-label">CEP:</label>
        <input
            type="text"
            name="zipcode"
            id="zipcode"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="number" class="form-label">Número:</label>
        <input
            type="number"
            name="number"
            id="number"
            class="form-control"
            required
        />
    </div>
    <div class="mb-3">
        <label for="complement" class="form-label">Complemento:</label>
        <input
            type="text"
            name="complement"
            id="complement"
            class="form-control"
        />
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Data:</label>
        <input
            type="datetime-local"
            name="date"
            id="date"
            class="form-control"
            required
        />
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
