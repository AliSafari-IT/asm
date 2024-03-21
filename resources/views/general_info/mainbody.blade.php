{{--resources/views/general_info/main.blade.php--}}
@props([
    'sidebar' => null,
    'toolbar' => null,
    'header' => null,
    'actions' => null,
    'slot' => null
])
    <div class="min-h-screen bg-gray-100">
        @include('general_info.navigation')

        <!-- Sidebar -->
        @if (isset($sidebar))
        <sidebar class="hidden md:block">
            {{ $sidebar }}
        </sidebar>
        @endif

        <!-- Toolbar -->
        @if (isset($toolbar))
        <toolbar>
            {{ $toolbar }}
        </toolbar>
        @endif

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('message') }}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            {{ session('error') }}
        </div>
        @endif

        @if (session()->has('warning'))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            {{ session('warning') }}
        </div>
        @endif

        @if (session()->has('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            {{ session('info') }}
        </div>
        @endif

        @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>