<?php

namespace Elpsy\Fracto\Test;

use Elpsy\Fracto\Test\TestFactory;

class TestAddressFactory extends TestFactory
{
    protected function generate()
    {
        return [
            'id' => 1,
            'line_1' => $this->faker->streetAddress,
            'line_2' => $this->faker->streetAddress,
            'city' => $this->faker->city
        ];
    }
}
