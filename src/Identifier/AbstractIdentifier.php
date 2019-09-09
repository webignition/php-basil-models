<?php

namespace webignition\BasilModel\Identifier;

abstract class AbstractIdentifier implements IdentifierInterface
{
    private $name;
    private $type = '';

    public function __construct(string $type)
    {
        $this->type = $type;
    }

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

    public function getType(): string
    {
        return $this->type;
    }
}
