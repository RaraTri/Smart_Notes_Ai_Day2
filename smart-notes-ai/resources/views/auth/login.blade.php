@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-100">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">Smart Notes Ai</h1>
        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label class="block mb-2">Username</label>
                <input type="text" name="username" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-2">Password</label>
                <input type="password" name="password" class="w-full border rounded-lg px-4 py-2">
            </div>

            <x-button class="w-full">
                Login
            </x-button>
        </form>
    </div>
</div>
@endsection
