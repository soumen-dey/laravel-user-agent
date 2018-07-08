<?php

namespace Soumen\Agent\Services;

use Soumen\Agent\Traits\HasRequestParameters;

class Header extends Service
{
    use HasRequestParameters;

    public $attributes;

    /**
     * Instantiates the class.
     * 
     * @return Soumen\Agent\Services\Header
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
     * @return Soumen\Agent\Services\Header
     * @author Soumen Dey
     */
    public function getInstance($service = null)
    {
        $this->attributes = request()->header();

        return $this;
    }

    /**
     * @override
     */
    protected function constructPropertyName($method)
    {
        return str_ireplace('_', '-', strtolower(snake_case($method, '-')));
    }
}
