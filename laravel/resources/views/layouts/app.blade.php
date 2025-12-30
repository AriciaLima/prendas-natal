<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prendas de Natal')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="app-body">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <style>
            body.dark nav {
                background-color: #44475a;
            }
        </style>
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🎄</span>
                <a href="/" class="text-2xl font-bold" style="background: linear-gradient(to right, #bd93f9, #ff79c6, #8be9fd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Prendas de Natal
                </a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="/gifts" class="nav-link">Presentes</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link" style="color: #ff5555;">
                            Sair
                        </button>
                    </form>
                    <span class="text-sm" style="color: #6272a4;">{{ Auth::user()->name ?? 'Usuário' }}</span>
                @else
                    <a href="/login" class="nav-link">Login</a>
                    <a href="/register" class="nav-link">Registar</a>
                @endauth
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200" title="Alternar tema">
                    <svg class="w-6 h-6 inline-block transition-opacity duration-300" id="lightIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <svg class="w-6 h-6 hidden transition-opacity duration-300" id="darkIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color: #f1fa8c;">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success mb-6" role="alert">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Error Alerts -->
        @if ($errors->any())
            <div class="alert alert-error mb-6" role="alert">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    Ocorreram erros ao processar o formulário:
                </div>
                <ul class="ml-8">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <style>
            body.dark footer {
                background-color: #44475a;
                border-color: #282a36;
            }
        </style>
        <div class="container mx-auto px-4 py-8 text-center text-sm" style="color: #6272a4;">
            <p>© 2025 Prendas de Natal. Feito com ❤️ para o Natal</p>
        </div>
    </footer>

    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const appBody = document.getElementById('app-body');
        const lightIcon = document.getElementById('lightIcon');
        const darkIcon = document.getElementById('darkIcon');

        // Check if dark mode preference is saved
        function updateDarkMode() {
            if (localStorage.getItem('darkMode') === 'true' || 
                (localStorage.getItem('darkMode') === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                appBody.classList.add('dark');
                lightIcon.classList.add('hidden');
                darkIcon.classList.remove('hidden');
            } else {
                appBody.classList.remove('dark');
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            }
        }

        updateDarkMode();

        darkModeToggle.addEventListener('click', () => {
            appBody.classList.toggle('dark');
            localStorage.setItem('darkMode', appBody.classList.contains('dark'));
            updateDarkMode();
        });
    </script>

</body>

</html>
