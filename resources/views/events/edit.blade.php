@extends('layouts.index')

@section('title', 'Editar Evento')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Editar Evento</h1>

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome:</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $event->name) }}"
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <input
                        type="text"
                        name="description"
                        id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        value="{{ old('description', $event->description) }}"
                    />
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="zipcode" class="form-label">CEP:</label>
                    <input
                        type="text"
                        name="zipcode"
                        id="zipcode"
                        class="form-control @error('zipcode') is-invalid @enderror"
                        value="{{ old('zipcode', $event->zipcode) }}"
                    />
                    @error('zipcode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">Estado:</label>
                    <input
                        type="text"
                        name="state"
                        id="state"
                        class="form-control @error('state') is-invalid @enderror"
                        value="{{ old('state', $event->state) }}"
                    />
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Cidade:</label>
                    <input
                        type="text"
                        name="city"
                        id="city"
                        class="form-control @error('city') is-invalid @enderror"
                        value="{{ old('city', $event->city) }}"
                    />
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="neighborhood" class="form-label">Bairro:</label>
                    <input
                        type="text"
                        name="neighborhood"
                        id="neighborhood"
                        class="form-control @error('neighborhood') is-invalid @enderror"
                        value="{{ old('neighborhood', $event->neighborhood) }}"
                    />
                    @error('neighborhood')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="street" class="form-label">Rua:</label>
                    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" />
                    @error('street')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Número:</label>
                    <input
                        type="text"
                        name="number"
                        id="number"
                        class="form-control @error('number') is-invalid @enderror"
                        value="{{ old('number', $event->number) }}"
                    />
                    @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="complement" class="form-label">Complemento:</label>
                    <input
                        type="text"
                        name="complement"
                        id="complement"
                        class="form-control @error('complement') is-invalid @enderror"
                        value="{{ old('complement', $event->complement) }}"
                    />
                    @error('complement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Data:</label>
                    <input
                        type="datetime-local"
                        name="date"
                        id="date"
                        class="form-control @error('date') is-invalid @enderror"
                        value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}"
                    />
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card-footer d-flex justify-content-end gap-2 px-0 border-0">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function() {
        // Máscara para o campo de CEP
        $('#zipcode').mask('00000-000');

        // Evento ao sair do campo de CEP
        $('#zipcode').on('blur', function() {
            const cep = $(this).val().replace(/\D/g, '');

            if (cep.length !== 8) {
                alert('CEP inválido.');
                return;
            }

            // Chamada da API ViaCEP
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!("erro" in data)) {
                    $('#state').val(data.uf);
                    $('#city').val(data.localidade);
                    $('#neighborhood').val(data.bairro);
                    $('#street').val(data.logradouro);
                    $('#complement').val(data.complemento);
                } else {
                    alert('CEP não encontrado.');
                }
            }).fail(function() {
                alert('Erro ao buscar CEP. Tente novamente.');
            });
        });
    });
</script>
@endsection
