<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

#[Layout('bhar-phyit::components.layouts.app')]
class BharPhyit extends Component
{
    use WithPagination;

    #[Title('Bhar Phyit')]
    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit', [
            'bharPhyits' => BharPhyitErrorLog::query()
                ->select('id', 'title', 'status', 'last_occurred_at', 'url', 'occurrences')
                ->orderBy('last_occurred_at')
                ->paginate(20),
        ]);
    }
}
