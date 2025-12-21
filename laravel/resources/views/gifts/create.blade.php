@extends('layouts.app')

@section('title', 'Criar Prenda')

@section('content')

    <h2>Criar Prenda</h2>

    <form method="POST" action="{{ route('gifts.store') }}">
        @csrf

        <div class="form-group">
            <label>Nome da prenda</label><br>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Valor Previsto</label><br>
            <input type="number" step="0.01" name="expected_value" required>
        </div>

        <div class="form-group">
            <label>Valor Gasto</label><br>
            <input type="number" step="0.01" name="spent_value">
        </div>

        <div class="form-group">
            <label>Pessoa</label><br>
            <select name="user_id" required>
                <option value="">-- Escolher --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="{{ route('gifts.index') }}">Voltar</a>

@endsection
