<?php


use Illuminate\Support\Debug\Dumper;

if (! function_exists('dump')) {
    function dump($data)
    {
        (new Dumper())->dump($data);
    }
}
