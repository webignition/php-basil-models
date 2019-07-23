<?php

namespace webignition\BasilModel\Value;

class ValueTypes
{
    // LiteralValue
    const STRING = 'string';

    // ObjectValue
    const DATA_PARAMETER = 'data-parameter';
    const PAGE_OBJECT_PROPERTY = 'page-object-property';
    const BROWSER_OBJECT_PROPERTY = 'browser-object-property';
    const ELEMENT_PARAMETER = 'element-parameter';
    const PAGE_ELEMENT_REFERENCE = 'page-element-reference';

    // EnvironmentValue
    const ENVIRONMENT_PARAMETER = 'environment-parameter';

    // ElementValue
    const ELEMENT_IDENTIFIER = 'element-identifier';


    const ALL = [
        self::DATA_PARAMETER,
        self::STRING,
        self::ELEMENT_PARAMETER,
        self::PAGE_OBJECT_PROPERTY,
        self::BROWSER_OBJECT_PROPERTY,
        self::PAGE_ELEMENT_REFERENCE,
        self::ENVIRONMENT_PARAMETER,
        self::ELEMENT_IDENTIFIER,
    ];

    const ACTIONABLE_TYPES = [
        self::DATA_PARAMETER,
        self::STRING,
        self::ELEMENT_PARAMETER,
        self::PAGE_OBJECT_PROPERTY,
        self::BROWSER_OBJECT_PROPERTY,
        self::ENVIRONMENT_PARAMETER,
        self::ELEMENT_IDENTIFIER,
    ];
}
