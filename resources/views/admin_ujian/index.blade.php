<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-center text-blue-600">Daftar Ujian</h1>
        <table class="table-auto w-full bg-white shadow-md rounded-lg mt-4">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Ujian</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2 text-center">1</td>
                    <td class="border px-4 py-2">Ujian Akhir Semester</td>
                    <td class="border px-4 py-2">2025-06-10</td>
                    <td class="border px-4 py-2 text-center">
                        <button class="bg-green-500 text-white px-3 py-1 rounded">Edit</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
