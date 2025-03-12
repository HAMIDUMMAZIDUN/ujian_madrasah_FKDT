@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Data Lembaga</h1>
    
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama Lembaga</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lembagas as $lembaga)
            <tr>
                <td class="border px-4 py-2">{{ $lembaga->nama }}</td>
                <td class="border px-4 py-2">
                    <button onclick="openEditModal({{ $lembaga->id }}, '{{ $lembaga->nama }}')" 
                        class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                    
                    <form action="{{ route('data-lembaga.delete') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="id" value="{{ $lembaga->id }}">
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded">
        <h2 class="text-xl font-bold">Edit Lembaga</h2>
        <form action="{{ route('data-lembaga.update') }}" method="POST">
            @csrf
            <input type="hidden" id="editId" name="id">
            <input type="text" id="editNama" name="nama" class="border p-2 w-full" required>
            <div class="mt-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama) {
        document.getElementById('editId').value = id;
        document.getElementById('editNama').value = nama;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@endsection
