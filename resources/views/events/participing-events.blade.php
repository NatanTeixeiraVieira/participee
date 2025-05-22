@extends('layouts.index')

@section('title', 'Participando')

@section('content')
<div class="container py-4 d-flex flex-column min-vh-100">
    <h1 class="mb-4">Eventos que estou participando</h1>

    @if($events->count())
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($events as $event)
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text text-muted mb-1">
                        <strong>📍 Local:</strong> {{ $event->city }}, {{
                        $event->state }}
                    </p>
                    <p class="card-text text-muted mb-1">
                        <strong>🗓 Data:</strong> {{
                        \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i')
                        }}
                    </p>
                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit($event->description,
                        100) }}
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a
                        href="{{ route('events.show', $event->id) }}"
                        class="btn btn-sm btn-primary"
                        style="width: 80px"
                    >
                        Ver
                    </a>
                   <form action="{{ route('events.leave', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" style="width: 80px">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">
        Você não está participando de nenhum evento no momento.
    </div>
    @endif
</div>
@endsection
