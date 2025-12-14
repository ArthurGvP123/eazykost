<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eazy Kost - Marketplace Kost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { primary: '#f97316', secondary: '#fff7ed' }
                }
            }
        }
    </script>
    <style>html { scroll-behavior: smooth; } [x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased selection:bg-orange-100 selection:text-orange-600 flex flex-col min-h-screen">

    <nav x-data="{ scrolled: false, mobileOpen: false, userOpen: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm py-3' : 'bg-white py-4 shadow-sm'"
         class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group z-50 relative">
                    <div class="p-2 bg-primary rounded-lg text-white group-hover:bg-orange-600 transition shadow-lg shadow-orange-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    </div>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">Eazy<span class="text-primary">Kost</span></span>
                </a>
                
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-primary transition">Beranda</a>
                    @auth
                        <div class="relative">
                            <button @click="userOpen = !userOpen" @click.outside="userOpen = false" class="flex items-center gap-3 pl-3 pr-2 py-1.5 rounded-full border border-gray-100 hover:border-orange-200 hover:bg-orange-50 transition cursor-pointer group">
                                <div class="text-right">
                                    <span class="block text-xs font-bold text-gray-800 group-hover:text-primary transition">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                    <span class="block text-[10px] text-gray-400 uppercase tracking-wider leading-none">{{ Auth::user()->role === 'owner' ? 'Pemilik' : 'Penyewa' }}</span>
                                </div>
                                <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold shadow-md">{{ substr(Auth::user()->name, 0, 1) }}</div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400 group-hover:text-primary transition" :class="userOpen ? 'rotate-180' : ''"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                            </button>

                            <div x-show="userOpen" x-transition class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 overflow-hidden z-50">
                                <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                                    <p class="text-xs text-gray-500">Masuk sebagai</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                @if(Auth::user()->role === 'owner')
                                    <div class="py-1">
                                        <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg> Dashboard
                                        </a>
                                        <a href="{{ route('owner.create') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg> Tambah Kost
                                        </a>
                                    </div>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @else
                                    <div class="py-1">
                                        <a href="{{ route('my.requests') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-primary transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /></svg> Riwayat Pengajuan
                                        </a>
                                    </div>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-primary transition">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-bold bg-gray-900 text-white rounded-full hover:bg-primary transition shadow-lg shadow-orange-500/20">Daftar</a>
                        </div>
                    @endauth
                </div>

                <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition z-50">
                    <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        <div x-show="mobileOpen" x-transition x-cloak class="absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-xl md:hidden flex flex-col p-6 space-y-4 max-h-[80vh] overflow-y-auto z-40">
            <a href="{{ route('home') }}" class="block text-base font-semibold text-gray-800 hover:text-primary">Beranda</a>
            @auth
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <p class="font-bold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-1 text-[10px] font-bold uppercase tracking-wide bg-orange-100 text-orange-700 px-2 py-0.5 rounded">{{ Auth::user()->role === 'owner' ? 'Pemilik Kos' : 'Penyewa' }}</span>
                    </div>
                </div>
                <div class="space-y-3 pl-2 border-l-2 border-gray-100">
                    @if(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}" class="block text-sm font-medium text-gray-600 hover:text-primary">Dashboard Saya</a>
                        <a href="{{ route('owner.create') }}" class="block text-sm font-medium text-gray-600 hover:text-primary">Tambah Kost Baru</a>
                    @else
                        <a href="{{ route('my.requests') }}" class="block text-sm font-medium text-gray-600 hover:text-primary">Riwayat Pengajuan</a>
                    @endif
                </div>
                <div class="pt-4 border-t border-gray-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg> Keluar Aplikasi
                        </button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <a href="{{ route('login') }}" class="py-3 text-center font-bold text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50">Masuk</a>
                    <a href="{{ route('register') }}" class="py-3 text-center font-bold text-white bg-gray-900 rounded-xl hover:bg-primary shadow-lg shadow-orange-500/20">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="flex-grow pt-20">{{ $slot }}</main>
    <footer class="bg-white border-t border-gray-100 pt-8 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-6 text-center"><p class="text-gray-400 text-sm">&copy; 2025 Eazy Kost. Dibuat dengan Laravel.</p></div>
    </footer>
</body>
</html>