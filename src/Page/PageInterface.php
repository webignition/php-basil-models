<?php

namespace webignition\BasilModel\Page;

use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

interface PageInterface
{
    public function getUri(): UriInterface;

    /**
     * @return string[]
     */
    public function getElementNames(): array;
}
