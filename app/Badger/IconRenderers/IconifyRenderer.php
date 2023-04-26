<?php

declare(strict_types=1);

namespace App\Badger\IconRenderers;

use App\Badger\Contracts\IconRenderer;
use Iconify\IconsJSON\Finder;

final class IconifyRenderer implements IconRenderer
{
    public function render(string $name): string
    {
        [, $family, $icon] = \explode('-', $name, 3);

        $body = \json_decode(\file_get_contents(Finder::locate($family)), true, \JSON_THROW_ON_ERROR)['icons'][$icon]['body'];
        $body = \str_replace('fill="currentColor"', 'fill="#fff"', $body);

        return \base64_encode('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">'.$body.'</svg>');
    }

    public function matches(string $name): bool
    {
        return \str_starts_with($name, 'iconify');
    }
}
