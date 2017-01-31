<?php

namespace Elpsy\Fracto\Presenters\Traits;

use Illuminate\Support\Collection;
use League\Fractal\Pagination\PaginatorInterface as AbstractPaginator;
use Illuminate\Contracts\Pagination\Paginator;

trait Resourceable
{
    protected $collectionKey = null;

    protected $itemKey = "data";

    protected $resource = "data";

    public function key($key = null)
    {
        $itemKey = $key;
        $collectionKey = is_string($key) ? Str::plural($key) : $key;
        
        $this->keyItem($itemKey);
        $this->keyCollection($collectionKey);
    }

    public function keyItem($key = null)
    {
        $this->itemKey = $key;
    }

    public function keyCollection($key = null)
    {
        $this->collectionKey = $key;
    }

    public function createResource($data)
    {
        if ($this->isCollectable($data)) {
            $this->resource = $this->transformCollection($data);
        } elseif ($this->isPaginator($data)) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }
    }

    protected function isCollectable($data)
    {
        return is_array($data) || $data instanceof Collection;
    }

    protected function isPaginator($data)
    {
        return $data instanceof AbstractPaginator || $data instanceof Paginator;
    }
}
