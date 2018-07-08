<?php

namespace Soumen\Agent\Services;

class Platform extends Service
{
    public $name;
    public $family;
    public $version;
    public $versionMajor;
    public $versionMinor;
    public $versionPatch;

    /**
     * Retrieves the platform details.
     *
     * @return \Soumen\Analytics\Helpers\Platform
     * @author Soumen Dey
     */
    public static function getDetails()
    {
        return (new self)->getInstance('platform');
    }

    /**
     * Returns the name of the platform.
     * Alias for $this->family.
     *
     * @return String
     * @author Soumen Dey
     */
    public function getVendor()
    {
        return $this->family;
    }
}
