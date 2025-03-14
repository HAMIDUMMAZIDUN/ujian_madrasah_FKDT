<!-- Filter -->
<div class="border-t-4 border-gray-700 my-4"></div>
<script src="{{ asset('js/filter.js') }}"></script>

<!-- Sidebar Menu -->
<nav class="space-y-2">
    <!-- Fitur Menu -->
    <a href="#" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
        <i data-lucide="layout-dashboard"></i>
        <span x-show="sidebarOpen" class="ml-2">Dashboard</span>
    </a>

    <!-- FORM FILTER -->
    <form method="GET" action="{{ route('admin.dashboard') }}" id="filter-form" class="p-4 bg-white rounded shadow">
        <div class="mb-4">
            <h1 class="block text-black font-bold">Filter Berdasarkan:</h1>
            <br>

            <!-- Pilih Kecamatan -->
            <label for="kecamatan" class="block text-black font-semibold">Pilih Kecamatan</label>
            <select name="kecamatan" id="kecamatan" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                <option value="">Semua Kecamatan</option>
                @foreach($list_kecamatan as $kecamatan)
                    <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Desa -->
        <div class="mb-4">
            <label for="desa" class="block text-black font-semibold">Pilih Desa</label>
            <select name="desa" id="desa" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                <option value="">Semua Desa</option>
            </select>
        </div>

        <!-- Pilih Kode MDT -->
        <div class="mb-4">
            <label for="kode_mdt" class="block text-black font-semibold">Pilih Kode MDT</label>
            <select name="kode_mdt" id="kode_mdt" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                <option value="">Semua Kode MDT</option>
                @foreach($list_kode_mdt as $kode)
                    <option value="{{ $kode }}">{{ $kode }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Terapkan Filter</button>
    </form>
</nav>


    

