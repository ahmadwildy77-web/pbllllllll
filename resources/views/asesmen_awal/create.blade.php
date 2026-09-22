<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-8" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-2">Asesmen Awal Profil</h2>
            <p class="text-gray-500 text-center mb-8">Lengkapi data kemampuan Anda untuk melihat rekomendasi lomba yang cocok.</p>

            <form action="{{ route('asesmen_awal.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rata-rata Nilai Mata Kuliah (1-100)</label>
                        <input type="number" name="skor_matkul" min="0" max="100" required
                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                            placeholder="Contoh: 85">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Skor Tes Minat Bakat (1-100)</label>
                        <input type="number" name="skor_minat_bakat" min="0" max="100" required
                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"
                            placeholder="Contoh: 90">
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        Simpan Asesmen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
