<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white flex justify-between">
            <h1 class="text-lg font-bold">User Dashboard</h1>
            <a href="/logout" class="bg-red-500 px-4 py-2 rounded">Logout</a>
        </nav>

        <!-- Container -->
        <div class="container mx-auto mt-6 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Card 1 -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold">Total Ujian</h2>
                    <p class="text-gray-600">5 Ujian Tersedia</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold">Ujian yang Dikerjakan</h2>
                    <p class="text-gray-600">3 Ujian Selesai</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold">Ujian Tersisa</h2>
                    <p class="text-gray-600">2 Ujian Belum Dikerjakan</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
