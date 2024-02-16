<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Tallerrs\BharPhyit\Http\Livewire\Permission\CanAccessBharPhyit;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

#[Layout('bhar-phyit::dashboard')]
class BharPhyit extends Component
{
    use WithPagination;
    use CanAccessBharPhyit;

    public $search = "";

    #[Title('Bhar Phyit')]
    public function mount()
    {
        // $this->authorizeAccess();
    }

    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit', [
            'bharPhyits' => BharPhyitErrorLog::query()
                ->select('id', 'title', 'status', 'last_occurred_at', 'url', 'occurrences')
                ->when($this->search != "", function (Builder $query) {
                    $query->where('title', 'LIKE', "%{$this->search}%");
                })
                ->orderBy('last_occurred_at')
                ->paginate(),
        ]);
    }
}
