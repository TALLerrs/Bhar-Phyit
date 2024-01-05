<div class="md:col-span-10">
    <div class="grid md:grid-cols-2 gap-5">
        @foreach($bharPhyits as $bharPhyit)
        <a href="{{ route('bhar-phyit-detail', $bharPhyit) }}" wire:navigate class="p-4 flex flex-col gap-3 shadow-lg ring-[1px] ring-gray-800 border-2 rounded-md border-gray-600">
            <h1>{{ str($bharPhyit->title)->limit(100, '...') }}</h1>
            <p>Last occured : {{ $bharPhyit->last_occurred_at->dtString() }}</p>
            <span>Occurrences : {{ $bharPhyit->occurrences }}</span>
        </a>
        @endforeach
    </div>
    <div>
        {{ $bharPhyits->links() }}
    </div>
</div>