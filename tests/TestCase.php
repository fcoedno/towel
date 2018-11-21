<?php

declare(strict_types=1);

namespace App\Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets full resource path
     *
     * @param string $resource
     * @return string
     */
    protected function getResource(string $resource): string
    {
        return sprintf('%s/Resources/%s', __DIR__, trim($resource, '/'));
    }
}