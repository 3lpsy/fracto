<?php

namespace Elpsy\Fracto;

use Exception;

use Elpsy\Fracto\FractoInterface;
use Elpsy\Fracto\Presenters\Presenter;

class Fracto implements FractoInterface
{
    protected $resource;

    protected $presenter;

    protected $data;

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
            $serializer = $fractal->presenter->defaultSerializer();
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
        if (! is_array($includes)) {
            $includes = func_get_args();
        }

        $this->presenter->includes($includes);

        return $this;
    }

    public function exclude($excludes = [])
    {
        if (! is_array($excludes)) {
            $excludes = func_get_args();
        }

        $this->presenter->excludes($excludes);

        return $this;
    }

    public function data($data = [])
    {
        if (func_num_args() > 1) {
            $data = func_get_args();
        }

        if (! is_array($data)) {
            $data = (array) $data;
        }

        $this->data = $data;

        return $this;
    }

    public function transform($data = null)
    {
        if ($data) {
            $this->data($data);
        }

        return $this->presenter->present($this->data);
    }

    public function toArray($data = null)
    {
        return $this->transform($data)->toArray();
    }

    public function toJson($data = null)
    {
        return $this->transform($data)->toJson();
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
