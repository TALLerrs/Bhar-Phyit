<div class="col-span-full space-y-5">
    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <div aria-label="error type" class="text-base px-3 flex justify-between">
            <div>{{ $bharPhyitErrorLog->getErrorType() }}</div>
            <div class="text-sm space-x-3">
                <span>PHP 8.2.14</span>
                <span>Laravel 10.3.2</span>
            </div>
        </div>
        <div aria-label="title" class="text-lg font-medium">
            {{ $bharPhyitErrorLog->getTitle() }}
        </div>
        <div aria-label="sql" class="dark:bg-gray-200/5 bg-[#FAFAFA] px-5 py-3 cursor-pointer">
            @formatSql($bharPhyitErrorLog->getSql())
        </div>
    </div>

    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <div class="border-b-[1px] dark:border-gray-200/5 pb-5">
            <h1 class="text-lg font-medium text-indigo-500 mb-5 flex items-center gap-2">
                <span>
                    Headers
                </span>
                <span>
                    <svg class="w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="right-left" class="svg-inline--fa fa-right-left fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"></path>
                    </svg>
                </span>
            </h1>

            <dl class="grid grid-cols-1 gap-2">
                @foreach($bharPhyitErrorLog->detail->getHeaders() as $header => $value)
                @if (data_get($value, '0'))
                <div class="flex items-baseline gap-10">
                    <dt class="flex-none truncate w-[8rem]">{{ $header }}</dt>
                    <dd class="flex-grow min-w-0">
                        <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                            <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                                <code class="leading-relaxed text-sm font-normal">{{ str(data_get($value, '0'))->limit(120, '') }}</code>
                            </div>
                            <div class="absolute top-2 right-3">
                                <button type="button" class="w-4 h-4 rounded-full flex items-center justify-center text-xs text-indigo-500 hover:~text-indigo-600  transition-animation shadow-md hover:shadow-lg active:shadow-sm active:translate-y-px&quot; opacity-0 transform scale-80 transition-animation delay-100 group-hover:opacity-100 group-hover:scale-100" title="Copy to clipboard">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" class="svg-inline--fa fa-copy " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </dd>
                </div>
                @endif
                @endforeach
            </dl>
        </div>
        <div class="border-b-[1px] dark:border-gray-200/5 pb-5">
            <h1 class="text-lg font-medium text-indigo-500 flex items-center gap-2">
                <span>User</span>
                <span>
                    <svg class="w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
                    </svg>
                </span>
            </h1>
            <div>
                <div class="my-5">
                    <h2 class="text-base font-medium">{{ $user?->name }}</h2>
                    <p>{{ $user?->email }}</p>
                </div>
                <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                    <div class="overflow-y-hidden overflow-x-scroll scrollbar-hidden-x space-y-2">
                        <code>
                            <span>{</span>
                            @foreach ($user->attributesToArray() as $column => $value)
                            <div class="pl-5">
                                "{{ $column }}": {{ $value }}
                            </div>
                            @endforeach
                            }
                        </code>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- @dump($bharPhyitErrorLog->detail->user) -->


</div>