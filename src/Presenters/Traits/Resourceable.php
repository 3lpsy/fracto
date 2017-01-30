<?php

namespace Elpsy\Fracto\Presenters\Traits;

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
        if ($data instanceof EloquentCollection || $data instanceof SupportCollection || is_array($data)) {
            $this->resource = $this->transformCollection($data);
        } elseif ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }
    }
}
