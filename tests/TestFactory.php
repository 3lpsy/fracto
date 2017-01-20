<?php
namespace Elspy\Fracto\Test;

use Closure;

namespace Elpsy\Fracto\Test;

abstract class TestFactory
{
    protected $increments = false;

    protected $faker;

    protected $each;

    public function __construct($faker)
    {
        $this->faker = $faker;
        $this->each = function($item) {
            return [];
        }
    }

    public function each(Closure $callback) {
        $this->each = $callback;
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
        $generated = array_merge($this->generate(), $custom);
        return array_merge($generated, $this->each($item));
    }
}
