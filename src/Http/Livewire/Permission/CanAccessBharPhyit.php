<?php

namespace Tallerrs\BharPhyit\Http\Livewire\Permission;

trait CanAccessBharPhyit
{
    public function authorizeAccess(): void
    {
        abort_if(!auth()->user(), 403);
    }
}
