@extends('layouts.index')

@section('title', 'Detalhes do Evento')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📋 Detalhes do Evento</h4>
                </div>

                <div class="card-body">
                    <p><strong>📝 Nome:</strong> {{ $event->name }}</p>
                    <p><strong>📄 Descrição:</strong> {{ $event->description }}</p>
                    <p><strong>📍 Estado:</strong> {{ $event->state }}</p>
                    <p><strong>🏙️ Cidade:</strong> {{ $event->city }}</p>
                    <p><strong>🏘️ Bairro:</strong> {{ $event->neighborhood }}</p>
                    <p><strong>📬 CEP:</strong> {{ $event->zipcode }}</p>
                    <p><strong>🏠 Número:</strong> {{ $event->number }}</p>
                    <p><strong>➕ Complemento:</strong> {{ $event->complement ?? 'N/A' }}</p>
                    <p><strong>🗓 Data:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</p>
                    <p><strong>👤 Criado por:</strong> {{ $event->creator->name ?? 'Desconhecido' }}</p>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">⬅ Voltar para lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
