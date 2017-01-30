<?php


use Elpsy\Fracto\Fracto;

if (! function_exists('fracto')) {
    function fracto($data, $transformer, $serializer = null)
    {
        return Fracto::create($data, $transformer, $serializer);
    }
}
