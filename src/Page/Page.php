<?php

namespace webignition\BasilModel\Page;

use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

class Page implements PageInterface
{
    private $uri;
    private $identifierCollection;

    public function __construct(UriInterface $uri, IdentifierCollectionInterface $identifierCollection)
    {
        $this->uri = $uri;
        $this->identifierCollection = $identifierCollection;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function getIdentifierCollection(): IdentifierCollectionInterface
    {
        return $this->identifierCollection;
    }

    /**
     * @return string[]
     */
    public function getElementNames(): array
    {
        $names = [];

        /* @var IdentifierInterface $identifier */
        foreach ($this->identifierCollection as $identifier) {
            $name = $identifier->getName();

            if (null !== $name) {
                $names[] = $name;
            }
        }

        sort($names);

        return $names;
    }
}
