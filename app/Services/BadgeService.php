<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Badge;

final class BadgeService
{
    /**
     * @var Badge[]
     */
    private array $badges = [];

    public function all(): array
    {
        return $this->badges;
    }

    public function add(string $badge): void
    {
        $this->badges[] = app($badge);
    }

    public function previews(): array
    {
        $result = [];

        foreach ($this->badges as $badge) {
            $result[$badge->service()] = [
                ...($result[$badge->service()] ?? []),
                ...$badge->previews(),
            ];
        }

        return $result;
    }
}
