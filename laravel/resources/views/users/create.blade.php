@extends('layouts.app')

@section('title', 'Adicionar Pessoa')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-4xl font-bold dark:text-dracula-fg">👤 Adicionar Nova Pessoa</h2>
        <p class="text-gray-600 dark:text-dracula-comment mt-2">Crie um novo membro para a festa de Natal</p>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <!-- Nome -->
            <div class="form-group">
                <label class="form-label">
                    <span class="text-dracula-purple">*</span> Nome da Pessoa
                </label>
                <input 
                    type="text" 
                    name="name" 
                    class="input @error('name') border-dracula-red @enderror"
                    placeholder="ex: João Silva"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @error('name')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email (opcional) -->
            <div class="form-group">
                <label class="form-label">Email (Opcional)</label>
                <input 
                    type="email" 
                    name="email" 
                    class="input @error('email') border-dracula-red @enderror"
                    placeholder="ex: joao@example.com"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="btn btn-primary flex-1"
                >
                    ✅ Adicionar Pessoa
                </button>
                <a 
                    href="{{ route('users.index') }}" 
                    class="btn btn-outline flex-1 text-center"
                >
                    ❌ Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="mt-8 p-4 bg-dracula-cyan/10 dark:bg-dracula-cyan/5 border-l-4 border-dracula-cyan rounded">
        <p class="text-sm dark:text-dracula-comment">
            <strong>ℹ️ Informação:</strong> Adicione as pessoas com quem irá trocar presentes. Depois poderá criar prendas para cada uma!
        </p>
    </div>
</div>

@endsection
