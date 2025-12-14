<x-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Pemilik</h1>
                <p class="text-gray-500 mt-2">Kelola properti dan pantau calon penghuni Anda.</p>
            </div>
            <a href="{{ route('owner.create') }}" class="flex items-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary transition shadow-lg shadow-gray-900/20 transform hover:-translate-y-0.5 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kost
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-orange-50 text-primary rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase">Total Properti</p>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $myKosts->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase">Peminat Baru</p>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $incomingRequests->count() }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Properti Saya</h2>
                </div>

                @forelse($myKosts as $kost)
                    <div class="bg-white border border-gray-200 rounded-2xl p-4 hover:shadow-lg transition duration-300 flex flex-col sm:flex-row gap-5 items-start sm:items-center group">
                        <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden relative">
                            @if($kost->images->count() > 0)
                                <img src="{{ asset('storage/' . $kost->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary transition">{{ $kost->name }}</h3>
                                @if($kost->is_available)
                                    <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide">Tersedia</span>
                                @else
                                    <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide">Penuh</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-1 mb-2">{{ $kost->location }}</p>
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                @if($kost->price_monthly)
                                    <span>Rp {{ number_format($kost->price_monthly) }} <span class="text-gray-400 font-normal">/bln</span></span>
                                @elseif($kost->price_daily)
                                    <span>Rp {{ number_format($kost->price_daily) }} <span class="text-gray-400 font-normal">/hari</span></span>
                                @else
                                    <span class="text-gray-400 italic">Harga belum diatur</span>
                                @endif
                            </div>
                        </div>

                        <div class="w-full sm:w-auto mt-2 sm:mt-0">
                            <a href="{{ route('owner.manage', $kost->id) }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 hover:text-primary hover:border-primary transition shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg>
                                Kelola
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-500 font-medium">Belum ada properti yang ditambahkan.</p>
                        <p class="text-sm text-gray-400 mt-1">Mulai bisnis kost Anda sekarang.</p>
                    </div>
                @endforelse
            </div>

            <div class="lg:col-span-1" x-data="{ showArchive: false }">
                
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm sticky top-24">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                        <h2 class="text-lg font-bold text-gray-900">Permintaan Masuk</h2>
                        <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $incomingRequests->count() }}</span>
                    </div>

                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($incomingRequests as $req)
                            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-md transition duration-300">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-700 truncate max-w-[120px]">
                                        {{ $req->kost->name }}
                                    </span>
                                    <span class="text-[10px] text-gray-400">{{ $req->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center font-bold text-gray-600 shadow-sm">
                                        {{ substr($req->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $req->user->name }}</p>
                                        <p class="text-xs text-gray-500">Tertarik menyewa</p>
                                    </div>
                                </div>

                                <form action="{{ route('owner.request.contact', $req->id) }}" method="POST" target="_blank">
                                    @csrf
                                    <button type="submit" class="w-full text-center py-2 bg-green-50 text-green-700 text-xs font-bold rounded-lg hover:bg-green-500 hover:text-white transition flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                                        Hubungi via WhatsApp
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-sm text-gray-400">Tidak ada permintaan baru.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <button @click="showArchive = !showArchive" class="w-full flex items-center justify-between text-sm font-bold text-gray-500 hover:text-gray-800 transition">
                            <span>🗄️ Arsip Peminat ({{ $archivedRequests->count() }})</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transition-transform duration-200" :class="showArchive ? 'rotate-180' : ''"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>

                        <div x-show="showArchive" x-collapse class="mt-4 space-y-3">
                            @forelse($archivedRequests as $req)
                                <div class="p-3 rounded-lg border border-gray-100 bg-white opacity-75 hover:opacity-100 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-bold text-xs text-gray-800">{{ $req->user->name }}</p>
                                            <p class="text-[10px] text-gray-500">Minat: {{ $req->kost->name }}</p>
                                        </div>
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $req->user->phone) }}" target="_blank" class="text-green-600 hover:text-green-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/></svg>
                                        </a>
                                    </div>
                                    <div class="mt-1 text-[10px] text-gray-400">Dihubungi: {{ $req->updated_at->format('d M H:i') }}</div>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400 text-center py-2">Belum ada arsip.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layout>