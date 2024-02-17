<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Tallerrs\BharPhyit\Http\Livewire\Permission\CanAccessBharPhyit;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

#[Layout('bhar-phyit::dashboard')]
class BharPhyit extends Component
{
    use WithPagination;
    use CanAccessBharPhyit;

    public $search = "";
    public $filterOption = "unsolved";

    #[Title('Bhar Phyit')]
    public function mount()
    {
        // $this->authorizeAccess();
    }

    /**
     * Solve And Unsolve function for BharPhyitErrorLog 
     * 
     * @param array $bharPhyit Livewire component array
     * 
     * @return void
     */
    public function solve(array $bharPhyit): void
    {
        $errorLog = BharPhyitErrorLog::findOrFail($bharPhyit['id']);

        $errorLog->update([
            'resolved_at' => $errorLog->resolved_at ? null : now(),
            'status' => $errorLog->resolved_at ? BharPhyitErrorLogStatus::READ : BharPhyitErrorLogStatus::RESOLVED,
        ]);
    }

    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit', [
            'bharPhyits' => BharPhyitErrorLog::query()
                ->select('id', 'title', 'status', 'last_occurred_at', 'url', 'occurrences','resolved_at','status')
                ->when($this->search != "", function (Builder $query) {
                    $query->where('title', 'LIKE', "%{$this->search}%");
                })
                ->when($this->filterOption == "unsolved",fn($query) => $query->whereNull('resolved_at'))
                ->when($this->filterOption == "solved",fn($query) => $query->whereNotNull('resolved_at'))
                ->when($this->filterOption == "snoozed",fn($query) => $query->where('snooze_until','>=',now()))
                ->orderBy('last_occurred_at')
                ->paginate(),
        ]);
    }
}
