@extends('layouts.app')

@section('title', 'Criar Pessoa')

@section('content')

    <h2>Criar Pessoa</h2>

    <form method="POST" action="/users">
        @csrf

        <div class="form-group">
            <label>Nome</label><br>
            <input type="text" name="name" required>
        </div>

        <br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="/">Voltar</a>

@endsection
