<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Tambah Lomba</h2>
                <p class="text-sm text-gray-500">Buat perlombaan baru dan masukkan detailnya.</p>
            </div>
            <a href="{{ route('lomba.index') }}" class="text-[#0066cc] bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg font-medium text-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-3xl p-8">
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-800 border border-red-200 px-4 py-3 rounded-xl mb-6">
                        <ul class="list-disc pl-5 text-sm font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('lomba.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Lomba -->
                    <div class="mb-5">
                        <label for="nama_lomba" class="block font-medium text-sm text-gray-700 mb-1">Nama Lomba <span class="text-red-500">*</span></label>
                        <input id="nama_lomba" type="text" name="nama_lomba" value="{{ old('nama_lomba') }}" required autofocus
                            class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">
                    </div>

                    <!-- Kategori & Tingkat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="kategori" class="block font-medium text-sm text-gray-700 mb-1">Kategori</label>
                            <input id="kategori" type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: IT, Desain, Akademik"
                                class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">
                        </div>
                        <div>
                            <label for="tingkat" class="block font-medium text-sm text-gray-700 mb-1">Tingkat</label>
                            <select id="tingkat" name="tingkat" class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">
                                <option value="">Pilih Tingkat</option>
                                <option value="Lokal" {{ old('tingkat') == 'Lokal' ? 'selected' : '' }}>Lokal / Universitas</option>
                                <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deadline & URL -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="deadline" class="block font-medium text-sm text-gray-700 mb-1">Batas Waktu (Deadline)</label>
                            <input id="deadline" type="date" name="deadline" value="{{ old('deadline') }}"
                                class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">
                        </div>
                        <div>
                            <label for="url" class="block font-medium text-sm text-gray-700 mb-1">URL / Link Pendaftaran</label>
                            <input id="url" type="url" name="url" value="{{ old('url') }}" placeholder="https://..."
                                class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-5">
                        <label for="deskripsi" class="block font-medium text-sm text-gray-700 mb-1">Deskripsi Lomba</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" 
                            class="block w-full border-gray-300 focus:border-[#0066cc] focus:ring-[#0066cc] rounded-xl shadow-sm text-sm p-3">{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Cover Image -->
                    <div class="mb-8">
                        <label for="cover_image" class="block font-medium text-sm text-gray-700 mb-1">Unggah Poster / Gambar Lomba</label>
                        <p class="text-xs text-gray-500 mb-2">Format yang didukung: JPG, PNG, GIF (Maks 2MB)</p>
                        <input id="cover_image" type="file" name="cover_image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#0066cc] hover:file:bg-blue-100 transition cursor-pointer">
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-[#0066cc] text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-[#0055aa] transition shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Simpan Lomba
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
