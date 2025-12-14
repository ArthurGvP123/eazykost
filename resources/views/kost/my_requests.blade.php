<x-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">
        
        <div class="mb-8 border-b border-gray-100 pb-4">
            <h1 class="text-3xl font-extrabold text-gray-900">Riwayat Pengajuan Sewa</h1>
            <p class="text-gray-500 mt-2">Daftar kost yang telah Anda hubungi atau ajukan sewa.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($requests as $req)
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition duration-300 overflow-hidden flex flex-col h-full relative">
                    
                    <a href="{{ route('kost.show', $req->kost->slug) }}?from=my-requests" class="absolute inset-0 z-10"></a>

                    <div class="h-48 bg-gray-100 relative overflow-hidden">
                        @if($req->kost->images->count() > 0)
                            <img src="{{ asset('storage/' . $req->kost->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                            </div>
                        @endif
                        
                        <div class="absolute top-3 right-3 z-20">
                            @if($req->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-yellow-200">
                                    Menunggu Respon
                                </span>
                            @elseif($req->status === 'contacted')
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-blue-200">
                                    Sudah Dihubungi
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ ucfirst($req->status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary transition line-clamp-1 mb-1">
                            {{ $req->kost->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            {{ $req->kost->location }}
                        </p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                            <span class="text-xs text-gray-400">Diajukan: {{ $req->created_at->diffForHumans() }}</span>
                            <span class="text-primary font-bold text-sm">Lihat Detail &rarr;</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    <p class="text-gray-500 text-lg font-medium">Belum ada pengajuan sewa.</p>
                    <a href="/" class="text-primary font-bold hover:underline mt-2 inline-block">Cari kost sekarang</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>