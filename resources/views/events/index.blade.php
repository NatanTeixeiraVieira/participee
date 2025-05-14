@extends('layout')

@section('title', 'Lista de Eventos')

@section('content')
<h1>Lista de Eventos</h1>

<a href="{{ route('events.create') }}" class="btn btn-primary mb-3"
    >Criar Nova Evento</a
>

<ul class="list-group">
    @foreach($events as $event)
    <li
        class="list-group-item d-flex justify-content-between align-items-center"
    >
        {{ $event->titulo }}
        <div>
            <a
                href="{{ route('events.show', $event->id) }}"
                class="btn btn-sm btn-info"
                >Ver</a
            >

            <a
                href="{{ route('events.edit', $event->id) }}"
                class="btn btn-sm btn- warning"
                >Editar</a
            >

            <form
                action="{{ route('events.destroy', $event->id) }}"
                method="POST"
                style="display: inline"
            >
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    Excluir
                </button>
            </form>
        </div>
    </li>
    @endforeach
</ul>
@endsection
