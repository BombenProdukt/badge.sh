<?php

declare(strict_types=1);

namespace App\Badger\Render;

final class FlatSquareRender extends AbstractRender
{
    public function getSupportedFormats(): array
    {
        return ['flat-square'];
    }

    protected function getTemplate(): string
    {
        return 'flat-square';
    }
}
