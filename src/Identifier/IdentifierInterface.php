<?php

declare(strict_types=1);

namespace webignition\BasilModel\Identifier;

interface IdentifierInterface
{
    public function getName(): ?string;
    public function withName(string $name): IdentifierInterface;
    public function __toString(): string;
}
