<?php

namespace Elpsy\Fracto\Presenters\Traits;

use Illuminate\Support\Collection;
use League\Fractal\Pagination\PaginatorInterface as AbstractPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Str;

trait Resourceable
{
    protected $collectionKey = "data";

    protected $itemKey = "data";

    protected $resource;

    protected $resourceType;

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

    public function type($type)
    {
        if (! in_array($type, ['collection', 'item', 'paginator'])) {
            throw new \Exception("Invalid Resource Type");
        }
        $this->resourceType = $type;
    }

    public function createResource($data)
    {
        if ($this->hasResourceType()) {
            return $this->resource = $this->resolveResourceFromType($data, $this->resourceType);
        }

        $type = $this->resolveResourceTypeFromData($data);

        return $this->resource = $this->resolveResourceFromType($data, $type);
    }

    protected function hasResourceType()
    {
        return !! $this->resourceType;
    }

    protected function resolveResourceTypeFromData($data)
    {
        if ($this->isCollectable($data)) {
            return 'collection';
        } elseif ($this->isPaginator($data)) {
            return 'paginator';
        } else {
            return 'item';
        }
    }

    protected function resolveResourceFromType($data, $type)
    {
        if ($type === 'collection') {
            return $this->resource = $this->transformCollection($data);
        } elseif ($type === 'paginator') {
            return $this->resource = $this->transformPaginator($data);
        } elseif ($type === 'item') {
            return $this->resource = $this->transformItem($data);
        }

        throw new \Exception("Invalid Resource Type");
    }

    protected function isCollectable($data)
    {
        if (! is_array($data) && ! ($data instanceof Collection)) {
            return false;
        } elseif (count($data) < 1) {
            // return as collectible as it doesn't matter
            return true;
        } else {
            if ($data instanceof Collection) {
                $keys = $data->keys();
            } elseif (is_array($data)) {
                $keys = array_keys($data);
            }

            $isAssoc = true;
            foreach ($keys as $index => $key) {
                if (! is_int($key)) {
                    $isAssoc = false;
                }
            }
            return $isAssoc;
        }
    }

    protected function isPaginator($data)
    {
        return $data instanceof AbstractPaginator || $data instanceof Paginator;
    }
}
