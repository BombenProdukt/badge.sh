<?php

declare(strict_types=1);

namespace App\Badger\Calculator;

use App\Badger\Contracts\TextSizeCalculator;
use Illuminate\Support\Arr;

final class GDTextSizeCalculator implements TextSizeCalculator
{
    public function calculateWidth(string $text): float
    {
        $charWidthTable = \json_decode(\file_get_contents(resource_path('widths-verdana-110.json')), true, \JSON_THROW_ON_ERROR);
        $fallbackWidth = $charWidthTable[64];

        $total = 0;
        $charWidth = 0;
        $textLength = \mb_strlen($text);

        while ($textLength--) {
            $charWidth = Arr::get($charWidthTable, $this->charCodeAt($text, $textLength));
            $total += null === $charWidth ? $fallbackWidth : $charWidth;
        }

        return $total;
    }

    private function charCodeAt(string $string, int $offset): int
    {
        return \unpack('S', \mb_convert_encoding(\mb_substr($string, $offset, 1), 'UTF-16LE'))[1];
    }
}
