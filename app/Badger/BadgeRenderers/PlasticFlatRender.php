<?php

declare(strict_types=1);

namespace App\Badger\BadgeRenderers;

final class PlasticFlatRender extends AbstractRender
{
    public function getSupportedFormats(): array
    {
        return ['plastic-flat'];
    }

    protected function getTemplate(): string
    {
        return 'plastic-flat';
    }
}
