@extends('layouts.app')

@section('title', 'Lista de Prendas')

@section('content')

    <h2>Lista de Prendas 🎄</h2>

    <a href="{{ route('gifts.create') }}">➕ Criar Prenda</a>
    <a href="{{ route('users.index') }}" style="margin-left: 10px;">👥 Ver Pessoas</a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Prenda</th>
                <th>Pessoa</th>
                <th>Valor Previsto (€)</th>
                <th>Valor Gasto (€)</th>
                <th>Diferença (€)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gifts as $gift)
                <tr>
                    <td>{{ $gift->name }}</td>
                    <td>{{ $gift->user->name ?? 'Sem utilizador' }}</td>
                    <td>{{ $gift->expected_value }}</td>
                    <td>{{ $gift->spent_value ?? '-' }}</td>
                    <td>
                        {{ $gift->expected_value - ($gift->spent_value ?? 0) }}
                    </td>
                    <td>
                        <a href="{{ route('gifts.show', $gift) }}">Ver</a>

                        <form action="{{ route('gifts.destroy', $gift) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="delete">Apagar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma prenda registada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
