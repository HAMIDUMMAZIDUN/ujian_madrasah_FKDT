<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi PDUM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-gradient-to-r from-green-400 to-green-700 flex items-center justify-center min-h-screen p-0 relative overflow-hidden">
    <!-- Hiasan Background Shape -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-green-500 opacity-30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-green-700 opacity-30 rounded-full blur-3xl"></div>
    
    <!-- Layout dengan Gambar di Kiri dan Form di Kanan -->
    <div class="w-full h-screen flex flex-col md:flex-row relative z-10">
    <!-- Bagian Kiri: Gambar Background Full -->
    <div class="hidden md:flex md:w-1/2 relative">
        <img src="{{ asset('images/background.jpg') }}" alt="Ilustrasi" class="absolute inset-0 w-full h-full object-cover">
    </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="w-full md:w-1/2 h-full flex flex-col justify-center bg-white p-8 relative">
            <div class="text-center mb-6">
                <img src="{{ asset('images/FKDT.png') }}" alt="Logo" class="w-24 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-gray-700">DPC FKDT KAB.BANDUNG</h1>
                <p class="text-gray-500">Silakan login menggunakan akun PDUM Lembaga Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">Login</button>

                @if(session('error'))
                    <p class="text-red-500 text-sm mt-2 text-center">{{ session('error') }}</p>
                @endif
            </form>

            <div class="text-center mt-4 text-xs text-gray-500">
                Tim Teknis DPC FKDT Kabupaten Bandung
            </div>
        </div>
    </div>
</body>
</html>