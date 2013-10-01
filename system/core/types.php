<?php
namespace Framework\Type;

const Boolean   = 1;
const Bool      = 1;

const Integer   = 2;
const Int       = 2;
const Timestamp = 2;

const Number    = 3;
const Float     = 3;
const Double    = 3;

const String    = 4;
const Text      = 4;

const Email     = 5;
const Mail      = 5;

const URL       = 6;
const Url       = 6;

function toPDO($type) {
    switch ($type) {
        case namespace\Boolean:
            return \PDO::PARAM_BOOL;
            break;
        case namespace\Integer:
            return \PDO::PARAM_INT;
            break;
        case namespace\Number:
            return \PDO::PARAM_STR;
            break;
        case namespace\String:
        case namespace\Email:
        case namespace\URL:
            return \PDO::PARAM_STR;
            break;
        default:
            return $type;
            break;
    }
}
