<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Badge;

final class BadgeService
{
    /** @var Badge[] */
    private array $badges = [];

    public function all(): array
    {
        return $this->badges;
    }

    public function add(string $badge): void
    {
        $this->badges[] = app($badge);
    }

    public function staticPreviews(): array
    {
        return $this->previews('staticPreviews');
    }

    public function dynamicPreviews(): array
    {
        return $this->previews('dynamicPreviews');
    }

    public function previews(string $method): array
    {
        $result = [];

        foreach ($this->badges as $badge) {
            $result[$badge->service()] = [
                ...($result[$badge->service()] ?? []),
                ...$badge->{$method}(),
            ];
        }

        return $result;
    }
}
