<?php

namespace webignition\BasilModel\Identifier;

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

    public function __toString(): string
    {
        $value = $this->value;

        if ($this->parentIdentifier instanceof IdentifierInterface) {
            $value = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $value;
        }

        $string = in_array($this->type, [IdentifierTypes::CSS_SELECTOR, IdentifierTypes::XPATH_EXPRESSION])
            ? '"' . $value . '"'
            : $value;

        if (self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
