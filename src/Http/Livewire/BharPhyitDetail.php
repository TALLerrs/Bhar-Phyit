<?php

namespace Tallerrs\BharPhyit\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Tallerrs\BharPhyit\Enums\BharPhyitErrorLogStatus;
use Tallerrs\BharPhyit\Http\Livewire\Permission\CanAccessBharPhyit;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Trait\BharPhyitAction;

#[Layout('bhar-phyit::dashboard')]
class BharPhyitDetail extends Component
{
    use CanAccessBharPhyit;
    use BharPhyitAction;

    public ?User $user;
    public string $appName;

    public string $id;

    #[Title('Bhar Phyit Detail')]
    public function mount(string $id)
    {
        $this->id = $id;
        
        $this->authorizeAccess();

        $this->appName = config('app.name');
    }

    public function render()
    {
        $bharPhyitErrorLog = BharPhyitErrorLog::query()->with('detail')->findOrFail($this->id);

        $user = $bharPhyitErrorLog->detail->user;

        return view('bhar-phyit::livewire.bhar-phyit-detail', [
            'bharPhyitErrorLog' => $bharPhyitErrorLog,
            'user' => $user,
        ]);
    }
}
