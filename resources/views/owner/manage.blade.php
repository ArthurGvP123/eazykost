<x-layout>
    <div x-data="manageKost({{ $kost->images->sortBy('sort_order')->values() }})" x-init="initData()">

        <div class="max-w-6xl mx-auto px-6 py-10">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <nav class="flex text-sm text-gray-500 mb-2 gap-2">
                        <a href="{{ route('owner.dashboard') }}" class="hover:text-primary">Dashboard</a>
                        <span>/</span>
                        <span class="text-gray-800 font-semibold">Detail Kost</span>
                    </nav>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $kost->name }}</h1>
                    <p class="text-gray-500 flex items-center gap-1 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                        {{ $kost->location }}
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <button onclick="history.back()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-sm">
                        Kembali
                    </button>
                    <button @click="showModal = true" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-primary transition font-medium text-sm flex items-center gap-2 shadow-lg shadow-gray-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                        Edit Data
                    </button>
                    <button @click="showDeleteModal = true" class="px-4 py-2 bg-red-100 text-red-600 border border-red-200 rounded-lg hover:bg-red-600 hover:text-white transition font-medium text-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        Hapus Kost
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200 flex items-center gap-2">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="mb-10">
                @if($kost->images->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-80 md:h-96">
                        @php $sortedImages = $kost->images->sortBy('sort_order')->values(); @endphp
                        
                        <div class="col-span-2 md:col-span-2 row-span-2 relative rounded-2xl overflow-hidden group">
                            <img src="{{ asset('storage/' . $sortedImages[0]->image_path) }}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm z-10">Foto Utama</div>
                        </div>
                        
                        @foreach($sortedImages->skip(1)->take(3) as $img)
                            <div class="relative rounded-2xl overflow-hidden group">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                        
                        @if($sortedImages->count() > 4)
                            <div class="relative rounded-2xl overflow-hidden bg-gray-900 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $sortedImages[4]->image_path) }}" class="w-full h-full object-cover opacity-50">
                                <div class="absolute inset-0 flex items-center justify-center text-white font-bold text-xl">+{{ $sortedImages->count() - 4 }} Foto</div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-64 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 border-2 border-dashed border-gray-300"><p>Tidak ada foto tersedia</p></div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Deskripsi & Fasilitas</h2>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $kost->description }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Lokasi Properti</h2>
                        <p class="font-bold text-gray-800">{{ $kost->address }}</p>
                        <p class="text-sm text-gray-500 mt-1">Area: {{ $kost->location }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Kapasitas Kost</h3>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Kamar Kosong</span>
                                <span class="text-sm text-gray-400">Unit Tersedia</span>
                            </div>
                            <span class="text-3xl font-extrabold text-gray-900">{{ $kost->room_total }}</span>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Daftar Harga</h3>
                        <div class="space-y-3">
                            @if($kost->price_daily) <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg"><span class="text-sm text-gray-600">Harian</span><span class="font-bold text-gray-900">Rp {{ number_format($kost->price_daily) }}</span></div> @endif
                            @if($kost->price_monthly) <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg border border-orange-100"><span class="text-sm text-gray-600">Bulanan</span><span class="font-bold text-primary">Rp {{ number_format($kost->price_monthly) }}</span></div> @endif
                            @if($kost->price_yearly) <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg"><span class="text-sm text-gray-600">Tahunan</span><span class="font-bold text-gray-900">Rp {{ number_format($kost->price_yearly) }}</span></div> @endif
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="showModal" style="display: none;" class="relative z-[60]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
                            
                            <form action="{{ route('owner.update', $kost->id) }}" method="POST" enctype="multipart/form-data" @submit="prepareSubmit">
                                @csrf
                                @method('PUT')

                                <template x-for="id in deletedImages">
                                    <input type="hidden" name="delete_images[]" :value="id">
                                </template>
                                
                                <input type="hidden" name="ordered_ids" x-model="orderedIdsString">

                                <input type="hidden" name="check_daily" :value="prices.daily ? 1 : 0">
                                <input type="hidden" name="check_monthly" :value="prices.monthly ? 1 : 0">
                                <input type="hidden" name="check_yearly" :value="prices.yearly ? 1 : 0">

                                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100">
                                    <h3 class="text-xl font-bold leading-6 text-gray-900">Edit Informasi Kost</h3>
                                    <p class="text-sm text-gray-500 mt-1">Atur posisi gambar dengan tombol panah.</p>
                                </div>

                                <div class="px-4 py-5 sm:p-6 max-h-[70vh] overflow-y-auto space-y-6">
                                    
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                        <h4 class="font-bold text-gray-800 mb-3 text-sm flex justify-between">
                                            <span>Foto Terupload</span>
                                            <span class="text-xs font-normal text-gray-500">Foto pertama = Foto Utama</span>
                                        </h4>
                                        
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                            <template x-for="(img, index) in activeImages" :key="img.id">
                                                <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-300 bg-white shadow-sm transition-all duration-300">
                                                    <img :src="'/storage/' + img.image_path" class="w-full h-full object-cover">
                                                    <div class="absolute top-1 left-1 bg-black/60 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold" x-text="index + 1"></div>
                                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                                                        <div class="flex gap-2">
                                                            <button type="button" @click="moveImage(index, -1)" class="p-1 bg-white rounded-full hover:bg-primary hover:text-white transition" :disabled="index === 0" :class="index === 0 ? 'opacity-50 cursor-not-allowed' : ''">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                                                            </button>
                                                            <button type="button" @click="moveImage(index, 1)" class="p-1 bg-white rounded-full hover:bg-primary hover:text-white transition" :disabled="index === activeImages.length - 1" :class="index === activeImages.length - 1 ? 'opacity-50 cursor-not-allowed' : ''">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                                                            </button>
                                                        </div>
                                                        <button type="button" @click="deleteImage(img.id)" class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">Hapus</button>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <label class="block text-sm font-bold text-gray-700 mb-2">
                                            Tambah Foto Baru 
                                            <span class="font-normal text-gray-500 text-xs ml-1">(Sisa slot: <span x-text="remainingSlots"></span>)</span>
                                        </label>
                                        <input type="file" id="newImagesInput" name="new_images[]" multiple accept="image/*" @change="handleFileUpload($event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-primary hover:file:bg-orange-100 cursor-pointer">
                                        <p class="text-xs text-gray-400 mt-1" x-show="uploadMsg" x-text="uploadMsg"></p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="col-span-2">
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kost</label>
                                            <input type="text" name="name" value="{{ $kost->name }}" class="w-full border-gray-300 rounded-lg py-2 px-3 focus:border-primary focus:ring-1 focus:ring-primary" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Area / Kota</label>
                                            <input type="text" name="location" value="{{ $kost->location }}" class="w-full border-gray-300 rounded-lg py-2 px-3 focus:border-primary focus:ring-1 focus:ring-primary" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Total Kamar</label>
                                            <input type="number" name="room_total" value="{{ $kost->room_total }}" class="w-full border-gray-300 rounded-lg py-2 px-3 focus:border-primary focus:ring-1 focus:ring-primary" required>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-100 pt-4">
                                        <label class="block text-sm font-bold text-gray-700 mb-3">Opsi Harga</label>
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-3">
                                                <input type="checkbox" x-model="prices.daily" class="w-4 h-4 text-primary rounded border-gray-300">
                                                <span class="text-sm font-medium w-20">Harian</span>
                                                <input type="number" name="price_daily" :disabled="!prices.daily" value="{{ $kost->price_daily }}" class="flex-grow border-gray-300 rounded-lg py-1.5 px-3 text-sm" placeholder="Rp">
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <input type="checkbox" x-model="prices.monthly" class="w-4 h-4 text-primary rounded border-gray-300">
                                                <span class="text-sm font-medium w-20">Bulanan</span>
                                                <input type="number" name="price_monthly" :disabled="!prices.monthly" value="{{ $kost->price_monthly }}" class="flex-grow border-gray-300 rounded-lg py-1.5 px-3 text-sm" placeholder="Rp">
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <input type="checkbox" x-model="prices.yearly" class="w-4 h-4 text-primary rounded border-gray-300">
                                                <span class="text-sm font-medium w-20">Tahunan</span>
                                                <input type="number" name="price_yearly" :disabled="!prices.yearly" value="{{ $kost->price_yearly }}" class="flex-grow border-gray-300 rounded-lg py-1.5 px-3 text-sm" placeholder="Rp">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label>
                                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg py-2 px-3 focus:border-primary focus:ring-1 focus:ring-primary" required>{{ $kost->description }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Lengkap</label>
                                        <textarea name="address" rows="2" class="w-full border-gray-300 rounded-lg py-2 px-3 focus:border-primary focus:ring-1 focus:ring-primary" required>{{ $kost->address }}</textarea>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100">
                                    <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary sm:ml-3 sm:w-auto transition">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" @click="showModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="showDeleteModal" style="display: none;" class="relative z-[70]">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg p-6">
                            <div class="text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                </div>
                                <h3 class="mt-4 text-lg font-bold text-gray-900">Hapus Kost Ini?</h3>
                                <p class="mt-2 text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan. Semua data kost, laporan, dan gambar akan dihapus permanen.</p>
                            </div>
                            <div class="mt-6 flex gap-3 justify-center">
                                <button type="button" @click="showDeleteModal = false" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50">Batal</button>
                                <form action="{{ route('owner.destroy', $kost->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700">Ya, Hapus Permanen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function manageKost(initialImages) {
            return {
                showModal: false,
                showDeleteModal: false,
                prices: {
                    daily: {{ $kost->price_daily ? 'true' : 'false' }},
                    monthly: {{ $kost->price_monthly ? 'true' : 'false' }},
                    yearly: {{ $kost->price_yearly ? 'true' : 'false' }}
                },
                
                // DATA GAMBAR
                originalImages: initialImages,
                activeImages: initialImages,
                deletedImages: [],
                orderedIdsString: '',
                uploadMsg: '',

                initData() {
                    this.updateOrderedString();
                },

                deleteImage(id) {
                    this.deletedImages.push(id);
                    this.activeImages = this.activeImages.filter(img => img.id !== id);
                    this.updateOrderedString();
                },

                moveImage(index, direction) {
                    const newIndex = index + direction;
                    if (newIndex < 0 || newIndex >= this.activeImages.length) return;
                    const temp = this.activeImages[index];
                    this.activeImages[index] = this.activeImages[newIndex];
                    this.activeImages[newIndex] = temp;
                    this.activeImages = [...this.activeImages];
                    this.updateOrderedString();
                },

                updateOrderedString() {
                    this.orderedIdsString = this.activeImages.map(img => img.id).join(',');
                },

                get remainingSlots() {
                    return 10 - this.activeImages.length;
                },

                handleFileUpload(event) {
                    const files = event.target.files;
                    const max = this.remainingSlots;
                    
                    if (files.length > max) {
                        this.uploadMsg = `Anda memilih ${files.length} file, tapi sisa slot hanya ${max}. ${files.length - max} file akan diabaikan.`;
                        const dataTransfer = new DataTransfer();
                        for (let i = 0; i < max; i++) {
                            dataTransfer.items.add(files[i]);
                        }
                        event.target.files = dataTransfer.files;
                    } else {
                        this.uploadMsg = '';
                    }
                },

                prepareSubmit() {
                    this.updateOrderedString();
                }
            }
        }
    </script>
</x-layout>