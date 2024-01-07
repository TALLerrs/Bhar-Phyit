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
        <h1 class="text-lg font-medium text-indigo-500">Headers</h1>

        <dl class="grid grid-cols-1 gap-2 ">
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
</div>