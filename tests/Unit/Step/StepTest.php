<?php

/** @noinspection PhpUnhandledExceptionInspection */

/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Step;

use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\DataSet\DataSet;
use webignition\BasilModel\DataSet\DataSetCollection;
use webignition\BasilModel\Identifier\IdentifierCollection;
use webignition\BasilModel\Identifier\IdentifierCollectionInterface;
use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Step\Step;
use webignition\BasilModel\Step\StepInterface;
use webignition\BasilModel\Value\DomIdentifierValue;
use webignition\BasilModel\Value\LiteralValue;

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
        $assertion = new ExaminationAssertion(
            '".selector" exists',
            DomIdentifierValue::create('.selector'),
            AssertionComparison::EXISTS
        );

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
                    new WaitAction('wait 5', new LiteralValue('5')),
                    'bar',
                ],
                'assertions' => [
                    1,
                    2,
                    $assertion,
                ],
                'expectedActions' => [
                    new WaitAction('wait 5', new LiteralValue('5')),
                ],
                'expectedAssertions' => [
                    $assertion,
                ],
            ],
        ];
    }

    public function testWithDataSetCollection()
    {
        $step = new Step([], []);

        $this->assertEquals(new DataSetCollection(), $step->getDataSetCollection());

        $dataSetCollection = new DataSetCollection([
            new DataSet(
                '0',
                [
                    'foo' => 'bar',
                ]
            )
        ]);

        $step = $step->withDataSetCollection($dataSetCollection);

        $this->assertSame($dataSetCollection, $step->getDataSetCollection());
    }

    /**
     * @dataProvider withIdentifierCollectionDataProvider
     */
    public function testWithIdentifierCollection(
        StepInterface $step,
        IdentifierCollectionInterface $identifierCollection,
        IdentifierCollectionInterface $expectedIdentifierCollection
    ) {
        $currentIdentifierCollection = $step->getIdentifierCollection();

        $mutatedStep = $step->withIdentifierCollection($identifierCollection);

        $this->assertNotSame($mutatedStep, $step);
        $this->assertEquals($expectedIdentifierCollection, $mutatedStep->getIdentifierCollection());
        $this->assertSame($currentIdentifierCollection, $step->getIdentifierCollection());
    }

    public function withIdentifierCollectionDataProvider(): array
    {
        return [
            'no existing identifier collection, empty identifier collection' => [
                'step' => new Step([], []),
                'identifierCollection' => new IdentifierCollection(),
                'expectedIdentifierCollection' => new IdentifierCollection(),
            ],
            'no existing identifier collection, non-empty identifier collection' => [
                'step' => new Step([], []),
                'identifierCollection' => new IdentifierCollection([
                    'input' => new DomIdentifier('.input'),
                ]),
                'expectedIdentifierCollection' => new IdentifierCollection([
                    'input' => new DomIdentifier('.input'),
                ]),
            ],
            'has existing identifier collection, empty identifier collection' => [
                'step' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'input' => new DomIdentifier('.input'),
                ])),
                'identifierCollection' => new IdentifierCollection(),
                'expectedIdentifierCollection' => new IdentifierCollection(),
            ],
            'has existing identifier collection, non-empty identifier collection' => [
                'step' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'input' => new DomIdentifier('.input'),
                ])),
                'identifierCollection' => new IdentifierCollection([
                    'button' => new DomIdentifier('.button'),
                ]),
                'expectedIdentifierCollection' => new IdentifierCollection([
                    'button' => new DomIdentifier('.button'),
                ]),
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
        $assertion = new ExaminationAssertion(
            '".selector" exists',
            DomIdentifierValue::create('.selector'),
            AssertionComparison::EXISTS
        );

        return [
            'step has no actions, empty prepended actions' => [
                'step' => new Step([], []),
                'actions' => [],
                'expectedStep' => new Step([], []),
            ],
            'step has actions, empty prepended actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
                'actions' => [],
                'expectedStep' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
            ],
            'step has no actions, non-empty prepended actions' => [
                'step' => new Step([], []),
                'actions' => [
                    new WaitAction('wait 2', new LiteralValue('2')),
                ],
                'expectedStep' => new Step([
                    new WaitAction('wait 2', new LiteralValue('2')),
                ], []),
            ],
            'step has actions, non-empty prepended actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
                'actions' => [
                    new WaitAction('wait 2', new LiteralValue('2')),
                ],
                'expectedStep' => new Step([
                    new WaitAction('wait 2', new LiteralValue('2')),
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
            ],
            'step assertions are retained' => [
                'step' => new Step([], [
                    $assertion,
                ]),
                'actions' => [],
                'expectedStep' => new Step([], [
                    $assertion,
                ]),
            ],
            'step data sets are retained' => [
                'step' => (new Step([], []))->withDataSetCollection(new DataSetCollection([
                    new DataSet(
                        '0',
                        [
                            'field1' => 'value1',
                        ]
                    )
                ])),
                'actions' => [],
                'expectedStep' => (new Step([], []))->withDataSetCollection(new DataSetCollection([
                    new DataSet(
                        '0',
                        [
                            'field1' => 'value1',
                        ]
                    )
                ])),
            ],
            'step identifier collection is retained' => [
                'step' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'heading1' => new DomIdentifier('.heading1')
                ])),
                'actions' => [],
                'expectedStep' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'heading1' => new DomIdentifier('.heading1')
                ])),
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
        $assertion1 = new ExaminationAssertion(
            '".selector1" exists',
            DomIdentifierValue::create('.selector1'),
            AssertionComparison::EXISTS
        );

        $assertion2 = new ExaminationAssertion(
            '".selector2" exists',
            DomIdentifierValue::create('.selector2'),
            AssertionComparison::EXISTS
        );

        return [
            'step has no assertions, empty prepended assertions' => [
                'step' => new Step([], []),
                'assertions' => [],
                'expectedStep' => new Step([], []),
            ],
            'step has assertions, empty prepended assertions' => [
                'step' => new Step([], [
                    $assertion1,
                ]),
                'assertions' => [],
                'expectedStep' => new Step([], [
                    $assertion1,
                ]),
            ],
            'step has no assertions, non-empty prepended assertions' => [
                'step' => new Step([], []),
                'assertions' => [
                    $assertion1,
                ],
                'expectedStep' => new Step([], [
                    $assertion1,
                ]),
            ],
            'step has assertions, non-empty prepended assertions' => [
                'step' => new Step([], [
                    $assertion1,
                ]),
                'assertions' => [
                    $assertion2,
                ],
                'expectedStep' => new Step([], [
                    $assertion2,
                    $assertion1,
                ]),
            ],
            'step actions are retained' => [
                'step' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
                'assertions' => [],
                'expectedStep' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
            ],
            'step data sets are retained' => [
                'step' => (new Step([], []))->withDataSetCollection(new DataSetCollection([
                    new DataSet(
                        '0',
                        [
                            'field1' => 'value1',
                        ]
                    )
                ])),
                'assertions' => [],
                'expectedStep' => (new Step([], []))->withDataSetCollection(new DataSetCollection([
                    new DataSet(
                        '0',
                        [
                            'field1' => 'value1',
                        ]
                    )
                ])),
            ],
            'step identifier collection is retained' => [
                'step' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'heading1' => new DomIdentifier('.heading1')
                ])),
                'assertions' => [],
                'expectedStep' => (new Step([], []))->withIdentifierCollection(new IdentifierCollection([
                    'heading1' => new DomIdentifier('.heading1')
                ])),
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
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
                'actions' => [],
            ],
            'no initial actions, has actions' => [
                'step' => new Step([], []),
                'actions' => [
                    new WaitAction('wait 1', new LiteralValue('1')),
                ],
            ],
            'has initial actions, has actions' => [
                'step' => new Step([
                    new WaitAction('wait 1', new LiteralValue('1')),
                ], []),
                'actions' => [
                    new WaitAction('wait 2', new LiteralValue('2')),
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
        $assertion1 = new ExaminationAssertion(
            '".selector1" exists',
            DomIdentifierValue::create('.selector1'),
            AssertionComparison::EXISTS
        );

        $assertion2 = new ExaminationAssertion(
            '".selector2" exists',
            DomIdentifierValue::create('.selector2'),
            AssertionComparison::EXISTS
        );

        return [
            'no initial assertions, no assertions' => [
                'step' => new Step([], []),
                'assertions' => [],
            ],
            'has initial assertions, no assertions' => [
                'step' => new Step([], [
                    $assertion1,
                ]),
                'assertions' => [],
            ],
            'no initial assertions, has assertions' => [
                'step' => new Step([], []),
                'assertions' => [
                    $assertion1,
                ],
            ],
            'has initial assertions, has assertions' => [
                'step' => new Step([], [
                    $assertion1,
                ]),
                'assertions' => [
                    $assertion2,
                ],
            ],
        ];
    }
}
