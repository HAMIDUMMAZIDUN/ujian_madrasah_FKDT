@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Ubah Password</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Lama -->
        <div class="mb-4">
            <label class="block text-gray-700">Password Lama</label>
            <input type="password" name="current_password" class="w-full p-2 border rounded mt-1">
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Baru -->
        <div class="mb-4">
            <label class="block text-gray-700">Password Baru</label>
            <input type="password" name="new_password" class="w-full p-2 border rounded mt-1">
            @error('new_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="mb-4">
            <label class="block text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded mt-1">
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full">Update Password</button>
    </form>
</div>
@endsection
