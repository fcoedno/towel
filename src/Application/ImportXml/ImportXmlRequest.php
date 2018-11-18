<?php

declare(strict_types=1);

namespace Towel\Application\ImportXml;

class ImportXmlRequest
{
    /**
     * @var string
     */
    private $xmlPath;

    public function __construct(string $xmlPath)
    {
        $this->xmlPath = $xmlPath;
    }
}