<nav class="fixed top-0 start-0 z-50 w-full flex justify-between items-center bg-white dark:bg-[#18181B] p-5 border-b-[1px] dark:border-gray-800 border-gray-100">
    <div>
        <a href="{{ route('bhar-phyit') }}" wire:navigate>
            <x-bhar-phyit-icon::logo />
        </a>
    </div>
    <div class="flex items-center gap-5">
        {{-- <div>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <x-bhar-phyit-icon::search />
                </div>
                <input wire:model.live="search" type="search" id="default-search" class="block w-[240px] ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-[#242427] bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
            </div>
        </div> --}}
        <livewire:theme-btn />
    </div>
</nav>