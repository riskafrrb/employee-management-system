<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') · Employee Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .nav-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            border-radius: 0 4px 4px 0;
            background: #B8862B;
        }

        .fade-in {
            animation: fadeIn 0.15s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#F6F5F1] text-[#1C2230]">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-[#1C2230] text-white flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-200">

            <div class="h-20 flex items-center gap-3 px-6 border-b border-white/10">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#B8862B] to-[#8f6a22] flex items-center justify-center font-display font-bold text-sm shadow-lg shadow-black/20">
                    EM
                </div>
                <div>
                    <p class="font-display font-semibold leading-tight tracking-tight">Employee</p>
                    <p class="text-xs text-white/50 leading-tight">Management System</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1">

                <p class="px-4 text-[10px] font-semibold uppercase tracking-widest text-white/30 mb-2">Menu</p>

                <a href="{{ route('dashboard') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-150
                    {{ request()->routeIs('dashboard') ? 'nav-active bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13h4v8H3v-8Zm7-8h4v16h-4V5Zm7 4h4v12h-4V9Z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('employees.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-150
                    {{ request()->routeIs('employees.*') ? 'nav-active bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m5-2.13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-2a4 4 0 1 0-3.87-5M5 10a4 4 0 1 1 3.87-5" />
                    </svg>
                    Employees
                </a>

            </nav>

            <div class="px-6 py-5 border-t border-white/10 text-xs text-white/40 font-mono">
                Riska Febriana R &copy; 2026
            </div>

        </aside>

        <!-- Mobile overlay -->
        <div id="overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden backdrop-blur-sm"></div>

        <!-- Main -->
        <div class="flex-1 lg:pl-64">

            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-[#E4E1DA] flex items-center justify-between px-6 sticky top-0 z-20">

                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h1 class="font-display font-semibold text-lg tracking-tight">
                    @yield('title', 'Dashboard')
                </h1>

                <div class="relative">
                    <button onclick="toggleUserMenu()" id="userMenuBtn"
                        class="flex items-center gap-2 pl-1 pr-2 py-1 rounded-full hover:bg-[#F6F5F1] transition">
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-[#125D52] to-[#0d423a] text-white flex items-center justify-center text-sm font-medium shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg id="userMenuChevron" class="w-4 h-4 text-[#6B7280] transition-transform duration-150"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <div id="userMenu"
                        class="hidden fade-in absolute right-0 mt-3 w-52 bg-white border border-[#E4E1DA] rounded-xl shadow-xl shadow-black/5 py-2 z-30">
                        <div class="px-4 py-3 border-b border-[#E4E1DA]">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-[#6B7280] truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 text-left px-4 py-2.5 text-sm text-[#B4423F] hover:bg-[#B4423F]/5 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-6 lg:p-8 max-w-7xl mx-auto">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
        }

        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
            document.getElementById('userMenuChevron').classList.toggle('rotate-180');
        }

        document.addEventListener('click', function(e) {
            const menu = document.getElementById('userMenu');
            const btn = document.getElementById('userMenuBtn');
            if (!menu.contains(e.target) && !btn.contains(e.target) && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                document.getElementById('userMenuChevron').classList.remove('rotate-180');
            }
        });
    </script>

</body>

</html>
