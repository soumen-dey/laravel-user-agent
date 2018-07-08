<?php

namespace Soumen\Agent\Services;

use Soumen\Agent\Traits\HasRequestParameters;

class Server extends Service
{
    use HasRequestParameters;

    public $attributes;

    /**
     * Instantiates the class.
     * 
     * @return Soumen\Agent\Services\Server
     * @author Soumen Dey
     */
    public static function getDetails()
    {
        return (new self)->getInstance();
    }

    /**
     * Sets the server variables to the $attributes property.
     * 
     * @override
     * @return Soumen\Agent\Services\Server
     * @author Soumen Dey
     */
    protected function getInstance($service = null)
    {
        $this->attributes = request()->server();

        return $this;
    }
}
