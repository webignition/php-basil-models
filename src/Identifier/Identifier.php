<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\ValueInterface;

class Identifier implements IdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $type = '';
    private $value = '';
    private $position = 1;
    private $name;

    /**
     * @var IdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(string $type, ValueInterface $value, int $position = null, string $name = null)
    {
        $position = $position ?? self::DEFAULT_POSITION;

        $this->type = $type;
        $this->value = $value;
        $this->position = $position;
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getParentIdentifier(): ?IdentifierInterface
    {
        return $this->parentIdentifier;
    }

    public function withParentIdentifier(IdentifierInterface $parentIdentifier): IdentifierInterface
    {
        $new = clone $this;
        $new->parentIdentifier = $parentIdentifier;

        return $new;
    }

    public function withName(string $name): IdentifierInterface
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    public function __toString(): string
    {
        $string = $this->value->getValue();

        if ($this->parentIdentifier instanceof IdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        if (in_array($this->type, [IdentifierTypes::CSS_SELECTOR, IdentifierTypes::XPATH_EXPRESSION])) {
            $string = '"' . $string . '"';
        }

        if (self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
