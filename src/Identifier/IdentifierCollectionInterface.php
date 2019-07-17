<?php

namespace webignition\BasilModel\Identifier;

interface IdentifierCollectionInterface extends \Iterator
{
    public function getIdentifier(string $name): ?IdentifierInterface;
}
