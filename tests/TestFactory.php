<?php

namespace Elpsy\Fracto\Test;

use Closure;

abstract class TestFactory
{
    protected $increments = false;

    protected $faker;

    protected $each;

    public function __construct($faker)
    {
        $this->faker = $faker;

        $this->each = function () {
            return array();
        };
    }

    public function each(\Closure $callback)
    {
        $this->each = $callback;
        return $this;
    }

    public function create($number = 1)
    {
        $data = [];

        for ($ii = 0; $ii < $number; $ii++) {
            $custom = [];

            if ($this->increments) {
                $custom['id'] = $ii + 1;
            }

            $data[] = $this->one();
        }

        return $data;
    }

    public function one($custom = [])
    {
        $generated = $this->generate();
        $mapped = array_merge($generated, call_user_func($this->each, $generated));
        return array_merge($mapped, $custom);
    }
}
