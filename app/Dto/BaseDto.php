<?php

namespace App\Dto;

use JsonSerializable;

abstract class BaseDto implements JsonSerializable
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    protected function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    /**
     * Fill the model with an array of attributes and return only the array attributes properties.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function fillCustom(array $attributes)
    {
        foreach($this as $attribute => $val){
            if(array_key_exists($attribute, $attributes)){
                $this->{$attribute} = $attributes[$attribute];
            } else {
                $this->offsetUnset($attribute);
            }
        }
        return $this;
    }

    public function structure()
    {
        foreach($this as $attribute => $val){
            $atributes[]=$attribute;
        }
        return $atributes;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function hide($params = [])
    {
        if(is_array($params) && count($params) > 0) {
            foreach($params as $key => $value) {
                unset($this->{$key});
            }
        }

        return $this;
    }

    public function hideNull()
    {
        foreach(get_object_vars($this) as $key => $value) {
            if($value === null) {
                unset($this->{$key});
            }
        }

        return $this;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    private function offsetUnset($offset)
    {
        unset($this->$offset, $this->$offset);
    }
}
