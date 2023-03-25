<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use PreemStudio\Badger\Badger;

final class BadgeComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private readonly array $code)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        try {
            return Badger::from($this->code)->render();
        } catch (\Throwable $th) {
            dd($this->code, $th);
        }
    }
}
