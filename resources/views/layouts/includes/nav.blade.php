<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img class="h-8 w-auto" src="{{ asset('logo.png') }}" alt="Your Company">
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('home') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Users</a>
                        <a href="{{ route('audio') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Audio</a>
                        <a href="{{ route('distance') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Distance</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>