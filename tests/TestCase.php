<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected  function prepareArray(array $estructura, mixed $data, string $valor) : array
    {
        $index = array_search($valor, $estructura);
        if($index){
            unset($estructura[$index]);
            $estructura[$valor]=$data;
        }
        return $estructura;
    }
}
