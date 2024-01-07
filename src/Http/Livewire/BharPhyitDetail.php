<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

#[Layout('bhar-phyit::components.layouts.app')]
class BharPhyitDetail extends Component
{
    public BharPhyitErrorLog $bharPhyitErrorLog;

    #[Title('Bhar Phyit Detail')]
    public function mount(string $id)
    {
        $this->bharPhyitErrorLog = BharPhyitErrorLog::findOrFail($id);
    }

    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit-detail');
    }
}
