<x-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg border border-orange-100">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Buat Akun Baru</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Bergabunglah dengan komunitas Eazy Kost</p>

        <form action="/register" method="POST" class="space-y-5" x-data="{ role: 'user' }">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" placeholder="Nama Lengkap Anda" value="{{ old('name') }}">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" placeholder="nama@email.com" value="{{ old('email') }}">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp</label>
                <input type="text" name="phone" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" placeholder="0812xxxx" value="{{ old('phone') }}">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Saya mendaftar sebagai:</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="role" value="user" class="peer sr-only" x-model="role">
                        <div class="p-4 rounded-xl border-2 text-center transition-all duration-200"
                             :class="role === 'user' ? 'border-primary bg-orange-50 text-primary' : 'border-gray-200 hover:border-orange-200'">
                            <div class="font-bold text-sm">Pencari Kos</div>
                        </div>
                        <div x-show="role === 'user'" class="absolute top-2 right-2 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                        </div>
                    </label>

                    <label class="cursor-pointer relative">
                        <input type="radio" name="role" value="owner" class="peer sr-only" x-model="role">
                        <div class="p-4 rounded-xl border-2 text-center transition-all duration-200"
                             :class="role === 'owner' ? 'border-primary bg-orange-50 text-primary' : 'border-gray-200 hover:border-orange-200'">
                            <div class="font-bold text-sm">Pemilik Kos</div>
                        </div>
                        <div x-show="role === 'owner'" class="absolute top-2 right-2 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ulangi Password</label>
                <input type="password" name="password_confirmation" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-bold hover:bg-primary transition shadow-lg shadow-orange-500/20">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? <a href="/login" class="text-primary font-bold hover:underline">Login disini</a>
        </p>
    </div>
</x-layout>