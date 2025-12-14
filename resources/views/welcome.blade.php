<x-layout>
    <div class="relative bg-gradient-to-b from-orange-50 via-white to-gray-50 pt-8 pb-24 px-6 rounded-b-[4rem] shadow-sm border-b border-gray-100 overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-40">
            <div class="absolute top-10 left-10 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-5xl mx-auto text-center relative z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-xs font-bold tracking-wider mb-6 border border-orange-200 uppercase">
                Marketplace Kost No. #1
            </span>
            
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 mb-8 leading-tight tracking-tight">
                Cari Kost Nyaman, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-yellow-500">Hidup Lebih Aman</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan ribuan kost terverifikasi atau kelola properti kost Anda dengan mudah, aman, dan transparan dalam satu platform.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                
                @guest
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-primary text-white font-bold rounded-full shadow-xl shadow-orange-500/30 hover:bg-orange-600 hover:scale-105 transition transform duration-200 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                        Cari Kost Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 font-bold rounded-full hover:bg-gray-50 hover:border-gray-300 transition flex items-center justify-center gap-2">
                        Sewakan Kost
                    </a>

                @else
                    @if(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}" class="px-8 py-4 bg-gray-900 text-white font-bold rounded-full shadow-xl hover:bg-gray-800 hover:scale-105 transition transform duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('owner.create') }}" class="px-8 py-4 bg-white text-primary border border-primary font-bold rounded-full hover:bg-orange-50 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Sewakan Kost
                        </a>

                    @else
                        <a href="#rekomendasi" class="px-8 py-4 bg-primary text-white font-bold rounded-full shadow-xl shadow-orange-500/30 hover:bg-orange-600 hover:scale-105 transition transform duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                            Cari Kost
                        </a>
                    @endif

                @endguest
            </div>
        </div>
    </div>

    <div x-data="{ searchQuery: '' }" id="rekomendasi" class="max-w-7xl mx-auto px-6 mt-16 mb-20">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl font-extrabold text-gray-900">Rekomendasi Kost</h2>
                <p class="text-gray-500 mt-2">Pilihan hunian terbaik yang baru saja ditambahkan.</p>
            </div>

            <div class="w-full md:w-1/3 relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 group-focus-within:text-primary transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    class="w-full py-3 pl-12 pr-4 bg-white border border-gray-200 rounded-full shadow-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition"
                    placeholder="Cari nama kost..."
                >
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($kosts as $kost)
                
                <div x-show="'{{ strtolower($kost->name) }}'.includes(searchQuery.toLowerCase())" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition duration-300 overflow-hidden flex flex-col h-full">
                    
                    <div class="h-60 bg-gray-100 relative group/slider">
                        @if($kost->images->count() > 0)
                            <div class="flex overflow-x-auto snap-x snap-mandatory h-full w-full scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach($kost->images as $img)
                                    <div class="snap-center flex-shrink-0 w-full h-full relative">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/50 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                {{ $kost->images->count() }} Foto
                            </div>
                        @else
                            <div class="flex items-center justify-center h-full text-gray-300 bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                            </div>
                        @endif

                        <div class="absolute top-3 right-3 bg-white/95 backdrop-blur text-xs font-bold px-3 py-1 rounded-full shadow-sm text-gray-700 z-10 border border-gray-100">
                            {{ $kost->is_available ? 'Tersedia' : 'Penuh' }}
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow relative">
                        <div class="flex-grow">
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary transition line-clamp-1">
                                <a href="{{ route('kost.show', $kost->slug) }}" class="before:absolute before:inset-0">{{ $kost->name }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 mt-2 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-orange-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                {{ $kost->location }}
                            </p>
                            <p class="text-sm text-gray-400 mt-3 line-clamp-2">{{ $kost->description }}</p>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-50 flex items-center justify-between">
                            <div>
                                @if($kost->price_monthly)
                                    <p class="text-primary font-bold text-lg">Rp {{ number_format($kost->price_monthly, 0, ',', '.') }} <span class="text-xs text-gray-400 font-normal">/bln</span></p>
                                @elseif($kost->price_daily)
                                    <p class="text-primary font-bold text-lg">Rp {{ number_format($kost->price_daily, 0, ',', '.') }} <span class="text-xs text-gray-400 font-normal">/hari</span></p>
                                @else
                                    <p class="text-gray-400 text-sm italic">Cek Detail</p>
                                @endif
                            </div>
                            <span class="text-gray-400 hover:text-primary transition bg-gray-50 p-2 rounded-full group-hover:bg-primary group-hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    <p class="text-gray-500 text-lg font-medium">Belum ada kost yang tersedia saat ini.</p>
                    <p class="text-gray-400">Coba kembali lagi nanti.</p>
                </div>
            @endforelse
            
            <div x-show="searchQuery !== '' && $el.previousElementSibling.querySelectorAll('div[x-show=\'true\']').length === 0" 
                 class="col-span-1 md:col-span-3 text-center py-10" 
                 x-cloak
                 style="display: none;">
                <p class="text-gray-500">Tidak menemukan kost dengan nama "<span x-text="searchQuery" class="font-bold text-gray-800"></span>".</p>
            </div>

        </div>
    </div>
</x-layout>