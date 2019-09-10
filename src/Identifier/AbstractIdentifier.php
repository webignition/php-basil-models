<?php

namespace webignition\BasilModel\Identifier;

abstract class AbstractIdentifier implements IdentifierInterface
{
    private $name;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withName(string $name): IdentifierInterface
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }
}
