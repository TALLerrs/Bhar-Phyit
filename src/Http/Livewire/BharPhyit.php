<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('bhar-phyit::components.layouts.app')]
class BharPhyit extends Component
{
    #[Title('Bhar Phyit')]
    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit');
    }
}
