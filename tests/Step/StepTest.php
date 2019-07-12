<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Step;

use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\DataSet\DataSet;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Step\Step;
use webignition\BasilModel\Step\StepInterface;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;

class StepTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(array $actions, array $assertions, array $expectedActions, array $expectedAssertions)
    {
        $step = new Step($actions, $assertions);

        $this->assertEquals($expectedActions, $step->getActions());
        $this->assertEquals($expectedAssertions, $step->getAssertions());
    }

    public function createDataProvider(): array
    {
        return [
            'no actions, no assertions' => [
                'actions' => [],
                'assertions' => [],
                'expectedActions' => [],
                'expectedAssertions' => [],
            ],
            'all non-actions, all non-assertions' => [
                'actions' => [
                    'foo',
                    'bar',
                ],
                'assertions' => [
                    1,
                    2,
                ],
                'expectedActions' => [],
                'expectedAssertions' => [],
            ],
            'has actions, has assertions, some not correct types' => [
                'actions' => [
                    'foo',
                    new WaitAction('wait 5', '5'),
                    'bar',
                ],
                'assertions' => [
                    1,
                    2,
                    new Assertion(
                        '".selector" is "foo"',
                        new Identifier(
                            IdentifierTypes::CSS_SELECTOR,
                            new Value(ValueTypes::STRING, '.selector')
                        ),
                        AssertionComparisons::IS
                    ),
                ],
                'expectedActions' => [
                    new WaitAction('wait 5', '5'),
                ],
                'expectedAssertions' => [
                    new Assertion(
                        '".selector" is "foo"',
                        new Identifier(
                            IdentifierTypes::CSS_SELECTOR,
                            new Value(ValueTypes::STRING, '.selector')
                        ),
                        AssertionComparisons::IS
                    ),
                ],
            ],
        ];
    }

    /**
     * @dataProvider withDataSetsDataProvider
     */
    public function testWithDataSets(
        StepInterface $step,
        array $dataSets,
        array $expectedDataSets
    ) {
        $currentDataSets = $step->getDataSets();

        $mutatedStep = $step->withDataSets($dataSets);

        $this->assertNotSame($mutatedStep, $step);
        $this->assertEquals($expectedDataSets, $mutatedStep->getDataSets());
        $this->assertSame($currentDataSets, $step->getDataSets());
    }

    public function withDataSetsDataProvider(): array
    {
        return [
            'no existing data sets, empty data sets' => [
                'step' => new Step([], []),
                'dataSets' => [],
                'expectedDataSets' => [],
            ],
            'no existing data sets, non-empty data sets' => [
                'step' => new Step([], []),
                'dataSets' => [
                    'one' => 1,
                    'two' => 'two',
                    'three' => new DataSet([]),
                ],
                'expectedDataSets' => [
                    'three' => new DataSet([]),
                ],
            ],
            'has existing data sets, empty data sets' => [
                'step' => (new Step([], []))->withDataSets([
                    'one' => new DataSet([]),
                ]),
                'dataSets' => [],
                'expectedDataSets' => [],
            ],
            'has existing data sets, non-empty data sets' => [
                'step' => (new Step([], []))->withDataSets([
                    'one' => new DataSet([]),
                ]),
                'dataSets' => [
                    'two' => new DataSet([]),
                ],
                'expectedDataSets' => [
                    'two' => new DataSet([]),
                ],
            ],
        ];
    }

    /**
     * @dataProvider withElementIdentifiersDataProvider
     */
    public function testWithElementIdentifiers(
        StepInterface $step,
        array $elementIdentifiers,
        array $expectedElementIdentifiers
    ) {
        $currentElementIdentifiers = $step->getElementIdentifiers();

        $mutatedStep = $step->withElementIdentifiers($elementIdentifiers);

        $this->assertNotSame($mutatedStep, $step);
        $this->assertEquals($expectedElementIdentifiers, $mutatedStep->getElementIdentifiers());
        $this->assertSame($currentElementIdentifiers, $step->getElementIdentifiers());
    }

    public function withElementIdentifiersDataProvider(): array
    {
        return [
            'no existing element references, empty element references' => [
                'step' => new Step([], []),
                'elementIdentifiers' => [],
                'expectedElementIdentifiers' => [],
            ],
            'no existing element references, non-empty element references' => [
                'step' => new Step([], []),
                'elementIdentifiers' => [
                    'input' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.input')
                    ),
                ],
                'expectedElementIdentifiers' => [
                    'input' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.input')
                    ),
                ],
            ],
            'has existing element references, empty element references' => [
                'step' => (new Step([], []))->withElementIdentifiers([
                    'input' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.input')
                    ),
                ]),
                'elementIdentifiers' => [],
                'expectedElementIdentifiers' => [],
            ],
            'has existing element references, non-empty element references' => [
                'step' => (new Step([], []))->withElementIdentifiers([
                    'input' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.input')
                    ),
                ]),
                'elementIdentifiers' => [
                    'button' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.button')
                    ),
                ],
                'expectedElementIdentifiers' => [
                    'button' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(ValueTypes::STRING, '.button')
                    ),
                ],
            ],
        ];
    }

    /**
     * @dataProvider withPrependedActionsDataProvider
     */
    public function testWithPrependedActions(StepInterface $step, array $actions, StepInterface $expectedStep)
    {
        $mutatedStep = $step->withPrependedActions($actions);

        $this->assertEquals($expectedStep, $mutatedStep);
    }

    public function withPrependedActionsDataProvider(): array
    {
        return [
            'step has no actions, empty prepended actions' => [
                'step' => new Step([], []),
                'actions' => [],
                'expectedStep' => new Step([], []),
            ],
            'step has actions, empty prepended actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
                'actions' => [],
                'expectedStep' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
            ],
            'step has no actions, non-empty prepended actions' => [
                'step' => new Step([], []),
                'actions' => [
                    new WaitAction('wait 2', '2'),
                ],
                'expectedStep' => new Step([
                    new WaitAction('wait 2', '2'),
                ], []),
            ],
            'step has actions, non-empty prepended actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
                'actions' => [
                    new WaitAction('wait 2', '2'),
                ],
                'expectedStep' => new Step([
                    new WaitAction('wait 2', '2'),
                    new WaitAction('wait 1', '1'),
                ], []),
            ],
            'step assertions are retained' => [
                'step' => new Step([], [
                    new Assertion('".selector1" exists', null, null),
                ]),
                'actions' => [],
                'expectedStep' => new Step([], [
                    new Assertion('".selector1" exists', null, null),
                ]),
            ],
            'step data sets are retained' => [
                'step' => (new Step([], []))->withDataSets([
                    new DataSet([
                        'field1' => 'value1',
                    ])
                ]),
                'actions' => [],
                'expectedStep' => (new Step([], []))->withDataSets([
                    new DataSet([
                        'field1' => 'value1',
                    ])
                ]),
            ],
            'step element identifiers are retained, parent element identifiers are not' => [
                'step' => (new Step([], []))->withElementIdentifiers([
                    'heading1' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(
                            ValueTypes::STRING,
                            '.heading1'
                        )
                    )
                ]),
                'actions' => [],
                'expectedStep' => (new Step([], []))->withElementIdentifiers([
                    'heading1' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(
                            ValueTypes::STRING,
                            '.heading1'
                        )
                    )
                ]),
            ],
        ];
    }

    /**
     * @dataProvider withPrependedAssertionsDataProvider
     */
    public function testWithPrependedAssertions(StepInterface $step, array $assertions, StepInterface $expectedStep)
    {
        $mutatedStep = $step->withPrependedAssertions($assertions);

        $this->assertEquals($expectedStep, $mutatedStep);
    }

    public function withPrependedAssertionsDataProvider(): array
    {
        return [
            'step has no assertions, empty prepended assertions' => [
                'step' => new Step([], []),
                'assertions' => [],
                'expectedStep' => new Step([], []),
            ],
            'step has assertions, empty prepended assertions' => [
                'step' => new Step([], [
                    new Assertion('".selector" exists', null, null),
                ]),
                'assertions' => [],
                'expectedStep' => new Step([], [
                    new Assertion('".selector" exists', null, null),
                ]),
            ],
            'step has no assertions, non-empty prepended assertions' => [
                'step' => new Step([], []),
                'assertions' => [
                    new Assertion('".selector" exists', null, null),
                ],
                'expectedStep' => new Step([], [
                    new Assertion('".selector" exists', null, null),
                ]),
            ],
            'step has assertions, non-empty prepended assertions' => [
                'step' => new Step([], [
                    new Assertion('".selector1" exists', null, null),
                ]),
                'assertions' => [
                    new Assertion('".selector2" exists', null, null),
                ],
                'expectedStep' => new Step([], [
                    new Assertion('".selector2" exists', null, null),
                    new Assertion('".selector1" exists', null, null),
                ]),
            ],
            'step actions are retained' => [
                'step' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
                'assertions' => [],
                'expectedStep' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
            ],
            'step data sets are retained, parent data sets are not' => [
                'step' => (new Step([], []))->withDataSets([
                    new DataSet([
                        'field1' => 'value1',
                    ])
                ]),
                'assertions' => [],
                'expectedStep' => (new Step([], []))->withDataSets([
                    new DataSet([
                        'field1' => 'value1',
                    ])
                ]),
            ],
            'step element identifiers are retained, parent element identifiers are not' => [
                'step' => (new Step([], []))->withElementIdentifiers([
                    'heading1' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(
                            ValueTypes::STRING,
                            '.heading1'
                        )
                    )
                ]),
                'assertions' => [],
                'expectedStep' => (new Step([], []))->withElementIdentifiers([
                    'heading1' => new Identifier(
                        IdentifierTypes::CSS_SELECTOR,
                        new Value(
                            ValueTypes::STRING,
                            '.heading1'
                        )
                    )
                ]),
            ],
        ];
    }

    /**
     * @dataProvider withActionsDataProvider
     */
    public function testWithActions(StepInterface $step, array $actions)
    {
        $mutatedStep = $step->withActions($actions);

        $this->assertNotSame($step, $mutatedStep);
        $this->assertSame($actions, $mutatedStep->getActions());
    }

    public function withActionsDataProvider(): array
    {
        return [
            'no initial actions, no actions' => [
                'step' => new Step([], []),
                'actions' => [],
            ],
            'has initial actions, no actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
                'actions' => [],
            ],
            'no initial actions, has actions' => [
                'step' => new Step([], []),
                'actions' => [
                    new WaitAction('wait 1', '1'),
                ],
            ],
            'has initial actions, has actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', '1'),
                ], []),
                'actions' => [
                    new WaitAction('wait 2', '2'),
                ],
            ],
        ];
    }

    /**
     * @dataProvider withAssertionsDataProvider
     */
    public function testWithAssertions(StepInterface $step, array $assertions)
    {
        $mutatedStep = $step->withAssertions($assertions);

        $this->assertNotSame($step, $mutatedStep);
        $this->assertSame($assertions, $mutatedStep->getAssertions());
    }

    public function withAssertionsDataProvider(): array
    {
        return [
            'no initial assertions, no assertions' => [
                'step' => new Step([], []),
                'assertions' => [],
            ],
            'has initial assertions, no assertions' => [
                'step' => new Step([], [
                    new Assertion('".selector" exists', null, null),
                ]),
                'assertions' => [],
            ],
            'no initial assertions, has assertions' => [
                'step' => new Step([], []),
                'assertions' => [
                    new Assertion('".selector" exists', null, null),
                ],
            ],
            'has initial assertions, has assertions' => [
                'step' => new Step([], [
                    new Assertion('".selector1" exists', null, null),
                ]),
                'assertions' => [
                    new Assertion('".selector2" exists', null, null),
                ],
            ],
        ];
    }
}
