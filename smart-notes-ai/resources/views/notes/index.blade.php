@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h2 class="text-3xl font-bold">
        Notes
    </h2>

    <p class="text-slate-500 mt-2">
        Buat Catatanmu jadi lebih berwarna
    </p>

    <x-card>
        <h3 class="text-lg font-bold mb-6">Tambahkan Catatan</h3>

        <div class="space-y-4">
            <div>
                <label class="block mb-2">Judul</label>
                <input type="text" name="title" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="block mb-2">Isi Catatan</label>
                <textarea rows="6" type="text" name="title" class="w-full border rounded-lg px-4 py-2"></textarea>
            </div>
        </div>

        <x-button>Simpan</x-button>
    </x-card>

    <x-card>
        <h3 class="lg font-semibold">Upload Catatan</h3>
        <input type="file" class="block w-full border rounded-lg px-4 py-2">
        <p class="text-slate-500 mt-4">Upload Catatan Yang ingin anda simpulkan</p>
    </x-card>

    <div>
        <h3 class="text-xl font-bold mb-4">Catatan Saya</h3>

        <div class="space-y-4">
            <x-card>
                <h4>Belajar Laravel</h4>
                <p class="text-shadow-yellow-50 mt-2">Saya sedang belajar laravel</p>
                <div class="flex gap-2 mt-4">
                    <x-button class="btn-summary">
                        Simpulkan Menggunakan AI
                    </x-button>
                    <div class="summary-container hidden mt-4 p-3 bg-slate-100 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 text-sm">
    <strong class="block mb-1 text-blue-500">✨ Summary AI:</strong>
    <span class="summary-text text-slate-700 dark:text-slate-300 italic"></span>
</div>
                    <x-button class="bg-emerald-600">
                        Buat Quiz dengan AI
                    </x-button>
                    <x-button class="bg-red-600">
                        Hapus
                    </x-button>
                </div>
            </x-card>

            <x-card>
                <h4>Belajar Node JS</h4>
                <p class="text-shadow-yellow-50 mt-2">Saya sedang belajar Node JS dengan framework Next JS</p>
                <div class="flex gap-2 mt-4">
                    <x-button>
                        Simpulkan Menggunakan AI
                    </x-button>
                    <x-button class="bg-emerald-600">
                        Buat Quiz dengan AI
                    </x-button>
                    <x-button class="bg-red-600">
                        Hapus
                    </x-button>
                </div>
            </x-card>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.btn-summary').forEach(button => {
    button.addEventListener('click', async function() {
        // Mencari kotak kartu tempat tombol ini berada
        const card = this.closest('div').parentElement; 
        const pTag = card.querySelector('p');
        const noteContent = pTag ? pTag.innerText : 'Catatan';
        
        const container = card.querySelector('.summary-container');
        const textSpan = card.querySelector('.summary-text');
        
        // Tampilkan kotak loading
        container.classList.remove('hidden');
        textSpan.innerText = 'AI sedang membaca dan meringkas...';
        this.disabled = true;

        try {
            // Minta data ke backend dengan metode fetch stream
            const response = await fetch('/notes/summarize', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content: noteContent })
            });

            const reader = response.body.getReader();
            const decoder = new TextDecoder();
            textSpan.innerText = ''; // Hapus tulisan loading, siap ngetik real-time

            // Loop membaca potongan data yang dikirim server per kata
            while (true) {
                const { done, value } = await reader.read();
                if (done) break;
                
                // Cetak potongan kata ke layar secara langsung
                textSpan.innerHTML += decoder.decode(value, { stream: true });
            }
        } catch (error) {
            textSpan.innerText = 'Gagal memuat ringkasan dari AI.';
        } finally {
            this.disabled = false;
        }
    });
});
</script>
@endsection