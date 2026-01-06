<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mesaje succes/eroare dispar după 5 secunde
            document.querySelectorAll('.flash-message').forEach(el => {
                setTimeout(() => el.remove(), 5000);
            });
        });
    </script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
            <nav class="flex flex-wrap gap-4">
                <a href="{{ route('profiles.index') }}" class="text-gray-600 hover:text-gray-900">Profiles</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Other Section</a>
            </nav>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="flash-message bg-green-200 text-green-800 px-4 py-2 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message bg-red-200 text-red-800 px-4 py-2 rounded mb-4 shadow">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flash-message bg-red-100 text-red-800 px-4 py-2 rounded mb-4 shadow">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-1 container mx-auto px-4 max-w-6xl">
        <h2 class="text-3xl font-bold mb-6">@yield('page-title')</h2>
        @yield('content')
    </main>

    <!-- FOOTER (optional) -->
    <footer class="bg-white shadow mt-6 py-4 text-center text-gray-500 text-sm mt-8">
        &copy; {{ date('Y') }} Admin Panel
    </footer>

    <!-- CONFIRMATION DELETE MODAL -->
    <x-delete-modal />

</body>
</html>
