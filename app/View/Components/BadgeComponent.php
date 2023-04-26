<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Data\BadgePreviewData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use BombenProdukt\Badger\Badger;

final class BadgeComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private readonly BadgePreviewData $badge)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->badge->deprecated) {
            return Badger::from([
                'label' => $this->badge->name,
                'message' => 'deprecated',
                'messageColor' => 'red.600',
            ])->render();
        }

        return Badger::from($this->badge->data)->render();
    }
}
