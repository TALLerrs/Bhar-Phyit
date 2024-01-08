<div class="col-span-full space-y-5">
    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <div aria-label="error type" class="text-base px-3 flex justify-between">
            <div>{{ $bharPhyitErrorLog->getErrorType() }}</div>
            <div class="text-sm space-x-3 flex items-center gap-1">
                <div>PHP {{ phpversion() }}</div>
                <div class="flex gap-2 items-center">
                    <div>
                        <svg class="w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="laravel" class="svg-inline--fa fa-laravel " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M504.4 115.8a5.72 5.72 0 0 0 -.28-.68 8.52 8.52 0 0 0 -.53-1.25 6 6 0 0 0 -.54-.71 9.36 9.36 0 0 0 -.72-.94c-.23-.22-.52-.4-.77-.6a8.84 8.84 0 0 0 -.9-.68L404.4 55.55a8 8 0 0 0 -8 0L300.1 111h0a8.07 8.07 0 0 0 -.88 .69 7.68 7.68 0 0 0 -.78 .6 8.23 8.23 0 0 0 -.72 .93c-.17 .24-.39 .45-.54 .71a9.7 9.7 0 0 0 -.52 1.25c-.08 .23-.21 .44-.28 .68a8.08 8.08 0 0 0 -.28 2.08V223.2l-80.22 46.19V63.44a7.8 7.8 0 0 0 -.28-2.09c-.06-.24-.2-.45-.28-.68a8.35 8.35 0 0 0 -.52-1.24c-.14-.26-.37-.47-.54-.72a9.36 9.36 0 0 0 -.72-.94 9.46 9.46 0 0 0 -.78-.6 9.8 9.8 0 0 0 -.88-.68h0L115.6 1.07a8 8 0 0 0 -8 0L11.34 56.49h0a6.52 6.52 0 0 0 -.88 .69 7.81 7.81 0 0 0 -.79 .6 8.15 8.15 0 0 0 -.71 .93c-.18 .25-.4 .46-.55 .72a7.88 7.88 0 0 0 -.51 1.24 6.46 6.46 0 0 0 -.29 .67 8.18 8.18 0 0 0 -.28 2.1v329.7a8 8 0 0 0 4 6.95l192.5 110.8a8.83 8.83 0 0 0 1.33 .54c.21 .08 .41 .2 .63 .26a7.92 7.92 0 0 0 4.1 0c.2-.05 .37-.16 .55-.22a8.6 8.6 0 0 0 1.4-.58L404.4 400.1a8 8 0 0 0 4-6.95V287.9l92.24-53.11a8 8 0 0 0 4-7V117.9A8.63 8.63 0 0 0 504.4 115.8zM111.6 17.28h0l80.19 46.15-80.2 46.18L31.41 63.44zm88.25 60V278.6l-46.53 26.79-33.69 19.4V123.5l46.53-26.79zm0 412.8L23.37 388.5V77.32L57.06 96.7l46.52 26.8V338.7a6.94 6.94 0 0 0 .12 .9 8 8 0 0 0 .16 1.18h0a5.92 5.92 0 0 0 .38 .9 6.38 6.38 0 0 0 .42 1v0a8.54 8.54 0 0 0 .6 .78 7.62 7.62 0 0 0 .66 .84l0 0c.23 .22 .52 .38 .77 .58a8.93 8.93 0 0 0 .86 .66l0 0 0 0 92.19 52.18zm8-106.2-80.06-45.32 84.09-48.41 92.26-53.11 80.13 46.13-58.8 33.56zm184.5 4.57L215.9 490.1V397.8L346.6 323.2l45.77-26.15zm0-119.1L358.7 250l-46.53-26.79V131.8l33.69 19.4L392.4 178zm8-105.3-80.2-46.17 80.2-46.16 80.18 46.15zm8 105.3V178L455 151.2l33.68-19.4v91.39h0z"></path>
                        </svg>
                    </div>
                    <div>{{ app()->version() }}</div>
                </div>
            </div>
        </div>
        <div aria-label="title" class="text-lg font-medium">
            {{ $bharPhyitErrorLog->getTitle() }}
        </div>
        <div aria-label="sql" class="dark:bg-gray-200/5 bg-[#FAFAFA] px-5 py-3 cursor-pointer">
            <pre style="white-space: pre-wrap;font-family:monospace;">{!! htmlentities($bharPhyitErrorLog->getSql()) !!}</pre>
        </div>
    </div>

    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <h1 class="text-lg font-medium text-indigo-500 flex items-center gap-2">
            <span>
                {{ $appName }}
            </span>
            <span>
                <!-- logo here -->
            </span>
        </h1>
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Method</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getMethod() }}</code>
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
        </dl>
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">URL</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getUrl() }}</code>
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
        </dl>
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Line</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getLine() }}</code>
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
        </dl>
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Occurrences</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getOccurences() }}</code>
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
        </dl>
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Last Occurred at</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getLastOccuredAt() }}</code>
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
        </dl>
        @if ($bharPhyitErrorLog->resolved_at)
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Resolved at</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->getResolvedAt() }}</code>
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
        </dl>
        @endif
        <dl class="grid grid-cols-1 gap-2">
            <div class="flex items-baseline gap-10">
                <dt class="flex-none truncate w-[8rem]">Status</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden max-h-32 overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">{{ $bharPhyitErrorLog->status }}</code>
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
        </dl>
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
            <h1 class="text-lg font-medium text-indigo-500 flex items-center gap-2 ">
                <span>Body</span>
                <span>
                    <svg class="w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="code" class="svg-inline--fa fa-code fa-fw " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path fill="currentColor" d="M414.8 40.79L286.8 488.8C281.9 505.8 264.2 515.6 247.2 510.8C230.2 505.9 220.4 488.2 225.2 471.2L353.2 23.21C358.1 6.216 375.8-3.624 392.8 1.232C409.8 6.087 419.6 23.8 414.8 40.79H414.8zM518.6 121.4L630.6 233.4C643.1 245.9 643.1 266.1 630.6 278.6L518.6 390.6C506.1 403.1 485.9 403.1 473.4 390.6C460.9 378.1 460.9 357.9 473.4 345.4L562.7 256L473.4 166.6C460.9 154.1 460.9 133.9 473.4 121.4C485.9 108.9 506.1 108.9 518.6 121.4V121.4zM166.6 166.6L77.25 256L166.6 345.4C179.1 357.9 179.1 378.1 166.6 390.6C154.1 403.1 133.9 403.1 121.4 390.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4L121.4 121.4C133.9 108.9 154.1 108.9 166.6 121.4C179.1 133.9 179.1 154.1 166.6 166.6V166.6z"></path>
                    </svg>
                </span>
            </h1>
            <div class="dark:bg-gray-200/5 group py-2 px-5 relative my-5">
                <div class="overflow-y-hidden overflow-x-scroll scrollbar-hidden-x space-y-2">
                    <div class="made-fade-x">
                        <code class="font-mono leading-relaxed text-sm font-normal">
                            <pre>{!! json_encode(json_decode($bharPhyitErrorLog->detail->payload), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}</pre>
                        </code>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5">
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
                        <code class="font-mono leading-relaxed text-sm font-normal">
                            <pre>{!! json_encode(json_decode($user->toJson()), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}</pre>
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-full space-y-5">
        <div class="relative flex flex-col gap-4 space-y-3 justify-start text-sm px-7 py-5 dark:bg-[#18181B]/40 bg-white shadow-md dark:ring-white/10 rounded-xl">
            <div class="absolute top-[-10px] left-1/2 px-3 py-2 z-10 bg-indigo-500 rounded-full text-[12px]">
                <span class="p-1 rounded-full bg-gray-900/20">{{ count($bharPhyitErrorLog->detail->getQueries()) }}</span>
                <span>QUERIES</span>
            </div>
            @foreach ($bharPhyitErrorLog->detail->getQueries() as $query)
            <div class="space-y-2 relative">
                <div class="flex gap-2 text-xs">
                    <div class="px-2 py-1 border-[1px] rounded-md border-gray-500/30 flex gap-2 items-center">
                        <span>
                            <svg class="w-3 h-3" aria-labelledby="svg-inline--fa-title-ZD3QJpnHq1Py" data-prefix="fas" data-icon="stopwatch" class="svg-inline--fa fa-stopwatch opacity-50" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <title id="svg-inline--fa-title-ZD3QJpnHq1Py">Runtime</title>
                                <path fill="currentColor" d="M272 0C289.7 0 304 14.33 304 32C304 49.67 289.7 64 272 64H256V98.45C293.5 104.2 327.7 120 355.7 143L377.4 121.4C389.9 108.9 410.1 108.9 422.6 121.4C435.1 133.9 435.1 154.1 422.6 166.6L398.5 190.8C419.7 223.3 432 262.2 432 304C432 418.9 338.9 512 224 512C109.1 512 16 418.9 16 304C16 200 92.32 113.8 192 98.45V64H176C158.3 64 144 49.67 144 32C144 14.33 158.3 0 176 0L272 0zM248 192C248 178.7 237.3 168 224 168C210.7 168 200 178.7 200 192V320C200 333.3 210.7 344 224 344C237.3 344 248 333.3 248 320V192z"></path>
                            </svg>
                        </span>
                        <span>{{ $query->time }} MS</span>
                    </div>
                    <div class="px-2 py-1 border-[1px] rounded-md border-gray-500/30 flex gap-2 items-center">
                        <span>
                            <svg class="w-3 h-3" aria-labelledby="svg-inline--fa-title-Ki0TtJINBhSs" data-prefix="fas" data-icon="database" class="svg-inline--fa fa-database opacity-50" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <title id="svg-inline--fa-title-Ki0TtJINBhSs">Connection</title>
                                <path fill="currentColor" d="M448 80V128C448 172.2 347.7 208 224 208C100.3 208 0 172.2 0 128V80C0 35.82 100.3 0 224 0C347.7 0 448 35.82 448 80zM393.2 214.7C413.1 207.3 433.1 197.8 448 186.1V288C448 332.2 347.7 368 224 368C100.3 368 0 332.2 0 288V186.1C14.93 197.8 34.02 207.3 54.85 214.7C99.66 230.7 159.5 240 224 240C288.5 240 348.3 230.7 393.2 214.7V214.7zM54.85 374.7C99.66 390.7 159.5 400 224 400C288.5 400 348.3 390.7 393.2 374.7C413.1 367.3 433.1 357.8 448 346.1V432C448 476.2 347.7 512 224 512C100.3 512 0 476.2 0 432V346.1C14.93 357.8 34.02 367.3 54.85 374.7z"></path>
                            </svg>
                        </span>
                        <span>
                            {{ str($query->connection_name)->upper() }}
                        </span>
                    </div>
                </div>
                <div class="dark:bg-gray-800/20 group py-2 px-5 relative">
                    <div class="overflow-y-hidden overflow-x-scroll scrollbar-hidden-x">
                        <code class="leading-relaxed text-sm font-normal">{{ $query->sql }}</code>
                    </div>
                    <div class="absolute top-2 right-3">
                        <button type="button" class="w-4 h-4 rounded-full flex items-center justify-center text-xs text-indigo-500 hover:~text-indigo-600  transition-animation shadow-md hover:shadow-lg active:shadow-sm active:translate-y-px&quot; opacity-0 transform scale-80 transition-animation delay-100 group-hover:opacity-100 group-hover:scale-100" title="Copy to clipboard">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" class="svg-inline--fa fa-copy " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>