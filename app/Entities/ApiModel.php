<?php

namespace App\Entities;


abstract class ApiModel
{
    const GET_ENDPOINT_URL = '';
    const POST_ENDPOINT_URL = '';
    const PUT_ENDPOINT_URL = '';
    const DELETE_ENDPOINT_URL = '';
    protected $fillable = [];


    public function getFillable(){
        return $this->fillable;
    }
}
