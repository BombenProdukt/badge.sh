<?php

declare(strict_types=1);

namespace App\Badger\BadgeRenderers;

final class SocialRender extends AbstractRender
{
    public function getSupportedFormats(): array
    {
        return ['social'];
    }

    protected function getTemplate(): string
    {
        return 'social';
    }
}
