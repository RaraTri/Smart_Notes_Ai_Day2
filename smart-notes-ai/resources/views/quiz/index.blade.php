@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h2 class="text-3xl font-bold mb-2">
        Quiz
    </h2>

    <p class="text-slate-600 mb-8">
        Buat dirimu lebih jago dengan quiz
    </p>

    <div class="space-y-4">
        <x-card>
            <h3 class="font-bold">Belajar Laravel</h3>
            <p class="text-slate-500">
                5 Soal
            </p>
            <div class="flex gap-2 mt-4">
                <a href="/show-quiz">
                    <x-button>
                        Masuk Ke Quiz
                    </x-button>
                </a>

                <x-button class="bg-red-600">
                    Hapus
                </x-button>
            </div>
        </x-card>

        <x-card>
            <h3 class="font-bold">Belajar Node JS</h3>
            <p class="text-slate-500">
                5 Soal
            </p>

            <div class="flex gap-2 mt-4">
                <a href="/show-quiz">
                    <x-button>
                        Masuk Ke Quiz
                    </x-button>
                </a>

                <x-button class="bg-red-600">
                    Hapus
                </x-button>
            </div>
        </x-card>
    </div>
<div>

@endsection