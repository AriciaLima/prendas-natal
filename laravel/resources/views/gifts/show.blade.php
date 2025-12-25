@extends('layouts.app')

@section('title', 'Detalhes da Prenda')

@section('content')

    <h2>Detalhes da Prenda 🎁</h2>

    <div class="details">
        <p><strong>Nome da Prenda:</strong> {{ $gift->name }}</p>
        <p><strong>Pessoa:</strong> {{ $gift->user->name }}</p>
        <p><strong>Valor Previsto:</strong> {{ number_format($gift->expected_value, 2, ',', '.') }} €</p>
        <p><strong>Valor Gasto:</strong>
            {{ $gift->spent_value ? number_format($gift->spent_value, 2, ',', '.') . ' €' : 'Ainda não gasto' }}</p>
        <p><strong>Diferença:</strong>
            @php
                $difference = $gift->expected_value - ($gift->spent_value ?? 0);
            @endphp
            <span style="color: {{ $difference >= 0 ? 'green' : 'red' }}">
                {{ number_format($difference, 2, ',', '.') }} €
            </span>
            @if ($difference > 0)
                (Poupou)
            @elseif($difference < 0)
                (Gastou a mais)
            @endif
        </p>
    </div>

    <br>

    <a href="{{ route('gifts.index') }}">Voltar à Lista</a>

    <form action="{{ route('gifts.destroy', $gift) }}" method="POST" style="display:inline; margin-left: 10px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete" onclick="return confirm('Tem certeza que deseja apagar esta prenda?')">Apagar
            Prenda</button>
    </form>

@endsection
