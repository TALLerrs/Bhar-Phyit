<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Tallerrs\BharPhyit\Http\Livewire\Permission\CanAccessBharPhyit;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

#[Layout('bhar-phyit::components.layouts.app')]
class BharPhyitDetail extends Component
{
    use CanAccessBharPhyit;

    public BharPhyitErrorLog $bharPhyitErrorLog;
    public User $user;

    #[Title('Bhar Phyit Detail')]
    public function mount(string $id)
    {
        $this->authorizeAccess();

        $this->bharPhyitErrorLog = BharPhyitErrorLog::query()->with('detail')->findOrFail($id);

        $this->user = $this->bharPhyitErrorLog->detail->user;
    }

    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit-detail');
    }
}
