<?php
require_once('types.php');

/**
 * Coerces (filters) a variable into a given type.
 * @param $variable
 * @param $type One of the Framework\Type constants.
 * @return bool|mixed Returns false if the coercion failed, or the new value if
 *     it succeeded. (Boolean coercion can't fail.)
 */
function coerceType($variable, $type) {
    $is_numeric = function($val) {
        if (stristr($val, 'e')) {
            // Scientific notation
            return false;
        } else if (stristr($val, 'x')) {
            // Hexadecimal notation
            return false;
        } else {
            return is_numeric($val);
        }
    };

    switch ($type) {
        case \Framework\Type\Boolean:
            // FILTER_VALIDATE_BOOLEAN defaults to false, which is not expected.
            $variable     = strtolower($variable);
            $false_values = array(
                0,
                false,
                '',
                '0',
                'false',
            );
            return !in_array($variable, $false_values, true);
            break;

        case \Framework\Type\Integer:
            return filter_var($variable, FILTER_VALIDATE_INT);
            break;

        case \Framework\Type\Number:
            return filter_var($variable, FILTER_VALIDATE_FLOAT);
            break;

        default:
        case \Framework\Type\String:
            // Remove null bytes:
            return str_replace('\0', '', $variable);
            break;

        case \Framework\Type\Email:
            return filter_var($variable, FILTER_VALIDATE_EMAIL);
            break;

        case \Framework\Type\Url:
            return filter_var($variable, FILTER_VALIDATE_URL);
            break;
    }
}

/**
 * Get and coerce a value from $_GET.
 * @param $name The name of the $_GET variable.
 * @param $type One of the Framework\Type constants.
 * @return null|bool|mixed Returns null if that variable isn't set, false if the
 *    coercion failed, or the value on success.
 */
function GET($name, $type = \Framework\Type\String) {
    if (isset($_GET[$name])) {
        return coerceType($_GET[$name], $type);
    } else {
        return null;
    }
}

/**
 * Get and coerce a value from $_POST.
 * @param $name The name of the $_POST variable.
 * @param $type One of the Framework\Type constants.
 * @return null|bool|mixed Returns null if that variable isn't set, false if the
 *     coercion failed, or the value on success.
 */
function POST($name, $type = \Framework\Type\String) {
    if (isset($_POST[$name])) {
        return coerceType($_POST[$name], $type);
    } else {
        return null;
    }
}

/**
 * Get and coerce a value from $_REQUEST.
 * @deprecated Use GET or POST instead.
 * @param $name The name of the $_REQUEST variable.
 * @param $type One of the Framework\Type constants.
 * @return null|bool|mixed Returns null if that variable isn't set, false if the
 *    coercion failed, or the value on success.
 */
function REQUEST($name, $type = \Framework\Type\String) {
    if (isset($_REQUEST[$name])) {
        return coerceType($_REQUEST[$name], $type);
    } else {
        return null;
    }
}

/**
 * Get and coerce a value from $_COOKIE.
 * @param $name The name of the $_COOKIE variable.
 * @param $type One of the Framework\Type constants.
 * @return null|bool|mixed Returns null if that variable isn't set, false if the
 *    coercion failed, or the value on success.
 */
function COOKIE($name, $type = \Framework\Type\String) {
    if (defined('DATA_PREFIX')) {
        $name = DATA_PREFIX . $name;
    }
    if (isset($_COOKIE[$name])) {
        return coerceType($_COOKIE[$name], $type);
    } else {
        return null;
    }
}

/**
 * Sets a cookie.
 * @param $name
 * @param $value
 * @param array $params
 * @throws Exception Thrown if the setcookie call fails.
 */
function SET_COOKIE($name, $value, $params = array()) {
    if (defined('DATA_PREFIX')) {
        $name = DATA_PREFIX . $name;
    }
    $defaults    = array(
        'expire'   => 0,
        'path'     => APP_URL,
        'domain'   => parse_url(APP_URL, PHP_URL_HOST),
        'secure'   => true,
        'httponly' => true,
    );
    $real_params = array();
    foreach (array_keys($defaults) as $key) {
        if (isset($params[$key])) {
            $real_params[$key] = $params[$key];
        } else {
            $real_params[$key] = $defaults[$key];
        }
    }
    if (!setcookie($name, $value, $real_params['expire'], $real_params['path'],
        $real_params['domain'], $real_params['secure'],
        $real_params['httponly'])) {
        throw new Exception('Cookie $name set after output sent.');
    }
}

/**
 * Get and coerce a value from $_SESSION.
 * @param string $name The name of the $_SESSION variable.
 * @param $type One of the Framework\Type constants.
 * @return null|bool|mixed Returns null if that variable isn't set, false if the
 *    coercion failed, or the value on success.
 */
function SESSION($name, $type = \Framework\Type\String) {
    if (!defined('SESSION_STARTED') && !SESSION_STARTED) {
        session_start();
        define('SESSION_STARTED', true);
    }
    if (defined('DATA_PREFIX')) {
        $name = DATA_PREFIX.$name;
    }
    return coerceType($_SESSION[$name], $type);
}

/**
 * Set a session variable. Really only useful for the DATA_PREFIX and to be
 * symmetrical.
 * @param $name
 * @param $value
 */
function SET_SESSION($name, $value) {
    if (!defined('SESSION_STARTED') && !SESSION_STARTED) {
        session_start();
        define('SESSION_STARTED', true);
    }
    if (defined('DATA_PREFIX')) {
        $name = DATA_PREFIX . $name;
    }
    $_SESSION[$name] = $value;
}

/**
 * Get a value from $_FILES. Only here for symmetry.
 * @param $name The file input name.
 * @param $subscript Optional. Returns $_FILES[$name][$subscript] instead.
 */
function FILES($name, $subscript = null) {
    if ($subscript === null) {
        return $_FILES[$name];
    } else {
        return $_FILES[$name][$subscript];
    }
}

/**
 * @param $name
 * @param int $type
 * @return null|bool|mixed
 */
function SERVER($name, $type = \Framework\Type\String) {
    if (isset($_SERVER[$name])) {
        return coerceType($_SERVER[$name], $type);
    } else {
        return null;
    }
}

/**
 * @param $name
 * @param int $type
 * @return null|bool|mixed
 */
function ENV($name, $type = \Framework\Type\String) {
    if (isset($_ENV[$name])) {
        return coerceType($_ENV[$name], $type);
    } else {
        return null;
    }
}
