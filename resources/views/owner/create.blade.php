<x-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Properti Kost</h1>
                <p class="text-gray-500 mt-1 text-sm">Lengkapi data di bawah ini untuk mulai menyewakan properti Anda.</p>
            </div>
            
            <button onclick="history.back()" class="group flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:border-gray-400 hover:bg-gray-50 transition shadow-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span class="text-sm">Kembali</span>
            </button>
        </div>

        <form id="uploadForm" action="{{ route('owner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-8">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-bold">1</span>
                            Foto Properti
                        </h2>
                    </div>

                    <div class="relative group cursor-pointer">
                        <div class="border-2 border-dashed border-gray-400 rounded-xl p-10 text-center hover:bg-gray-50 hover:border-gray-600 transition duration-300" onclick="document.getElementById('hiddenInput').click()">
                            <input type="file" id="hiddenInput" name="images[]" multiple accept="image/*" class="hidden" onchange="handleFiles(this.files)">
                            <div class="space-y-3 pointer-events-none">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-gray-500 group-hover:text-gray-900 group-hover:bg-white transition shadow-sm border border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-bold text-lg">Klik untuk upload foto</p>
                                    <p class="text-sm text-gray-500">Maksimal 10 foto. Format JPG/PNG.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @error('images') <p class="text-red-600 text-sm mt-2 font-bold">{{ $message }}</p> @enderror
                    <div id="imagePreviewContainer" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4 mt-6"></div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-bold">2</span>
                            Informasi Dasar
                        </h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Nama Kost</label>
                            <input type="text" name="name" required class="w-full border border-gray-400 rounded-lg shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-3 px-4 transition font-medium text-gray-900 placeholder-gray-400" placeholder="Contoh: Kost Executive Kebon Jeruk" value="{{ old('name') }}">
                        </div>

                        <div x-data="{ 
                            prices: {
                                daily: {{ old('price_daily') ? 'true' : 'false' }}, 
                                monthly: {{ old('price_monthly') ? 'true' : 'true' }}, 
                                yearly: {{ old('price_yearly') ? 'true' : 'false' }}
                            } 
                        }">
                            <label class="block text-sm font-bold text-gray-800 mb-3">Opsi Harga Sewa</label>
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-300 space-y-4">
                                
                                <div class="flex items-start gap-4">
                                    <div class="pt-3">
                                        <input type="checkbox" id="check_daily" x-model="prices.daily" class="w-5 h-5 rounded border-gray-400 text-gray-900 focus:ring-gray-900 cursor-pointer">
                                    </div>
                                    <div class="flex-grow">
                                        <label for="check_daily" class="font-bold text-gray-700 cursor-pointer select-none">Harian / Satuan</label>
                                        <div x-show="prices.daily" x-transition class="mt-2 relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                            <input type="number" name="price_daily" :required="prices.daily" class="w-full pl-12 border border-gray-400 rounded-lg focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-2.5 transition" placeholder="Contoh: 150000" value="{{ old('price_daily') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="pt-3">
                                        <input type="checkbox" id="check_monthly" x-model="prices.monthly" class="w-5 h-5 rounded border-gray-400 text-gray-900 focus:ring-gray-900 cursor-pointer">
                                    </div>
                                    <div class="flex-grow">
                                        <label for="check_monthly" class="font-bold text-gray-700 cursor-pointer select-none">Bulanan</label>
                                        <div x-show="prices.monthly" x-transition class="mt-2 relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                            <input type="number" name="price_monthly" :required="prices.monthly" class="w-full pl-12 border border-gray-400 rounded-lg focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-2.5 transition" placeholder="Contoh: 1500000" value="{{ old('price_monthly') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="pt-3">
                                        <input type="checkbox" id="check_yearly" x-model="prices.yearly" class="w-5 h-5 rounded border-gray-400 text-gray-900 focus:ring-gray-900 cursor-pointer">
                                    </div>
                                    <div class="flex-grow">
                                        <label for="check_yearly" class="font-bold text-gray-700 cursor-pointer select-none">Tahunan</label>
                                        <div x-show="prices.yearly" x-transition class="mt-2 relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">Rp</span>
                                            <input type="number" name="price_yearly" :required="prices.yearly" class="w-full pl-12 border border-gray-400 rounded-lg focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-2.5 transition" placeholder="Contoh: 15000000" value="{{ old('price_yearly') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                @if($errors->has('price_monthly') || $errors->has('price_daily') || $errors->has('price_yearly'))
                                    <div class="p-3 bg-red-50 text-red-600 text-sm font-bold rounded border border-red-200">
                                        Harap isi minimal satu jenis harga.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Total Kamar</label>
                            <input type="number" name="room_total" required min="1" class="w-full border border-gray-400 rounded-lg shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-3 px-4 transition font-medium" placeholder="Contoh: 10" value="{{ old('room_total') }}">
                            @error('room_total') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Deskripsi & Fasilitas</label>
                            <textarea name="description" rows="5" required class="w-full border border-gray-400 rounded-lg shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-3 px-4 transition resize-none placeholder-gray-400" placeholder="Ceritakan fasilitas menarik (AC, WiFi, dll) dan keunggulan kost Anda...">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-bold">3</span>
                            Detail Lokasi
                        </h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Area / Kota</label>
                            <input type="text" name="location" required class="w-full border border-gray-400 rounded-lg shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-3 px-4 transition font-medium" placeholder="Contoh: Jakarta Selatan, Bandung" value="{{ old('location') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Alamat Lengkap</label>
                            <textarea name="address" rows="3" required class="w-full border border-gray-400 rounded-lg shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 py-3 px-4 transition font-medium" placeholder="Jl. Nama Jalan No. XX, RT/RW, Kelurahan, Kecamatan">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 pb-12">
                    <button type="button" onclick="history.back()" class="px-6 py-3 bg-white text-gray-700 font-bold rounded-xl border border-gray-300 hover:bg-gray-100 hover:text-gray-900 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition shadow-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Simpan Properti
                    </button>
                </div>

            </div>
        </form>
    </div>

    <script>
        let uploadedFiles = [];

        function handleFiles(files) {
            const newFiles = Array.from(files);
            if (uploadedFiles.length + newFiles.length > 10) {
                alert("Maksimal hanya boleh 10 foto!");
                return;
            }
            uploadedFiles = uploadedFiles.concat(newFiles);
            renderPreviews();
        }

        function renderPreviews() {
            const container = document.getElementById("imagePreviewContainer");
            container.innerHTML = ""; 

            uploadedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement("div");
                    div.className = "relative group rounded-xl overflow-hidden shadow-sm border border-gray-300 aspect-square";

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "w-full h-full object-cover transform group-hover:scale-110 transition duration-300";

                    const removeBtn = document.createElement("button");
                    removeBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>`;
                    removeBtn.className = "absolute top-2 right-2 bg-white text-red-600 rounded-full w-7 h-7 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm opacity-0 group-hover:opacity-100 border border-gray-200";
                    removeBtn.type = "button"; 
                    removeBtn.onclick = function() { removeImage(index); };

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        function removeImage(index) {
            uploadedFiles.splice(index, 1);
            renderPreviews();
        }

        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const dataTransfer = new DataTransfer();
            uploadedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            document.getElementById('hiddenInput').files = dataTransfer.files;
        });
    </script>
</x-layout>