@extends('layouts.app')

@section('title', 'Lista de Prendas')

@section('content')

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-4xl font-bold dark:text-dracula-fg">🎄 Lista de Prendas</h2>
            <p class="text-gray-600 dark:text-dracula-comment mt-2">Gerencie os presentes de Natal</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('gifts.create') }}" class="btn btn-primary flex items-center justify-center gap-2">
                <span>➕</span>
                <span>Criar Prenda</span>
            </a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary flex items-center justify-center gap-2">
                <span>👥</span>
                <span>Ver Pessoas</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-4 mb-8">
        <div class="card">
            <div class="text-sm dark:text-dracula-comment">Total de Prendas</div>
            <div class="text-3xl font-bold dark:text-dracula-green">{{ $gifts->count() }}</div>
        </div>
        <div class="card">
            <div class="text-sm dark:text-dracula-comment">Valor Total Previsto</div>
            <div class="text-3xl font-bold dark:text-dracula-purple">€{{ number_format($gifts->sum('expected_value'), 2) }}</div>
        </div>
        <div class="card">
            <div class="text-sm dark:text-dracula-comment">Valor Total Gasto</div>
            <div class="text-3xl font-bold dark:text-dracula-pink">€{{ number_format($gifts->sum('spent_value') ?? 0, 2) }}</div>
        </div>
    </div>

    <!-- Table -->
    <div class="card overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="text-left">🎁 Prenda</th>
                    <th class="text-left">👤 Pessoa</th>
                    <th class="text-right">Previsto</th>
                    <th class="text-right">Gasto</th>
                    <th class="text-right">Diferença</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gifts as $gift)
                    <tr>
                        <td class="font-semibold">{{ $gift->name }}</td>
                        <td>{{ $gift->user->name ?? '❓ Sem utilizador' }}</td>
                        <td class="text-right">€{{ number_format($gift->expected_value, 2) }}</td>
                        <td class="text-right">
                            @if($gift->spent_value)
                                <span class="text-dracula-pink">€{{ number_format($gift->spent_value, 2) }}</span>
                            @else
                                <span class="text-gray-400 dark:text-dracula-comment">-</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @php
                                $diff = $gift->expected_value - ($gift->spent_value ?? 0);
                                $color = $diff > 0 ? 'text-dracula-green' : 'text-dracula-red';
                            @endphp
                            <span class="{{ $color }}">
                                €{{ number_format($diff, 2) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('gifts.show', $gift) }}" class="inline-flex items-center gap-1 px-3 py-1 rounded hover:bg-gray-200 dark:hover:bg-dracula-bg text-dracula-purple">
                                    👁️
                                </a>
                                <form action="{{ route('gifts.destroy', $gift) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded hover:bg-red-100 dark:hover:bg-dracula-red/20 text-dracula-red">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500 dark:text-dracula-comment">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">📭</span>
                                <span>Nenhuma prenda registada. <a href="{{ route('gifts.create') }}" class="text-dracula-purple hover:text-dracula-pink">Criar agora!</a></span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    tbody tr {
        animation: fadeIn 0.3s ease-in-out;
    }
</style>

@endsection
