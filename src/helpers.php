<?php

use Elpsy\Larafrac\Fractal;

if (! function_exists('fractal')) {
    function fractal($data, $transformer, $serializer = null)
    {
        return Fractal::create($data, $transformer, $serializer);
    }
}
