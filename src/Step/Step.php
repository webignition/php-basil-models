<?php

namespace webignition\BasilModel\Step;

use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModel\Assertion\AssertionInterface;
use webignition\BasilModel\DataSet\DataSetCollection;
use webignition\BasilModel\DataSet\DataSetCollectionInterface;
use webignition\BasilModel\Identifier\IdentifierInterface;

class Step implements StepInterface
{
    /**
     * @var ActionInterface[]
     */
    private $actions = [];

    /**
     * @var AssertionInterface[]
     */
    private $assertions = [];

    /**
     * @var DataSetCollectionInterface
     */
    private $dataSetCollection;

    /**
     * @var IdentifierInterface[]
     */
    private $elementIdentifiers = [];

    public function __construct(array $actions, array $assertions)
    {
        $this->setActions($actions);
        $this->setAssertions($assertions);

        $this->dataSetCollection = new DataSetCollection();
    }

    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @return AssertionInterface[]
     */
    public function getAssertions(): array
    {
        return $this->assertions;
    }

    public function getDataSetCollection(): DataSetCollectionInterface
    {
        return $this->dataSetCollection;
    }

    /**
     * @return IdentifierInterface[]
     */
    public function getElementIdentifiers(): array
    {
        return $this->elementIdentifiers;
    }

    /**
     * @param DataSetCollectionInterface $dataSetCollection
     *
     * @return StepInterface
     */
    public function withDataSetCollection(DataSetCollectionInterface $dataSetCollection): StepInterface
    {
        $new = clone $this;
        $new->dataSetCollection = $dataSetCollection;

        return $new;
    }

    /**
     * @param IdentifierInterface[] $elementIdentifiers
     *
     * @return StepInterface
     */
    public function withElementIdentifiers(array $elementIdentifiers): StepInterface
    {
        $filteredElementIdentifiers = [];

        foreach ($elementIdentifiers as $elementName => $identifier) {
            if ($identifier instanceof IdentifierInterface) {
                $filteredElementIdentifiers[$elementName] = $identifier;
            }
        }

        $new = clone $this;
        $new->elementIdentifiers = $filteredElementIdentifiers;

        return $new;
    }

    public function withPrependedActions(array $actions): StepInterface
    {
        foreach ($this->getActions() as $action) {
            $actions[] = clone $action;
        }

        $new = clone $this;
        $new->actions = $actions;

        return $new;
    }

    public function withPrependedAssertions(array $assertions): StepInterface
    {
        foreach ($this->getAssertions() as $assertion) {
            $assertions[] = clone $assertion;
        }

        $new = clone $this;
        $new->assertions = $assertions;

        return $new;
    }

    /**
     * @param ActionInterface[] $actions
     *
     * @return StepInterface
     */
    public function withActions(array $actions): StepInterface
    {
        $new = clone $this;
        $new->setActions($actions);

        return $new;
    }

    /**
     * @param AssertionInterface[] $assertions
     *
     * @return StepInterface
     */
    public function withAssertions(array $assertions): StepInterface
    {
        $new = clone $this;
        $new->setAssertions($assertions);

        return $new;
    }

    private function setActions(array $actions)
    {
        $this->actions = [];

        foreach ($actions as $action) {
            if ($action instanceof ActionInterface) {
                $this->actions[] = $action;
            }
        }
    }

    private function setAssertions(array $assertions)
    {
        $this->assertions = [];

        foreach ($assertions as $assertion) {
            if ($assertion instanceof AssertionInterface) {
                $this->assertions[] = $assertion;
            }
        }
    }
}
