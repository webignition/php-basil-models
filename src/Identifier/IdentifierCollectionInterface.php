<?php

namespace webignition\BasilModel\Identifier;

interface IdentifierCollectionInterface
{
    public function getIdentifier(string $name): ?IdentifierInterface;
}
