<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

trait IdentifierNameTrait
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
