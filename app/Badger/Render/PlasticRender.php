<?php

declare(strict_types=1);

namespace App\Badger\Render;

final class PlasticRender extends AbstractRender
{
    public function getSupportedFormats(): array
    {
        return ['plastic'];
    }

    protected function getTemplate(): string
    {
        return 'plastic';
    }
}
