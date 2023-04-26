<?php

declare(strict_types=1);

namespace App\Badger\Contracts;

use App\Badger\Badge;
use App\Badger\BadgeImage;

interface BadgeRenderer
{
    public function render(Badge $badge): BadgeImage;

    public function getSupportedFormats(): array;
}
