<?php

function utf8_sanitize($mixed)
{
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8_sanitize($value);
        }
    } elseif (is_object($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed->{$key} = utf8_sanitize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }

    return $mixed;
}

function json_safe_encode($object, $flags = null)
{
    if (defined('JSON_INVALID_UTF8_IGNORE')) {
        $flags |= JSON_INVALID_UTF8_IGNORE;
    } else {
        $object = utf8_sanitize($object);
    }

    $json = json_encode($object, $flags);

    if ($json === false) {
        $json = json_encode([
            'json_last_error' => json_last_error(),
            'json_last_error_msg' => json_last_error_msg(),
            'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
        ], JSON_PRETTY_PRINT);
    }

    return $json;
}
