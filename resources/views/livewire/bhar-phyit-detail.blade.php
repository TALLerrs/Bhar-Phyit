<div class="col-span-full space-y-5 p-10">
    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <div aria-label="error type" class="text-base px-3 flex justify-between">
            <div>{{ $bharPhyitErrorLog->getErrorType() }}</div>
            <div class="text-sm space-x-3 flex items-center gap-1">
                <div>PHP {{ phpversion() }}</div>
                <div class="flex gap-2 items-center">
                    <div>
                        <x-bhar-phyit-icon::laravel-logo />
                    </div>
                    <div>{{ app()->version() }}</div>
                </div>
            </div>
        </div>
        <div aria-label="title" class="text-lg font-medium">
            {{ $bharPhyitErrorLog->getTitle() }}
        </div>
        @if($bharPhyitErrorLog->getSql())
            <div aria-label="sql" class="dark:bg-gray-200/5 bg-[#FAFAFA] px-5 py-3 cursor-pointer">
                <pre style="white-space: pre-wrap;font-family:monospace;">{!! htmlentities($bharPhyitErrorLog->getSql()) !!}</pre>
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-4 justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
        <h1 class="text-lg font-medium copy.bladetext-indigo-500 flex items-center gap-2">
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
                <dt class="flex-none truncate w-[8rem]">Code</dt>
                <dd class="flex-grow min-w-0">
                    <div class="dark:bg-gray-200/5 group py-2 px-5 relative">
                        <div class="overflow-y-hidden overflow-x-scroll scrollbar-hidden-x">
                            <code class="leading-relaxed text-sm font-normal">
                                @foreach($bharPhyitErrorLog->getErrorCodeLine() as $code)
                                    <div class="flex {{ $code->is_error_line ? "text-red-900 bg-slate-300" : "" }}">
                                        <span class="mr-5">{{ $code->line_number }}</span>
                                        <pre>{{ $code->code }}</pre>
                                    </div>
                                @endforeach
                            </code>
                        </div>
                        <div class="absolute top-2 right-3">
                            <button type="button" class="w-4 h-4 rounded-full flex items-center justify-center text-xs text-indigo-500 hover:~text-indigo-600  transition-animation shadow-md hover:shadow-lg active:shadow-sm active:translate-y-px&quot; opacity-0 transform scale-80 transition-animation delay-100 group-hover:opacity-100 group-hover:scale-100" title="Copy to clipboard">
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                                <x-bhar-phyit-icon::copy />
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
                    <x-bhar-phyit-icon::arrow-right-arrow-left  />
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
                                    <x-bhar-phyit-icon::copy />
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
                    <x-bhar-phyit-icon::code />
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
        @if($user)
            <div class="pb-5">
                <h1 class="text-lg font-medium text-indigo-500 flex items-center gap-2">
                    <span>User</span>
                    <span>
                        <x-bhar-phyit-icon::person />
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
                                    <pre>{!! json_encode(json_decode($user?->toJson()), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}</pre>
                                </code>
                            </div>
                        </div>
                    </div>
            </div>
        @endif
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
                            <x-bhar-phyit-icon::clock />
                        </span>
                        <span>{{ $query->time }} MS</span>
                    </div>
                    <div class="px-2 py-1 border-[1px] rounded-md border-gray-500/30 flex gap-2 items-center">
                        <span>
                            <x-bhar-phyit-icon::database />
                        </span>
                        <span>
                            {{ str($query->connection_name)->upper() }}
                        </span>
                    </div>
                </div>
                <div class="dark:bg-gray-800/20 group py-2 px-5 relative">
                    <div class="overflow-y-hidden overflow-x-scroll scrollbar-hidden-x">
                        <code class="leading-relaxed text-sm font-normal">
                            {{ $query->sql }}
                        </code>
                    </div>
                    <div class="absolute top-2 right-3">
                        <button type="button" class="w-4 h-4 rounded-full flex items-center justify-center text-xs text-indigo-500 hover:~text-indigo-600  transition-animation shadow-md hover:shadow-lg active:shadow-sm active:translate-y-px&quot; opacity-0 transform scale-80 transition-animation delay-100 group-hover:opacity-100 group-hover:scale-100" title="Copy to clipboard">
                            <x-bhar-phyit-icon::copy />
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>