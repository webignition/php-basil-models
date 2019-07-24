<?php

namespace webignition\BasilModel\Identifier;

use webignition\BasilModel\Value\LiteralValue;

class ElementIdentifier implements ElementIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $type = '';
    private $value = '';
    private $position = 1;
    private $name;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(string $type, string $value, int $position = null, string $name = null)
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

    public function getValue(): string
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

    public function getParentIdentifier(): ?ElementIdentifierInterface
    {
        return $this->parentIdentifier;
    }

    public function withParentIdentifier(ElementIdentifierInterface $parentIdentifier): ElementIdentifierInterface
    {
        $new = clone $this;
        $new->parentIdentifier = $parentIdentifier;

        return $new;
    }

    public function withName(string $name): ElementIdentifierInterface
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    public function __toString(): string
    {
        if ($this->value instanceof LiteralValue) {
            $string = $this->value->getValue();
        } else {
            $string = (string) $this->value;
        }

        if ($this->parentIdentifier instanceof ElementIdentifierInterface) {
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
