<div class="md:col-span-10">
    <div class="grid md:grid-cols-3 gap-5">
        @foreach(range(1, 20) as $item)
        <div class="p-4 flex flex-col gap-3 shadow-md ring-1 ring-gray-500 border-2 rounded-md border-gray-600">
            <h1>Title here</h1>
            <p>This is desciption....</p>
            <span>Line: 245</span>
        </div>
        @endforeach
    </div>
    <div class="flex flex-col items-end mt-5">
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span class="font-semibold text-gray-900 dark:text-white">20</span> of <span class="font-semibold text-gray-900 dark:text-white">100</span> Entries
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Prev
            </button>
            <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
            </button>
        </div>
    </div>
</div>