<?php

declare(strict_types=1);

namespace App\Badger\Render;

use App\Badger\Badge;
use App\Badger\BadgeImage;

interface RenderInterface
{
    public function render(Badge $badge): BadgeImage;

    public function getSupportedFormats(): array;
}
