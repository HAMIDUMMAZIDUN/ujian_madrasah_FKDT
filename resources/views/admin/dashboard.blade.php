<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/FKDT.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/filter.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">
<div x-data="{ sidebarOpen: true }" class="flex h-screen">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="h-screen bg-gray-900 text-gray-200 p-4 shadow-md transition-all duration-300 relative">
       
        <!-- Header Sidebar -->
            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-400 hover:bg-gray-700 rounded">
                    <i data-lucide="menu"></i>
                </button>

                <div class="flex items-center ml-4" x-show="sidebarOpen" x-cloak>
                    <img src="{{ asset('images/FKDT.png') }}" alt="FKDT Logo" class="w-10 h-10">
                    <span class="ml-2 font-semibold text-white">PDUMDT</span>
                </div>
            </div>
        
        <!--sidebar-->
        @include('admin.layouts.sidebar')
        <div x-data="{ openModal: false, formHtml: '' }">

        <!--tambahData-->
        <br>
        @include('admin.layouts.tambahdata')

        <!-- Main Content -->
        @include('admin.layouts.maincontent')

        <!--Script-->
        @include('admin.layouts.script')
        
</body>
</html>
