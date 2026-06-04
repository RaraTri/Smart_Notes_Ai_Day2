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
@endsection