@extends('layouts.app')

@section('title', 'Lista de Pessoas')

@section('content')

    <h2>Lista de Pessoas 👥</h2>

    <a href="{{ route('users.create') }}">➕ Criar Pessoa</a>
    <a href="{{ route('gifts.index') }}" style="margin-left: 10px;">🎄 Voltar às Prendas</a>

    <br><br>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Nº de Prendas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->gifts_count }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="delete"
                                onclick="return confirm('Tem certeza? Isto irá apagar também todas as prendas desta pessoa!')">Apagar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhuma pessoa registada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
