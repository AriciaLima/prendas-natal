@extends('layouts.app')

@section('title', 'Criar Prenda')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-4xl font-bold dark:text-dracula-fg">🎁 Criar Nova Prenda</h2>
        <p class="text-gray-600 dark:text-dracula-comment mt-2">Adicione um novo presente à sua lista de Natal</p>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('gifts.store') }}" class="space-y-6">
            @csrf

            <!-- Nome da Prenda -->
            <div class="form-group">
                <label class="form-label">
                    <span class="text-dracula-purple">*</span> Nome da Prenda
                </label>
                <input 
                    type="text" 
                    name="name" 
                    class="input @error('name') border-dracula-red @enderror"
                    placeholder="ex: Jogo de Tabuleiro"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Valor Previsto -->
            <div class="form-group">
                <label class="form-label">
                    <span class="text-dracula-purple">*</span> Valor Previsto (€)
                </label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="expected_value" 
                    class="input @error('expected_value') border-dracula-red @enderror"
                    placeholder="50.00"
                    value="{{ old('expected_value') }}"
                    required
                >
                @error('expected_value')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Valor Gasto -->
            <div class="form-group">
                <label class="form-label">Valor Gasto (€)</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="spent_value" 
                    class="input @error('spent_value') border-dracula-red @enderror"
                    placeholder="Deixar em branco se ainda não foi gasto"
                    value="{{ old('spent_value') }}"
                >
                @error('spent_value')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pessoa -->
            <div class="form-group">
                <label class="form-label">
                    <span class="text-dracula-purple">*</span> Para Quem é o Presente
                </label>
                <select 
                    name="user_id" 
                    class="input @error('user_id') border-dracula-red @enderror"
                    required
                >
                    <option value="">-- Selecionar uma Pessoa --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descrição (opcional) -->
            <div class="form-group">
                <label class="form-label">Descrição</label>
                <textarea 
                    name="description" 
                    rows="4"
                    class="input @error('description') border-dracula-red @enderror"
                    placeholder="Adicione detalhes sobre o presente..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-dracula-red text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="btn btn-primary flex-1"
                >
                    ✅ Guardar Prenda
                </button>
                <a 
                    href="{{ route('gifts.index') }}" 
                    class="btn btn-outline flex-1 text-center"
                >
                    ❌ Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Tips -->
    <div class="mt-8 p-4 bg-dracula-yellow/10 dark:bg-dracula-yellow/5 border-l-4 border-dracula-yellow rounded">
        <p class="text-sm dark:text-dracula-comment">
            <strong>💡 Dica:</strong> Preencha o valor gasto para acompanhar o orçamento do presente. Deixe em branco se ainda não decidiu quanto gastar.
        </p>
    </div>
</div>

@endsection
