<?php

namespace webignition\BasilModel\Value;

class ValueTypes
{
    const DATA_PARAMETER = 'data-parameter';
    const STRING = 'string';
    const ELEMENT_PARAMETER = 'element-parameter';
    const PAGE_OBJECT_PROPERTY = 'page-object-property';
    const BROWSER_OBJECT_PROPERTY = 'browser-object-property';
    const PAGE_MODEL_REFERENCE = 'page-model-reference';

    const ALL = [
        self::DATA_PARAMETER,
        self::STRING,
        self::ELEMENT_PARAMETER,
        self::PAGE_OBJECT_PROPERTY,
        self::BROWSER_OBJECT_PROPERTY,
        self::PAGE_MODEL_REFERENCE,
    ];

    const ACTIONABLE_TYPES = [
        self::DATA_PARAMETER,
        self::STRING,
        self::ELEMENT_PARAMETER,
        self::PAGE_OBJECT_PROPERTY,
        self::BROWSER_OBJECT_PROPERTY,
    ];
}
