<?php

namespace Soumen\Agent\Services;

use hisorange\BrowserDetect\Facade as BrowserDetect;
use Soumen\Agent\Exceptions\MethodDoesNotExistsException;

abstract class Service
{
    /**
     * Dynamic method calls.
     *
     * @throws Soumen\Agent\Exceptions\MethodDoesNotExistsException
     * @author Soumen Dey
     */
    public function __call($name, $param)
    {
        if ($this->isGetter($name)) {
            return $this->getPropertyFromGetter($name);
        }

        if ($this->propertyExists($name)) {
            return $this->$name;
        }

        throw MethodDoesNotExistsException::message($name);
    }

    /**
     * Alias for self::get() method.
     *
     * @author Soumen Dey
     */
    public static function all($attribute = null)
    {
        return self::get($attribute);
    }
    
    /**
     * Fetches the specified attribute and also an 
     * alias for static::getDetails() method.
     *
     * @author Soumen Dey
     */
    public static function get($attribute = null)
    {
        if ($attribute) {
            return static::getDetails()->$attribute;
        }

        return static::getDetails();
    }

    /**
     * Must return an instance of the child class.
     */
    abstract static function getDetails();

    /**
     * Fetch every detail.
     *
     * @return \hisorange\BrowserDetect\Result
     * @author Soumen Dey
     */
    protected function detect()
    {
        return BrowserDetect::detect();
    }

    /**
     * @author Soumen Dey
     */
    protected function getInstance($service = null)
    {
        return $this->mapPropertiesToMethods($service);
    }

    /**
     * @author Soumen Dey
     */
    protected function mapPropertiesToMethods($service)
    {
        $object = $this->detect();
        
        foreach (get_object_vars($this) as $key => $property) 
        {
            $this->setPropertyValue($key, $object, $service);
        }

        return $this;
    }

    /**
     * @author Soumen Dey
     */
    protected function setPropertyValue($property, $object, $prefix)
    {
        if ($property !== 'exceptions') {
            $this->$property = $object->
                {$this->resolveMethodName($prefix, $property)}();
        }
    }

    /**
     * @return String
     * @author Soumen Dey
     */
    protected function resolveMethodName($prefix, $value)
    {
        if (in_array($value, $this->getExceptions())) {
            return $value;
        }

        if ($this->subChar(2, $value) !== 'is') {
            return $prefix . $value;
        }

        return $value;
    }

    /** 
     * @author Soumen Dey
     */
    protected function getExceptions()
    {
        return (isset($this->exceptions)) ? $this->exceptions : [];
    }

    /**
     * Check if the property exists on the given instance.
     *
     * @return Boolean
     * @author Soumen Dey
     */
    protected function propertyExists($name)
    {
        return property_exists($this, $name);
    }

    /**
     * Determine if the method is a getter.
     *
     * @param String $param
     * @return Boolean
     * @author Soumen Dey
     */
    protected function isGetter($name)
    {
        return ($this->subChar(3, $name) === 'get');

        // This can also be used (laravel helper function):
        // return starts_with($name, 'get');
    }

    /**
     * Resolve the property name from the getter method
     * and return its value.
     * 
     * @param String $name
     * @author Soumen Dey
     */
    protected function getPropertyFromGetter($name)
    {
        return $this->{$this->constructPropertyName($name)};
    }

    /**
     * Returns a part of the string upto the spcified count.
     * 
     * Due to the performance difference (very slight) between
     * substr() vs treating strings as an array, the latter is 
     * used. Feel free to modify this method if necessary.
     *
     * @param Integer $count
     * @param String $string
     * @return String
     * @author Soumen Dey
     */
    protected function subChar($count, $string)
    {
        $str = '';

        for ($i = 0; $i < $count; $i++) {
            $str .= $string[$i];
        }

        return $str;

        // This can also be used:
        // return substr($string, 0, $count);
    }

    /**
     * Construct the property name.
     * 
     * Note: This method needs to be overridden based on the spcific needs.
     *
     * @return String
     * @author Soumen Dey
     */
    protected function constructPropertyName($name)
    {
        return lcfirst(str_ireplace('get', '', $name));
    }
}
