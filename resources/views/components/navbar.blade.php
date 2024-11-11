<header class="flex flex-col items-center justify-between px-6 py-4 border-b sm:px-8 lg:px-12">
    <nav class="flex items-center justify-between w-full">
        <a href="{{ route('home') }}" wire:navigate>
            <span class="text-xl font-bold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
        </a>

        <ul class="flex items-center justify-center gap-4 text-sm text-gray-800 dark:text-white">
            <li>
                <a href="{{ route('home') }}" wire:navigate>
                    Home
                </a>
            </li>
        </ul>
    </nav>
</header>