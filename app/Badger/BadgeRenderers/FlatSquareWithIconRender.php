<?php

declare(strict_types=1);

namespace App\Badger\BadgeRenderers;

final class FlatSquareWithIconRender extends AbstractRender
{
    public function getSupportedFormats(): array
    {
        return ['flat-square-with-icon'];
    }

    protected function getTemplate(): string
    {
        return 'flat-square-with-icon';
    }
}
