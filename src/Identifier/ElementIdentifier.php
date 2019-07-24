<?php

namespace webignition\BasilModel\Identifier;

class ElementIdentifier extends AbstractIdentifier implements ElementIdentifierInterface
{
    const DEFAULT_POSITION = 1;

    private $value = '';
    private $position = 1;

    /**
     * @var ElementIdentifierInterface
     */
    private $parentIdentifier;

    public function __construct(string $type, string $value, int $position = null, string $name = null)
    {
        parent::__construct($type, $name);

        $position = $position ?? self::DEFAULT_POSITION;

        $this->value = $value;
        $this->position = $position;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getPosition(): int
    {
        return $this->position;
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

    /**
     * @param string $name
     *
     * @return IdentifierInterface|ElementIdentifierInterface
     */
    public function withName(string $name): IdentifierInterface
    {
        return parent::withName($name);
    }

    public function __toString(): string
    {
        $string = $this->value;

        if ($this->parentIdentifier instanceof ElementIdentifierInterface) {
            $string = '{{ ' . $this->parentIdentifier->getName() . ' }} ' . $string;
        }

        if (in_array($this->getType(), [IdentifierTypes::CSS_SELECTOR, IdentifierTypes::XPATH_EXPRESSION])) {
            $string = '"' . $string . '"';
        }

        if (self::DEFAULT_POSITION !== $this->position) {
            $string .= ':' . $this->position;
        }

        return $string;
    }
}
