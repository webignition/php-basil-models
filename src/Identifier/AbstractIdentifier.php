<?php

namespace webignition\BasilModel\Identifier;

abstract class AbstractIdentifier implements IdentifierInterface
{
    private $type = '';
    private $name;

    public function __construct(string $type, string $name = null)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
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
}
