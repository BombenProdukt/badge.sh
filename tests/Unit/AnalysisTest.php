<?php

declare(strict_types=1);

namespace Tests\Unit;

use GrahamCampbell\Analyzer\AnalysisTrait;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class AnalysisTest extends TestCase
{
    use AnalysisTrait;

    protected static function getPaths(): array
    {
        return [
            \realpath(__DIR__.'/../../app'),
        ];
    }
}
