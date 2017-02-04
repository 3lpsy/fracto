<?php

namespace Elpsy\Fracto\Presenters\Traits;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Elpsy\Fracto\Adapters\PaginatorAdapter;
use Extended\Services\Transformers\Transformer;

trait Transformable
{
    protected $transformer = null;

    protected $paginator = null;

    protected function initPaginator()
    {
        if (! $this->paginator) {
            $this->paginator = PaginatorAdapter::class;
        }
    }

    public function paginator($adapter = null)
    {
        if ($adapter) {
            if (is_string($adapter)) {
                $adapter = new $adapter;
            }
            $this->setPaginator($adapter);
        }
        return $this->getPaginator();
    }

    protected function getPaginator()
    {
        return $this->paginator;
    }

    protected function setPaginator($adapter)
    {
        $this->paginator = $adapter;
    }

    public function transformer($transformer = null)
    {
        if ($transformer) {
            if (is_string($transformer)) {
                $transformer = new $transformer;
            }
            $this->setTransformer($transformer);
        }
        return $this->getTransformer();
    }

    protected function getTransformer()
    {
        return $this->transformer;
    }

    protected function setTransformer($transformer)
    {
        $this->transformer = $transformer;
    }


    protected function transformItem($data)
    {
        return new Item($data, $this->transformer, $this->itemKey);
    }

    protected function transformCollection($data)
    {
        return new Collection($data, $this->transformer, $this->collectionKey);
    }

    protected function transformPaginator($paginator)
    {
        $collection = $paginator->getCollection();
        $resource = new Collection($collection, $this->transformer, $this->collectionKey);
        $adapter = $this->paginator;
        $resource->setPaginator(new $adapter($paginator));
        return $resource;
    }
}
