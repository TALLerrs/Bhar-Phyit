<div class="md:col-span-12">
    <div class="grid md:grid-cols-3 gap-5">
        @foreach($bharPhyits as $bharPhyit)
        <a href="{{ route('bhar-phyit-detail', $bharPhyit) }}" wire:navigate class="justify-start text-sm px-7 py-5 dark:bg-[#18181B] bg-white flex flex-col gap-3 shadow-md ring-1 ring-gray-950/5 dark:ring-white/10 rounded-xl">
            <h1 class="text-wrap">{{ str($bharPhyit->title)->limit(100, '...') }}</h1>
            <p>Last occured : {{ $bharPhyit->last_occurred_at->dtString() }}</p>
            <span>Occurrences : {{ $bharPhyit->occurrences }}</span>
        </a>
        @endforeach
    </div>

    <div class="pt-5">
        {{ $bharPhyits->links() }}
    </div>
</div>