<div class="md:col-span-12 relative">
    <div class="grid w-full place-items-center pt-10  md:grid-cols-3">
        <div>
        </div>
        <div class="flex w-full rounded-xl border shadow-md dark:bg-[#18181B] mr-10">
            <input type="search" class="w-full border-none bg-transparent px-4 py-2 focus:outline-none text-white" placeholder="search..." wire:model.live="search"/>
        </div>
        <div class="w-full">
            <select name="" id="" class="w-[30%] bg-transparent px-4 py-2 focus:outline-none text-white rounded-xl border shadow-md dark:bg-[#18181B]" wire:model.live="filterOption">
                <option value="unsolved" selected="selected">Un Solved</option>
                <option value="solved">Solved</option>
                <option value="snoozed">Snoozed</option>
            </select>
        </div>
    </div>
    <div class="grid md:grid-cols-3 gap-5 p-10">
        @foreach($bharPhyits as $bharPhyit)
            <div class="justify-start text-sm dark:bg-[#18181B] bg-white flex flex-col gap-3 shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl relative" x-data="{ isHover : false }" @mouseover="isHover = true" @mouseover.away="isHover = false">
                <a class="px-7 py-5" href="{{ route('bhar-phyit-detail', $bharPhyit) }}" wire:navigate>
                    <h1 class="text-wrap">{{ str($bharPhyit->title)->limit(100, '...') }}</h1>
                    <p>Last occured : {{ $bharPhyit->last_occurred_at->dtString() }}</p>
                    <span>Occurrences : {{ $bharPhyit->occurrences }}</span>
                </a>
                <div x-show="isHover" class="absolute right-0 left-auto ring-1 rounded-bl-xl rounded-tr-xl ring-gray-950/5 dark:ring-white/10 dark:bg-[#18181B]">
                    <div class="flex">
                        <button type="button" wire:click="snooze('{{ $bharPhyit->id }}')" class="p-2 border-r border-white/10">
                            @if($bharPhyit->isSnoozed())
                                unSnoozed
                            @else
                                Snoozed
                            @endif
                        </button>
                        <button type="button" wire:click="solve('{{ $bharPhyit->id }}')" class="p-2">
                            @if(is_null($bharPhyit->resolved_at))
                                Solve
                            @else
                                unSolve
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="p-5">
        {{ $bharPhyits->links('pagination::tailwind') }}
    </div>
</div>