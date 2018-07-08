<?php

namespace Soumen\Agent\Services;

class Device extends Service
{
    /**
     * Properties which are to be excluded from the
     * automatic resolution list.
     */
    protected $exceptions = [
        'mobileGrade',
    ];

    public $isMobile;
    public $isTablet;
    public $isDesktop;
    public $isBot;
    public $family;
    public $model;
    public $mobileGrade;

    /**
     * Retrieves the device details.
     *
     * @return \Soumen\Agent\Services\Device
     * @author Soumen Dey
     */
    public static function getDetails()
    {
        return (new self)->getInstance('device');
    }

    /**
     * Returns the type of device.
     *
     * @return String
     * @author Soumen Dey
     */
    public function getType()
    {
        if ($this->isMobile) {
            return 'Mobile';
        }

        if ($this->isTablet) {
            return 'Tablet';
        }

        if ($this->isDesktop) {
            return 'Desktop';
        }

        if ($this->isBot) {
            return 'Bot';
        }
    }

    /**
     * Returns the device's vendor.
     *
     * @return String
     * @author Soumen Dey
     */
    public function getVendor()
    {
        return $this->family;
    }
}
