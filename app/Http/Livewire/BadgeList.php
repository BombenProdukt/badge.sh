<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use BackedEnum;
use Livewire\Component;

final class BadgeList extends Component
{
    public ?string $query = '';

    public function render()
    {
        $badges = collect(app('badge.service')->all());

        if ($this->query) {
            $badges = $badges->filter(function ($badge) {
                $matchesService = \mb_strtolower($badge->service()) === $this->query;
                $matchesTitle = \mb_strtolower($badge->title()) === $this->query;
                $matchesKeyword = collect($badge->keywords())->contains(fn (BackedEnum $keyword) => $keyword->value === $this->query);

                return $matchesService || $matchesTitle || $matchesKeyword;
            });
        }

        $previews = [];

        foreach ($badges as $badge) {
            $previews[$badge->service()] = [
                ...($previews[$badge->service()] ?? []),
                ...$badge->previews(),
            ];
        }

        return view('livewire.badge-list', [
            'previews' => $previews,
        ]);
    }
}
