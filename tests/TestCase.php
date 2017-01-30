<?php

namespace Elpsy\Fracto\Test;

use PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

include __DIR__.'/helpers.php';

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

        $addresses = $this->factory("address")->create(5);

        $authors = $this->factory('author')->each(function ($author) use ($addresses) {
            $key = array_rand($addresses, 1);
            return [
                'address' => $addresses[$key]
            ];
        })->create(5);

        $books = $this->factory('book')->each(function ($book) use ($authors) {
            $key = array_rand($authors, 1);
            return [
                'author' => $authors[$key]
            ];
        })->create(5);
        $this->data = ['addresses' => $addresses, 'authors' => $authors, 'books' => $books];
    }

    public function factory($name)
    {
        $class = $this->namespace."Test".ucfirst($name)."Factory";
        return new $class($this->faker);
    }
}
