<?php

namespace Midnite81\UrlParser\Exceptions;

use Exception;
use Throwable;

class MalformedUrlException extends Exception
{
    public function __construct(string $url, string $message = "", int $code = 0, Throwable $previous = null)
    {
        $message = ! empty($message) ? $message : 'The Url ['.$url.'] was malformed';
        parent::__construct($message, $code, $previous);
    }
}