<?php

namespace Elpsy\Fracto\Test;

use Closure;

class TestAuthorFactory extends TestFactory
{
    protected $increments = ['id'];


    protected function generate()
    {
        return [
            'id' => 1,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'address_id' => rand(0, 10)
        ];
    }
}
