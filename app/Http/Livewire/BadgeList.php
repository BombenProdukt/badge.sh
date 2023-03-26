<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use BackedEnum;
use Livewire\Component;

final class BadgeList extends Component
{
    public ?string $query = '';

    public ?string $category = '';

    public function render()
    {
        $badges = collect(app('badge.service')->all());

        if ($this->query) {
            $badges = $badges->filter(function ($badge) {
                $matchesService = \str_contains(\mb_strtolower($badge->service()), $this->query);
                $matchesTitle = \str_contains(\mb_strtolower($badge->title()), $this->query);
                $matchesKeyword = collect($badge->keywords())->contains(fn (BackedEnum $keyword) => \str_contains($keyword->value, $this->query));

                return $matchesService || $matchesTitle || $matchesKeyword;
            });
        }

        if ($this->category) {
            $badges = $badges->filter(function ($badge) {
                return collect($badge->keywords())->contains(fn (BackedEnum $keyword) => $keyword->value === $this->category);
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
