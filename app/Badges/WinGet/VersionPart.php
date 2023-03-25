<?php

declare(strict_types=1);

namespace App\Badges\WinGet;

final class VersionPart
{
    private string $_source;
    private int $_number;
    private string $_other;

    public function __construct(string $input)
    {
        $this->_source = $input;

        \preg_match('/(\d+)(\D*)/', $input, $matches);
        $this->_number = (int) ($matches[1]) ?: 0;
        $this->_other = $matches[2];
    }

    public function __toString(): string
    {
        return $this->_source;
    }

    public function getNumber(): int
    {
        return $this->_number;
    }

    public function getOther(): string
    {
        return $this->_other;
    }

    public static function comparator(self $partA, self $partB): int
    {
        if ($partA->getNumber() < $partB->getNumber()) {
            return -1;
        }

        if ($partA->getNumber() > $partB->getNumber()) {
            return 1;
        }

        if ($partA->getOther() < $partB->getOther()) {
            return -1;
        }

        if ($partA->getOther() > $partB->getOther()) {
            return 1;
        }

        return 0;
    }
}
