<?php

namespace webignition\BasilModel\Step;

use webignition\BasilModel\Action\ActionInterface;
use webignition\BasilModel\Assertion\AssertionInterface;
use webignition\BasilModel\DataSet\DataSetInterface;
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
     * @var DataSetInterface[]
     */
    private $dataSets = [];

    /**
     * @var IdentifierInterface[]
     */
    private $elementIdentifiers = [];

    public function __construct(array $actions, array $assertions)
    {
        foreach ($actions as $action) {
            if ($action instanceof ActionInterface) {
                $this->actions[] = $action;
            }
        }

        foreach ($assertions as $assertion) {
            if ($assertion instanceof AssertionInterface) {
                $this->assertions[] = $assertion;
            }
        }
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

    /**
     * @return DataSetInterface[]
     */
    public function getDataSets(): array
    {
        return $this->dataSets;
    }

    /**
     * @return IdentifierInterface[]
     */
    public function getElementIdentifiers(): array
    {
        return $this->elementIdentifiers;
    }

    /**
     * @param DataSetInterface[] $dataSets
     *
     * @return StepInterface
     */
    public function withDataSets(array $dataSets): StepInterface
    {
        $filteredDataSets = [];

        foreach ($dataSets as $name => $dataSet) {
            if ($dataSet instanceof DataSetInterface) {
                $filteredDataSets[$name] = $dataSet;
            }
        }

        $new = clone $this;
        $new->dataSets = $filteredDataSets;

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

    public function prependActionsFrom(StepInterface $step): StepInterface
    {
        $actions = [];
        foreach ($step->getActions() as $action) {
            $actions[] = clone $action;
        }

        foreach ($this->getActions() as $action) {
            $actions[] = clone $action;
        }

        $new = clone $this;
        $new->actions = $actions;

        return $new;
    }

    public function prependAssertionsFrom(StepInterface $step): StepInterface
    {
        $assertions = [];
        foreach ($step->getAssertions() as $assertion) {
            $assertions[] = clone $assertion;
        }

        foreach ($this->getAssertions() as $assertion) {
            $assertions[] = clone $assertion;
        }

        $new = clone $this;
        $new->assertions = $assertions;

        return $new;
    }
}
