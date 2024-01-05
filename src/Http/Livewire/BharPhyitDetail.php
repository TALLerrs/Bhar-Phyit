<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('bhar-phyit::components.layouts.app')]
class BharPhyitDetail extends Component
{
    #[Title('Bhar Phyit Detail')]
    public function render()
    {
        return view('bhar-phyit::livewire.bhar-phyit-detail');
    }
}
