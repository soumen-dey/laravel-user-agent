<?php

namespace Soumen\Agent;

use Soumen\Agent\Services\Device;
use Soumen\Agent\Services\Header;
use Soumen\Agent\Services\Server;
use Soumen\Agent\Services\Browser;
use Soumen\Agent\Services\Platform;
use Soumen\Agent\Services\UserAgent;

class Agent
{
    public $ip;
    public $header;
    public $device;
    public $server;
    public $browser;
    public $platform;
    public $userAgent;

    /**
     * Get every properties.
     *
     * @return Soumen\Agent\Agent
     * @author Soumen Dey
     */
    public static function get($service = null) 
    {
        return self::getInstance($service);
    }

    /**
     * Alias for get() method.
     *
     * @return Soumen\Agent\Agent
     * @author Soumen Dey
     */
    public static function all($service = null)
    {
        return self::get($service);
    }

    /**
     * Get browser related information.
     *
     * @return Soumen\Agent\Services\Browser
     * @author Soumen Dey
     */
    public static function browser($attribute = null)
    {
        return Browser::get($attribute);
    }

    /**
     * Get platform related information.
     *
     * @return Soumen\Agent\Services\Platform
     * @author Soumen Dey
     */
    public static function platform($attribute = null)
    {
        return Platform::get($attribute);
    }
    
    /**
     * Get device related information.
     *
     * @return Soumen\Agent\Services\Device
     * @author Soumen Dey
     */
    public static function device($attribute = null)
    {
        return Device::get($attribute);
    }

    /**
     * Get the user's HTTP_USER_AGENT string.
     *
     * @return String
     * @author Soumen Dey
     */
    public static function userAgent()
    {
        return UserAgent::get();
    }

    /**
     * Get the IP Address of the visitor.
     *
     * @return String
     * @author Soumen Dey
     */
    public static function ip()
    {
        return request()->getClientIp();
    }

    /**
     * Get server related information about the current request.
     *
     * @return Soumen\Agent\Services\Server
     * @author Soumen Dey
     */
    public static function server($attribute = null)
    {
        return Server::get($attribute);
    }

    /**
     * Get header related information about the current request.
     *
     * @return Soumen\Agent\Services\Header
     * @author Soumen Dey
     */
    public static function header($attribute = null)
    {
        return Header::get($attribute);
    }

    /**
     * Get the instance of the current object.
     *
     * @return Soumen\Agent\Agent
     * @author Soumen Dey
     */
    private static function getInstance($property = null)
    {
        $agent = (new self)->setPropertiesToServices();

        if ($property) {
            return $agent->$property;
        }

        return $agent;
    }

    /**
     * Set every properties to the respective services.
     *
     * @return Soumen\Agent\Agent
     * @author Soumen Dey
     */
    private function setPropertiesToServices()
    {
        $properties = get_object_vars($this);

        foreach($properties as $key => $value) {
            $this->$key = self::{$key}();
        }

        return $this;
    }
}