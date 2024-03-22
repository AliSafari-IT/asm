<x-app-layout :header="true">
    <div class="container mx-auto px-4 py-7">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('About Us') }}
            </h2>
        </x-slot>
        <p>Welcome to our website! We are dedicated to providing you with the best experience possible. Here, you'll
            find information about our services, our team, and what makes us stand out in our industry. We believe in
            quality, innovation, and community. Join us as we explore new horizons together.</p>

        <!-- Embed YouTube Video -->
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ImtZ5yENzgE?si=93NUYJI-l3f9OJ1V"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
        <p>If you have any questions or need further information, please feel free to contact us.</p>

        <!-- Resources Section -->
        <h2>Resources</h2>
        <p>For those who are just starting out or looking to enhance their skills, we've compiled a list of resources
            that can help you on your journey from simple to complex web application development:</p>
        <ul>
            <li><a href="https://github.com/getify/You-Dont-Know-JS" target="_blank">You Don't Know JS (Book Series) -
                    GitHub</a></li>
            <li><a href="https://www.youtube.com/channel/UCW5YeuERMmlnqo4oq8vwUpg" target="_blank">The Net Ninja -
                    YouTube</a></li>
            <li><a href="https://github.com/danistefanovic/build-your-own-x" target="_blank">Build your own X -
                    GitHub</a></li>
            <li><a href="https://www.youtube.com/user/TechGuyWeb" target="_blank">Traversy Media - YouTube</a></li>
            <li><a href="https://github.com/kamranahmedse/developer-roadmap" target="_blank">Developer Roadmap -
                    GitHub</a></li>
        </ul>
    </div>
    @section('footer')
    @include('layouts.footer')
    @endsection



</x-app-layout>