<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Tallerrs\BharPhyit\Http\Livewire\Permission\CanAccessBharPhyit;
use Tallerrs\BharPhyit\Trait\BharPhyitAction;

#[Layout('bhar-phyit::dashboard')]
class BharPhyit extends Component
{
    use WithPagination;
    use CanAccessBharPhyit;
    use BharPhyitAction;

    public $search = "";
    public $filterOption = "unsolved";

    #[Title('Bhar Phyit')]
    public function mount()
    {
        // $this->authorizeAccess();
    }

    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit', [
            'bharPhyits' => BharPhyitErrorLog::query()
                ->select('id', 'title', 'status', 'last_occurred_at', 'url', 'occurrences','resolved_at','status','snooze_until')
                ->when($this->search != "", function (Builder $query) {
                    $query->where('title', 'LIKE', "%{$this->search}%");
                })
                ->when($this->filterOption == "unsolved",
                    fn($query) => $query
                    ->whereNull('resolved_at')
                    ->where(fn($q) => $q->where(
                        fn($q) => $q->whereNull('snooze_until')
                        ->orWhere('snooze_until','<=',now())
                        )
                    )
                )
                ->when($this->filterOption == "solved",fn($query) => $query->whereNotNull('resolved_at'))
                ->when($this->filterOption == "snoozed",fn($query) => $query->where('snooze_until','>=',now()))
                ->orderBy('last_occurred_at')
                ->paginate(),
        ]);
    }
}
