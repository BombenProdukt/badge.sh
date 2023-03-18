<?php

declare(strict_types=1);

namespace App\Badges\WinGet;

final class Version
{
    private string $_source;

    private array $_parts;

    public function __construct(string $input)
    {
        $this->_source = $input;

        $parts = array_map(function ($segment) {
            return new VersionPart($segment);
        }, explode('.', $input));

        while (count($parts) > 0) {
            $part = end($parts);
            if ($part->getNumber() || $part->getOther()) {
                break;
            }
            array_pop($parts);
        }

        $this->_parts = $parts;
    }

    public function getParts(): array
    {
        return $this->_parts;
    }

    public function toString(): string
    {
        return $this->_source;
    }

    public static function comparator(Version $versionA, Version $versionB): int
    {
        $i = 0;
        while ($i < count($versionA->getParts())) {
            if ($i >= count($versionB->getParts())) {
                break;
            }

            $partA  = $versionA->getParts()[$i];
            $partB  = $versionB->getParts()[$i];
            $result = VersionPart::comparator($partA, $partB);
            if ($result) {
                return $result;
            }

            $i++;
        }

        if (count($versionA->getParts()) < count($versionB->getParts())) {
            return -1;
        }
        if (count($versionA->getParts()) > count($versionB->getParts())) {
            return 1;
        }

        return 0;
    }
}
