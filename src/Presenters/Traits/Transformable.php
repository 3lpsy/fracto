<?php

namespace Elpsy\Fracto\Presenters\Traits;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Elpsy\Fracto\Adapaters\PaginatorAdapter;
use Extended\Services\Transformers\Transformer;

trait Transformable
{
    protected $transformer = null;

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
        $resource->setPaginator(new PaginatorAdapter($paginator));
        return $resource;
    }
}
