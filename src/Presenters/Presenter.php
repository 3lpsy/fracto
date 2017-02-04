<?php

namespace Elpsy\Fracto\Presenters;

use Exception;

use Elpsy\Fracto\Presenters\Traits\Transformable;
use Elpsy\Fracto\Presenters\Traits\Serializerable;
use Elpsy\Fracto\Presenters\Traits\Resourceable;
use Elpsy\Fracto\Presenters\Traits\Includable;
use League\Fractal\Serializer\JsonApiSerializer;
use Illuminate\Support\Collection;
use League\Fractal\Manager;

class Presenter implements PresenterInterface
{
    use Transformable, Serializerable, Resourceable, Includable;

    protected $fractal = null;

    protected $data = null;

    public function __construct()
    {
        $this->fractal = new Manager();
        $this->includes = new Collection();
        $this->excludes = new Collection();

        $this->initSerializer();
    }

    protected function createData()
    {
        $this->data = $this->fractal->createData($this->resource);
    }

    public function present($data)
    {
        $this->fractal->setSerializer($this->serializer);

        $this->parseIncludes();
        $this->parseExcludes();

        if (! $this->transformer) {
            $this->initTransformer();
        }

        $this->createResource($data);

        $this->createData($this->resource);

        return $this;
    }

    public function toArray()
    {
        return $this->data->toArray();
    }

    public function toJson()
    {
        return $this->data->toArray();
    }
}
