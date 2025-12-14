<x-layout>
    <div class="max-w-7xl mx-auto px-6 pt-6 pb-4">
        @if(request('from') == 'my-requests')
            <a href="{{ route('my.requests') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-600 hover:text-primary transition group">
                <div class="p-1 rounded-full bg-white border border-gray-200 group-hover:border-primary transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                </div>
                Kembali ke Riwayat Pengajuan
            </a>
        @else
            <nav class="flex text-sm text-gray-500 gap-2">
                <a href="/" class="hover:text-primary transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold truncate">{{ $kost->name }}</span>
            </nav>
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20">
        
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">{{ $kost->name }}</h1>
            <p class="text-gray-500 flex items-center gap-1 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                {{ $kost->address }} &bull; {{ $kost->location }}
            </p>

            <div class="relative w-full h-[300px] md:h-[550px] bg-gray-200 rounded-2xl overflow-hidden shadow-sm group" 
                 x-data="{ 
                     activeSlide: 0, 
                     total: {{ $kost->images->count() }},
                     next() { this.activeSlide = (this.activeSlide === this.total - 1) ? 0 : this.activeSlide + 1 },
                     prev() { this.activeSlide = (this.activeSlide === 0) ? this.total - 1 : this.activeSlide - 1 }
                 }">
                
                @if($kost->images->count() > 0)
                    @foreach($kost->images as $index => $img)
                        <div x-show="activeSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute inset-0 w-full h-full">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach

                    @if($kost->images->count() > 1)
                        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 backdrop-blur-md text-white hover:bg-white hover:text-gray-900 p-3 rounded-full transition shadow-lg opacity-0 group-hover:opacity-100 focus:opacity-100 z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                        </button>
                        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 backdrop-blur-md text-white hover:bg-white hover:text-gray-900 p-3 rounded-full transition shadow-lg opacity-0 group-hover:opacity-100 focus:opacity-100 z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                            @foreach($kost->images as $index => $img)
                                <button @click="activeSlide = {{ $index }}" 
                                        class="w-2.5 h-2.5 rounded-full transition-all duration-300 shadow-sm border border-white/20"
                                        :class="activeSlide === {{ $index }} ? 'bg-white w-8' : 'bg-white/50 hover:bg-white'">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-gray-400 flex-col">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 mb-3"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        <span class="text-lg">Belum ada foto tersedia</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-primary text-white flex items-center justify-center font-bold text-2xl shadow-sm">
                            {{ substr($kost->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg">Kost dikelola oleh {{ explode(' ', $kost->user->name)[0] }}</p>
                            <p class="text-sm text-gray-500">Terdaftar sejak {{ $kost->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div>
                        @if($kost->is_available)
                            <span class="bg-green-100 text-green-700 font-bold px-4 py-2 rounded-full text-sm flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></span> Tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 font-bold px-4 py-2 rounded-full text-sm">Penuh</span>
                        @endif
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Tentang tempat ini</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line text-justify">
                        {{ $kost->description }}
                    </div>
                </div>

                <div class="mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Properti</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="p-3 bg-white rounded-full shadow-sm text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Kamar</span>
                                <span class="font-bold text-gray-900 text-lg">{{ $kost->room_total }} Unit</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="p-3 bg-white rounded-full shadow-sm text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Lokasi</span>
                                <span class="font-bold text-gray-900 text-lg">{{ $kost->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white border border-gray-200 rounded-2xl p-6 shadow-xl shadow-gray-200/50">
                    <div class="mb-6">
                        <span class="text-gray-500 text-sm font-medium">Mulai dari</span>
                        <div class="flex items-baseline gap-1">
                            @if($kost->price_monthly)
                                <span class="text-3xl font-extrabold text-primary">Rp {{ number_format($kost->price_monthly, 0, ',', '.') }}</span>
                                <span class="text-gray-500 font-medium">/ bulan</span>
                            @elseif($kost->price_daily)
                                <span class="text-3xl font-extrabold text-primary">Rp {{ number_format($kost->price_daily, 0, ',', '.') }}</span>
                                <span class="text-gray-500 font-medium">/ hari</span>
                            @else
                                <span class="text-xl font-bold text-gray-400">Hubungi Pemilik</span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Opsi Pembayaran</p>
                        @if($kost->price_daily)
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-600 font-medium">Harian</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($kost->price_daily) }}</span>
                            </div>
                        @endif
                        @if($kost->price_monthly)
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-600 font-medium">Bulanan</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($kost->price_monthly) }}</span>
                            </div>
                        @endif
                        @if($kost->price_yearly)
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-600 font-medium">Tahunan</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($kost->price_yearly) }}</span>
                            </div>
                        @endif
                        @if(!$kost->price_daily && !$kost->price_monthly && !$kost->price_yearly)
                            <p class="text-sm text-gray-400 italic">Harga belum tersedia.</p>
                        @endif
                    </div>

                    <div class="space-y-3">
                        @if(Auth::check())
                            @if(Auth::user()->role === 'owner' && Auth::id() === $kost->user_id)
                                <a href="{{ route('owner.manage', $kost->id) }}" class="block w-full bg-gray-900 text-white text-center py-3.5 rounded-xl font-bold hover:bg-primary transition shadow-md">
                                    Kelola Kost Ini
                                </a>
                            @elseif(Auth::user()->role === 'owner')
                                <div class="p-3 bg-yellow-50 text-yellow-800 text-sm rounded-lg text-center border border-yellow-200">
                                    Anda login sebagai <b>Pemilik</b>. Gunakan akun <b>Penghuni</b> untuk menyewa.
                                </div>
                            @else
                                @if($hasApplied)
                                    <button disabled class="block w-full bg-gray-300 text-gray-500 text-center py-3.5 rounded-xl font-bold cursor-not-allowed border border-gray-300">
                                        Pengajuan Terkirim ✓
                                    </button>
                                    <p class="text-xs text-center text-gray-400 mt-1">Anda sudah mengajukan sewa untuk kost ini.</p>
                                @else
                                    <form action="{{ route('kost.rent', $kost->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full bg-primary text-white text-center py-3.5 rounded-xl font-bold hover:bg-orange-600 transition shadow-lg shadow-orange-500/30">
                                            Ajukan Sewa Sekarang
                                        </button>
                                    </form>
                                @endif
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $kost->user->phone) }}?text=Halo, saya tertarik dengan kost {{ $kost->name }} di Eazy Kost." target="_blank" class="block w-full bg-white border border-gray-300 text-gray-700 text-center py-3.5 rounded-xl font-bold hover:bg-green-50 hover:text-green-600 hover:border-green-200 transition flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                                    Chat Pemilik
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gray-900 text-white text-center py-3.5 rounded-xl font-bold hover:bg-gray-800 transition">
                                Masuk untuk Menyewa
                            </a>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="mt-4 p-3 bg-green-50 text-green-700 text-sm rounded-lg text-center border border-green-100">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="mt-4 p-3 bg-blue-50 text-blue-700 text-sm rounded-lg text-center border border-blue-100">
                            {{ session('info') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>