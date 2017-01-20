<?php

namespace Elpsy\Fracto;

use Exception;

use Elpsy\Fracto\FractoInterface;
use Elpsy\Fracto\Presenters\Presenter;

class Fracto implements FractoInterface
{
    protected $resource;

    protected $presenter;

    protected $results;

    public function __construct()
    {
        $this->boot();
    }

    protected function boot()
    {
        $this->presenter($this->makePresenter());
    }

    public static function create($data, $transformer, $serializer = null)
    {
        $fractal = new static;

        if ($serializer === null) {
            $serializer = $this->presenter->defaultSerializer();
        }

        $fractal->data($data)->transformer($transformer)->serializer($serializer);

        return $fractal;
    }

    public function presenter($presenter)
    {
        $this->presenter = $presenter;

        return $this;
    }

    // setter only
    public function transformer($transformer)
    {
        $this->presenter->transformer($transformer);

        return $this;
    }

    // setter only
    public function serializer($serializer)
    {
        $this->presenter->serializer($serializer);

        return $this;
    }

    public function key($key)
    {
        $this->presenter->key($key);

        return $this;
    }

    public function keyItem($key)
    {
        $this->presenter->keyItem($key);

        return $this;
    }

    public function keyCollection($key)
    {
        $this->presenter->keyCollection($key);

        return $this;
    }

    public function includes($includes = [])
    {
        $this->presenter->includes($includes);

        return $this;
    }

    public function data($results = [])
    {
        $this->results = $results;

        return $this;
    }

    public function toArray()
    {
        return $this->present();
    }

    public function transform()
    {
        return $this->presenter->present($this->results);
    }

    protected function makePresenter($presenter = null)
    {
        if (! is_null($presenter)) {
            if (is_string($presenter)) {
                return new $presenter;
            }
            return $presenter;
        }

        return $this->makeDefaultPresenter();
    }

    protected function makeDefaultPresenter()
    {
        return new Presenter();
    }
}
