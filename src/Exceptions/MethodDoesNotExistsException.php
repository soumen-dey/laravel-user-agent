<?php

namespace Soumen\Agent\Exceptions;

use InvalidArgumentException;

class MethodDoesNotExistsException extends InvalidArgumentException
{
    public static function message($name) {
        return new static("The method `{$name}()` does not exists."); 
    }

    public static function property($name) {
        return new static("The property `{$name}` does not exists.");
    }
}
