<?php

declare(strict_types=1);

namespace webignition\BasilModel\Page;

use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

interface PageInterface
{
    public function getUri(): UriInterface;

    public function getIdentifierCollection(): IdentifierCollectionInterface;

    public function getIdentifier(string $name): ?IdentifierInterface;

    /**
     * @return string[]
     */
    public function getElementNames(): array;
}
