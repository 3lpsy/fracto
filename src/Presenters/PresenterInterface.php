<?php

namespace Elpsy\Fracto\Presenters;

/**
 * Interface PresenterInterface
 * @package Prettus\Repository\Contracts
 */
interface PresenterInterface
{
    public function transformer($transformer);

    public function serializer($serializer);

    public function key($key);

    public function keyItem($key);

    public function keyCollection($key);

    public function present($data);
}
