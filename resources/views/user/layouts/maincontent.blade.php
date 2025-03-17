<main class="flex-1 p-3 md:p-4 relative overflow-x-auto overflow-y-auto">

     <!-- User Profile (Top Right) -->
        <div class="absolute top-0 right-0 m-3 flex items-center">
            <div>
                <button type="button" class="flex items-center space-x-2 focus:outline-none" id="menu-button">
                <span class="mr-2 text-sm font-semibold">{{ Auth::user()->name }}</span>    
                <img src="{{ asset('images/FKDT.png') }}" alt="User" class="w-7 h-7 rounded-full">
                </button>
            </div>
            <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg transition-all duration-300">
                <a href="{{ route('password.change') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ubah Password</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>

    <!-- Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-12">
    @php
        $stats = [
            ['label' => 'Jumlah Lembaga', 'value' => $jumlah_lembaga, 'color' => 'bg-blue-500'],
            ['label' => 'Jumlah Santri', 'value' => $jumlah_santri, 'color' => 'bg-green-500'],
            ['label' => 'Jumlah Desa', 'value' => $jumlah_desa, 'color' => 'bg-yellow-500'],
            ['label' => 'Jumlah Kecamatan', 'value' => $jumlah_kecamatan, 'color' => 'bg-red-500'],
            ['label' => 'Santri Laki-laki', 'value' => $jumlah_santri_laki, 'color' => 'bg-purple-500'],
            ['label' => 'Santri Perempuan', 'value' => $jumlah_santri_perempuan, 'color' => 'bg-pink-500']
        ];

        $max_value = max(array_column($stats, 'value'));
    @endphp

    @foreach($stats as $stat)
        <div class="p-6 text-black shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center w-full relative group">
            <h2 class="text-lg font-semibold">{{ $stat['label'] }}</h2>
            <p class="text-3xl font-bold">{{ number_format($stat['value']) }}</p>
            
            <div class="w-full bg-gray-200 rounded-full h-6 mt-3 relative overflow-hidden">
                <div class="{{ $stat['color'] }} h-6 rounded-full transition-all duration-500"
                    style="width: {{ $max_value > 0 ? ($stat['value'] / $max_value) * 100 : 0 }}%;">
                </div>
                <span class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 
                    text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ round(($stat['value'] / $max_value) * 100, 2) }}%
                </span>
            </div>
        </div>
    @endforeach
</div>

    <!-- Button Download Excel & Import -->
    <div class="mt-4 flex flex-col sm:flex-row items-center gap-3">
        <form method="GET" id="export-form" action="{{ route('export.excel') }}">
            <button type="submit" class="bg-green-500 text-white font-bold py-1.5 px-3 rounded">Download Excel</button>
        </form>
        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-2">
            @csrf
            <a href="{{ route('download.template') }}" class="bg-blue-500 text-white px-3 py-1.5 rounded">Download Template</a>
            <input type="file" name="file" class="border rounded px-2 py-1 text-sm">
            <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded">Upload</button>
        </form>
    </div>

    <!-- TABEL DETAIL DATA -->
    <div class="flex flex-col h-[70vh] mt-3">
        <div class="text-center flex-grow">
            @if($data->isEmpty())
                <p class="text-gray-500 text-sm">Tidak ada data yang ditemukan.</p>
            @else
                <div class="max-h-[60vh] overflow-auto border rounded-lg shadow-md p-3 text-sm">
                    @include('database.usermastermdt', compact('data'))
                </div>
            @endif
        </div>
    </div>
</main>
