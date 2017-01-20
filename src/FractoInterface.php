<?php

namespace Elpsy\Fracto;

interface FractoInterface
{
    public static function create($data, $transformer, $serializer = null);

    public function presenter($presenter);

    public function transformer($transformer);

    public function serializer($serializer);

    public function key($key);

    public function keyItem($key);

    public function keyCollection($key);

    public function includes($include);

    public function transform();
}
