@extends('layouts.index')

@section('title', 'Participee')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Bem-vindo ao Sistema de Gerenciamento de Eventos</h1>
        <p class="lead mt-3">
            Este sistema foi desenvolvido para facilitar o controle completo de eventos, desde o cadastro até a visualização detalhada de cada informação.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🎯 Objetivo</h5>
                    <p class="card-text">
                        Nosso objetivo é oferecer uma plataforma simples e eficiente para o gerenciamento de eventos. Com poucos cliques, você pode cadastrar e editar informações com rapidez e segurança.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🛠️ Funcionalidades</h5>
                    <ul class="card-text">
                        <li>Cadastro de eventos com dados completos</li>
                        <li>Edição e atualização em tempo real</li>
                        <li>Interface responsiva e amigável</li>
                        <li>Busca rápida por eventos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🔒 Segurança</h5>
                    <p class="card-text">
                        O sistema protege seus dados com as boas práticas de desenvolvimento. Todos os formulários contam com proteção CSRF e validação de dados.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg px-4">
            Acessar Eventos
        </a>
    </div>
</div>
@endsection
