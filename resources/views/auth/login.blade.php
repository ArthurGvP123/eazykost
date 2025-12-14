<x-layout>
    <div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow-lg border border-orange-100">
        <h2 class="text-2xl font-bold text-center text-primary mb-6">Masuk ke Eazy Kost</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:outline-none" value="{{ old('email') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-primary focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-bold hover:bg-orange-600 transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun? <a href="/register" class="text-primary font-bold hover:underline">Daftar disini</a>
        </p>
    </div>
</x-layout>