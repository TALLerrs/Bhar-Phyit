<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full mx-auto bg-white dark:bg-slate-700 min-h-screen dark:text-white text-black px-5">
        <nav class="flex justify-between items-center py-5 border-b-[1px] dark:border-slate-800 border-gray-100">
            <div>
                <h1>
                    <span class="font-normal text-xl">Bhar</span>
                    <span class="text-md">Phyit</span>
                </h1>
            </div>
            <div class="">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-[240px] ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
                </div>
            </div>
        </nav>
        <section class="py-5">
            <div class="grid md:grid-cols-12">
                <aside class="md:col-span-2 text-md">
                    <div class="py-4">left side</div>
                    <div class="py-4">left side</div>
                    <div class="py-4">left side</div>
                </aside>
                {{ $slot }}
            </div>
        </section>
        <footer class="py-5 border-t-[1px] dark:border-slate-800 border-gray-100">
            This is footer
        </footer>
    </div>
</body>

</html>