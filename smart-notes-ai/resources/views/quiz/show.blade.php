@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h2 class="text-3xl font-bold mb-2">
        Pertanyaan
    </h2>

    <x-card>
        <h3 class="font-semibold mb-4">Soal 1</h3>
        <p class="mb-4">Apa itu composer</p>

        <div class="space-y-2">
            <div>A. Sebuah Package manager untuk php</div>
            <div>B. Bawaan Aplikasi Node JS</div>
            <div>C. Package Manajer Node JS</div>
            <div>D. Package Manajer untuk Install Next JS</div>
        </div>
    </x-card>
</div>
@endsection