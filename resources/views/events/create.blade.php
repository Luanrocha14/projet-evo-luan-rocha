@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Criar Evento</h1>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{ old('city') }}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0" {{ old('private') == 0 ? 'selected' : '' }}>Não</option>
                <option value="1" {{ old('private') == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Adicione itens de infraestrutura:</label><br>
            <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras<br>
            <input type="checkbox" name="items[]" value="Palco"> Palco<br>
            <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis<br>
            <input type="checkbox" name="items[]" value="Open Food"> Open Food<br>
            <input type="checkbox" name="items[]" value="Brindes"> Brindes<br>
        </div>

        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection
