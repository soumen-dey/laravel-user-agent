<?php

namespace Soumen\Agent\Services;

class Browser extends Service
{
    public $name;
    public $engine;
    public $family;
    public $version;
    public $versionMajor;
    public $versionMinor;
    public $versionPatch;
    public $isChrome;
    public $isFirefox;
    public $isOpera;
    public $isSafari;
    public $isIE;

    /**
     * Retrieves the browser details.
     *
     * @return \Soumen\Agent\Services\Browser
     * @author Soumen Dey
     */
    public static function getDetails($attribute = null)
    {
        return (new self)->getInstance('browser');
    }

    /**
     * Returns the vendor name of the browser.
     *
     * @return String
     * @author Soumen Dey
     */
    public function getVendor()
    {
        return $this->family;
        
        // if ($this->isChrome) {
        //     return 'Chrome';
        // }

        // if ($this->isFirefox) {
        //     return 'Firefox';
        // }

        // if ($this->isSafari) {
        //     return 'Safari';
        // }

        // if ($this->isOpera) {
        //     return 'Opera';
        // }

        // if ($this->isIE) {
        //     return 'IE';
        // }
    }
}
