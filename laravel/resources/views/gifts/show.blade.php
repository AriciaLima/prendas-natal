@extends('layouts.app')

@section('title', 'Detalhes da Prenda')

@section('content')

<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-4xl font-bold dark:text-dracula-fg">🎁 Detalhes da Prenda</h2>
            <p class="text-gray-600 dark:text-dracula-comment mt-2">Informações completas do presente</p>
        </div>
        <a href="{{ route('gifts.index') }}" class="btn btn-secondary">
            ⬅️ Voltar
        </a>
    </div>

    <!-- Main Card -->
    <div class="card">
        <div class="space-y-6">
            <!-- Gift Name -->
            <div class="pb-6 border-b border-gray-200 dark:border-dracula-bg_light">
                <h1 class="text-3xl font-bold dark:text-dracula-fg mb-2">{{ $gift->name }}</h1>
                <p class="text-gray-600 dark:text-dracula-comment">ID: #{{ $gift->id }}</p>
            </div>

            <!-- Grid of Information -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Person -->
                <div class="bg-gray-50 dark:bg-dracula-bg p-4 rounded-lg">
                    <p class="text-sm dark:text-dracula-comment mb-2">👤 Para Quem</p>
                    <p class="text-2xl font-bold dark:text-dracula-fg">{{ $gift->user->name }}</p>
                </div>

                <!-- Expected Value -->
                <div class="bg-dracula-purple/10 dark:bg-dracula-purple/20 p-4 rounded-lg border border-dracula-purple/30">
                    <p class="text-sm text-dracula-purple dark:text-dracula-purple mb-2">💜 Valor Previsto</p>
                    <p class="text-2xl font-bold text-dracula-purple">€{{ number_format($gift->expected_value, 2) }}</p>
                </div>

                <!-- Spent Value -->
                <div class="bg-dracula-pink/10 dark:bg-dracula-pink/20 p-4 rounded-lg border border-dracula-pink/30">
                    <p class="text-sm text-dracula-pink dark:text-dracula-pink mb-2">💰 Valor Gasto</p>
                    <p class="text-2xl font-bold text-dracula-pink">
                        @if($gift->spent_value)
                            €{{ number_format($gift->spent_value, 2) }}
                        @else
                            <span class="text-gray-400 dark:text-dracula-comment">Ainda não gasto</span>
                        @endif
                    </p>
                </div>

                <!-- Difference -->
                <div class="@php
                    $difference = $gift->expected_value - ($gift->spent_value ?? 0);
                    $bgClass = $difference >= 0 ? 'bg-dracula-green/10 dark:bg-dracula-green/20 border-dracula-green/30' : 'bg-dracula-red/10 dark:bg-dracula-red/20 border-dracula-red/30';
                    $textClass = $difference >= 0 ? 'text-dracula-green' : 'text-dracula-red';
                @endphp p-4 rounded-lg border {{ $bgClass }}">
                    <p class="text-sm {{ $textClass }} dark:{{ $textClass }} mb-2">
                        @if($difference >= 0) 💚 Diferença (Poupado) @else 💔 Diferença (Gastou Mais) @endif
                    </p>
                    <p class="text-2xl font-bold {{ $textClass }}">
                        €{{ number_format(abs($difference), 2) }}
                    </p>
                    @if($difference < 0)
                        <p class="text-xs mt-1 opacity-75">Gastou €{{ number_format(abs($difference), 2) }} a mais do que previsto</p>
                    @endif
                </div>
            </div>

            <!-- Progress Bar -->
            @php
                $percentage = $gift->spent_value ? min(($gift->spent_value / $gift->expected_value) * 100, 100) : 0;
            @endphp
            <div class="pt-4 border-t border-gray-200 dark:border-dracula-bg_light">
                <p class="text-sm dark:text-dracula-comment mb-2">Progresso de Gastos</p>
                <div class="w-full bg-gray-200 dark:bg-dracula-bg rounded-full h-3 overflow-hidden">
                    <div 
                        class="h-full bg-linear-to-r from-[#50fa7b] to-[#bd93f9] transition-all duration-300"
                        style="width: {{ min($percentage, 100) }}%"
                    ></div>
                </div>
                <p class="text-xs dark:text-dracula-comment mt-2">{{ $percentage }}% do orçamento gasto</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a 
            href="{{ route('gifts.index') }}" 
            class="btn btn-secondary flex items-center justify-center gap-2"
        >
            <span>⬅️</span>
            <span>Voltar à Lista</span>
        </a>
        <form action="{{ route('gifts.destroy', $gift) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem certeza que deseja apagar esta prenda? Esta ação não pode ser desfeita!')">
            @csrf
            @method('DELETE')
            <button 
                type="submit" 
                class="w-full btn px-4 py-2 bg-dracula-red text-dracula-fg hover:bg-dracula-red/80 flex items-center justify-center gap-2"
            >
                <span>🗑️</span>
                <span>Apagar Prenda</span>
            </button>
        </form>
    </div>

    <!-- Info Box -->
    <div class="mt-8 p-4 bg-dracula-purple/10 dark:bg-dracula-purple/5 border-l-4 border-dracula-purple rounded">
        <p class="text-sm dark:text-dracula-comment">
            <strong>💡 Dica:</strong> Monitorize o valor gasto para se manter dentro do orçamento planejado.
        </p>
    </div>
</div>

@endsection
