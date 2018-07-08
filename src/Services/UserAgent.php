<?php

namespace Soumen\Agent\Services;

use hisorange\BrowserDetect\Facade as BrowserDetect;

class UserAgent
{
    /**
     * Get the user's HTTP_USER_AGENT string.
     *
     * @return String
     * @author Soumen Dey
     */
    public static function get()
    {
        return BrowserDetect::userAgent();
    }
}
