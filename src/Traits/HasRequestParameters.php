<?php

namespace Soumen\Agent\Traits;

use Soumen\Agent\Exceptions\MethodDoesNotExistsException;

trait HasRequestParameters 
{
    public function __get($name) 
    {
        if (isset($this->attributes[$name])) {
            return $this->getProperty($this->attributes[$name]);
        }

        $property = $this->constructPropertyName($name);

        if ($this->propertyExists($property)) {
            return $this->$property;
        }

        throw MethodDoesNotExistsException::property($name);
    }

    /**
     * @override
     */
    public function __call($name, $param) 
    {
        if ($this->isGetter($name)) {
            return $this->getPropertyFromGetter($name);
        }

        if ($this->propertyExists($name)) {
            return $this->$name;
        }

        $property = $this->constructPropertyName($name);

        if ($this->propertyExists($property)) {
            return $this->{$property};
        }

        throw MethodDoesNotExistsException::message($name);
    }

    /**
     * @override
     */
    protected function getPropertyFromGetter($method)
    {
        return $this->{
            $this->constructPropertyName(str_ireplace('get', '', $method))
        };
    }

    /**
     * @override 
     */
    public function propertyExists($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Construct the property name according to the PHP's 
     * $_SERVER['ELEMENT_NAME'] implementation.
     *
     * @override
     * @return String
     * @author Soumen Dey
     */
    protected function constructPropertyName($method)
    {
        return strtoupper(snake_case($method));
    }

    /**
     * @return String
     * @author Soumen Dey
     */
    protected function getProperty($property)
    {
        if (is_array($property)) {
            return $property[0];
        }

        return $property;
    }
}