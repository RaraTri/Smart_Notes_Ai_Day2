@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h2 class="text-3xl font-bold mb-2">
        Welcome Back
    </h2>

    <p class="text-slate-600 mb-8">
        Ready To learning today?
    </p>

    <div class="grid md:grid-cols-3 gap-6">
        <x-card>
            <p class="text-slate-500">
                Total Catatan
            </p>
            <h3 class="text-3xl font-bold mt-2">
                12
            </h3>
        </x-card>

        <x-card>
            <p class="text-slate-500">
                Total Quiz
            </p>
            <h3 class="text-3xl font-bold mt-2">
                13
            </h3>
        </x-card>

        <x-card>
            <p class="text-slate-500">
                Total Keseluruhan
            </p>
            <h3 class="text-3xl font-bold mt-2">
                14
            </h3>
        </x-card>
    </div>

    <x-card>
        <h3 class="font-bold mb-4">Aktifitas Terbaru</h3>

        <ul class="space-y-3">
            <li>
                Membuat Quiz
            </li>
            <li>
                Mengupload Image
            </li>
        </ul>
    </x-card>
</div>

@endsection
