<?php

namespace Elpsy\Fracto\Presenters\Traits;

use Elpsy\Fracto\Serializers\DataSerializer;
use Elpsy\Fracto\Serializers\JsonSerializer;

trait Serializerable
{
    protected $serializer;

    public function serializer($serializer = null)
    {
        if (! is_null($serializer)) {
            $this->setSerializer($serializer);
        }
        return $this->getSerializer();
    }

    public function defaultSerializer()
    {
        return new DataSerializer;
    }

    public function defaultJsonSerializer()
    {
        return new JsonSerializer;
    }

    protected function initSerializer()
    {
        $serializer = $this->serializer();

        if (! $serializer) {
            $this->setSerializer($this->defaultSerializer());
        }
    }

    protected function getSerializer()
    {
        return $this->serializer;
    }

    protected function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }
}
