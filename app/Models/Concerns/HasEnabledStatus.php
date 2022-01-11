<?php
namespace App\Models\Concerns;

trait HasEnabledStatus{
    
    public function isEnabled(): bool
    {
        return ! (bool) $this->isDisabled();
    }

    public function isDisabled(): bool
    {
        return  (bool) $this->disabled_at;
    }

}
