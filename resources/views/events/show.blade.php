@extends('layout')

@section('title', 'Detalhes da Evento')

@section('content')
<h1>Detalhes da Evento</h1>

<p><strong>Nome:</strong> {{ $event->name }}</p>
<p><strong>Descrição:</strong> {{ $event->description }}</p>
<p><strong>Estado:</strong> {{ $event->state }}</p>
<p><strong>Cidade:</strong> {{ $event->city }}</p>
<p><strong>Bairro:</strong> {{ $event->neighborhood }}</p>
<p><strong>CEP:</strong> {{ $event->zipcode }}</p>
<p><strong>Número:</strong> {{ $event->number }}</p>
<p><strong>Complemento:</strong> {{ $event->complement }}</p>
<p><strong>Data:</strong> {{ $event->date }}</p>

<a href="{{ route('events.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
