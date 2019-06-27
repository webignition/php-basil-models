<?php

namespace webignition\BasilModel\Page;

use Psr\Http\Message\UriInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

class Page implements PageInterface
{
    private $uri;
    private $elements = [];

    public function __construct(UriInterface $uri, array $elementIdentifiers)
    {
        $this->uri = $uri;

        foreach ($elementIdentifiers as $elementName => $elementIdentifier) {
            if ($elementIdentifier instanceof IdentifierInterface) {
                $this->elements[$elementName] = $elementIdentifier;
            }
        }
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function getElementIdentifier(string $name): ?IdentifierInterface
    {
        return $this->elements[$name] ?? null;
    }

    /**
     * @return string[]
     */
    public function getElementNames(): array
    {
        $keys = [];

        foreach (array_keys($this->elements) as $key) {
            $keys[] = (string) $key;
        }

        return $keys;
    }
}
