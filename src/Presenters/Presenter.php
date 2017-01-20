<?php

namespace Elpsy\Fracto\Presenters;

use Exception;

use Elpsy\Fracto\Presenters\PresenterInterface;
use Elpsy\Fracto\Presenters\Traits\Transformable;
use Elpsy\Fracto\Presenters\Traits\Serializable;
use Elpsy\Fracto\Presenters\Traits\Resourceable;
use Elpsy\Fracto\Presenters\Traits\Includable;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Elpsy\Fracto\Adapaters\PaginatorAdapter;

class Presenter implements PresenterInterface
{
    use Transformable, Serializable, Resourceable, Includable;
    /**
     * @var \League\Fractal\Manager
     */
    protected $fractal = null;

    public function __construct()
    {
        $this->fractal = new Manager();
        $this->includes = new SupportCollection();
        $this->boot();
    }

    protected function boot()
    {
        $this->initSerializer();
    }

    public function present($data)
    {
        $this->parseIncludes();

        $this->fractal->setSerializer($this->serializer);

        if (! $this->transformer) {
            $this->initTransformer();
        }

        if ($data instanceof EloquentCollection || $data instanceof SupportCollection || is_array($data)) {
            $this->resource = $this->transformCollection($data);
        } elseif ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }
        return $this->fractal->createData($this->resource)->toArray();
    }
}
