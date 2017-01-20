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
}
