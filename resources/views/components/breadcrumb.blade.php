    <div class="flex" aria-label="Breadcrumb">
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex items-center mr-6"
            title="Home">
            <!-- Logo -->
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </x-nav-link>

        <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="flex items-center">
            {{ __('Contact') }}
            <svg class="fill-current w-4 h-4 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
            </svg>
        </x-nav-link>
        <x-nav-link href="{{ route('privacy') }}" :active="request()->routeIs('privacy')" class="flex items-center">
            {{ __('Privacy') }}
            <svg class="fill-current w-4 h-4 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
            </svg>
        </x-nav-link>
        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')" class="flex items-center">
            {{ __('About') }}
            <svg class="fill-current w-4 h-4 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
            </svg>
        </x-nav-link>
    </div>