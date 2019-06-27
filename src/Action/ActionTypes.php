<?php

namespace webignition\BasilModel\Action;

class ActionTypes
{
    const CLICK = 'click';
    const SET = 'set';
    const SUBMIT = 'submit';
    const WAIT = 'wait';
    const WAIT_FOR = 'wait-for';
    const BACK = 'back';
    const FORWARD = 'forward';
    const RELOAD = 'reload';

    const ALL = [
        self::CLICK,
        self::SET,
        self::SUBMIT,
        self::WAIT,
        self::WAIT_FOR,
        self::BACK,
        self::FORWARD,
        self::RELOAD
    ];
}
