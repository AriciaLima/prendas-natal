@extends('layouts.app')

@section('title', 'Lista de Pessoas')

@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-4xl font-bold dark:text-dracula-fg">👥 Lista de Pessoas</h2>
            <p class="text-gray-600 dark:text-dracula-comment mt-2">Gerencie os membros para os presentes</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary flex items-center justify-center gap-2">
                <span>➕</span>
                <span>Adicionar Pessoa</span>
            </a>
            <a href="{{ route('gifts.index') }}" class="btn btn-secondary flex items-center justify-center gap-2">
                <span>🎄</span>
                <span>Ver Prendas</span>
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid md:grid-cols-2 gap-4 mb-8">
        <div class="card">
            <div class="text-sm dark:text-dracula-comment">Total de Pessoas</div>
            <div class="text-3xl font-bold dark:text-dracula-purple">{{ $users->count() }}</div>
        </div>
        <div class="card">
            <div class="text-sm dark:text-dracula-comment">Total de Prendas</div>
            <div class="text-3xl font-bold dark:text-dracula-green">{{ $users->sum('gifts_count') }}</div>
        </div>
    </div>

    <!-- Table -->
    <div class="card overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="text-left">🧑 Nome</th>
                    <th class="text-center">🎁 Prendas</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="font-semibold">{{ $user->name }}</td>
                        <td class="text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-dracula-purple/20 dark:bg-dracula-purple/30 text-dracula-purple">
                                {{ $user->gifts_count }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza? Isto irá apagar também todas as prendas desta pessoa!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded hover:bg-red-100 dark:hover:bg-dracula-red/20 text-dracula-red">
                                    🗑️ Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-500 dark:text-dracula-comment">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">👻</span>
                                <span>Nenhuma pessoa registada. <a href="{{ route('users.create') }}" class="text-dracula-purple hover:text-dracula-pink">Adicionar agora!</a></span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Quick Add -->
    <div class="mt-8 p-6 bg-linear-to-r from-[#bd93f9]/10 to-[#ff79c6]/10 rounded-lg border border-[#bd93f9]/20">
        <style>
            body.dark > div:last-child {
                background: linear-gradient(to right, rgba(189, 147, 249, 0.05), rgba(255, 121, 198, 0.05));
                border-color: rgba(189, 147, 249, 0.3);
            }
        </style>
        <h3 class="font-bold mb-4">✨ Dica Rápida</h3>
        <p class="text-sm text-gray-600">
            <style>
                body.dark p.text-gray-600 {
                    color: #6272a4;
                }
            </style>
            Adicione todas as pessoas que farão parte da sua festa de Natal. Depois, poderá criar prendas para cada uma delas!
        </p>
    </div>
</div>

@endsection
