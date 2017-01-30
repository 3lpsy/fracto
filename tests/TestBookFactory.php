<?php

namespace Elpsy\Fracto\Test;

use Elpsy\Fracto\Test\TestFactory;

class TestBookFactory extends TestFactory
{
    protected $increments = ['id'];


    protected function generate()
    {
        return [
            'id' => 1,
            'title' => $this->faker->sentence(10),
            'published_at' => $this->faker->dateTime('now')
        ];
    }
}
