<?php

namespace Elpsy\Fracto\Test;

use Closure;
use PHPUnit_Framework_TestCase;
use Elpsy\Fracto\Fracto;
use Faker\Factory as FakerFactory;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /** @var \Elpsy\Fracto\FractoInterface */
    protected $fracto;

    /** @var array */
    protected $data;

    /** @var string|\League\Fractal\Serializer\SerializerAbstract */
    protected $defaultSerializer;

    /** @var string Test Namespace*/
    protected $namespace = "\\Elpsy\\Fracto\\Test\\";

    public function setUp($defaultSerializer = '')
    {
        parent::setUp();

        $this->faker = FakerFactory::create();

        $this->fractal = new Fracto;

        $addresses = $this->factory("address")->create();

        $authors = $this->factory('author')->each(function ($author) {
            return [
                'address' => array_rand($addresses, 1)[0]
            ];
        })->create();

        $books = $this->factory('book')->each(function ($author) {
            return [
                'author' => array_rand($authors, 1)[0]
            ];
        })->create();

        $this->data = ['addresses' => $addresses, 'authors' => $authors, 'books' => $books];
    }

    public function factory($name)
    {
        $class = $this->namespace."Test".ucfirst($name)."Factory";
        return new $class($this->faker);
    }
}
