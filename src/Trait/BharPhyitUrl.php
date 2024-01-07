<?php

namespace Tallerrs\BharPhyit\Trait;

trait BharPhyitUrl
{
    protected function getBaseUrl(): string
    {
        return config('app.url');
    }
    
    protected function getBharPyitBaseUrl(): string
    {
        return $this->getBaseUrl()."/".config('bhar-phyit.url');
    }

    protected function getBharPyitDetailUrl(string $bharPhyitDetailId): string
    {
        return $this->getBharPyitBaseUrl() . "/detail/" . $bharPhyitDetailId;
    }
}