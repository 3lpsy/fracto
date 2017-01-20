<?php

namespace Elpsy\Fracto\Presenters\Traits;

trait Includable
{
    public $includes = [];

    public function includes($include)
    {
        if (is_array($include)) {
            return collect($include)->each(function ($inc) {
                $this->pushInclude($inc);
            });
        }
        return $this->pushInclude($include);
    }

    public function pushInclude($include)
    {
        if ($this->includes->contains($include)) {
            return $this;
        }
        $this->includes->push($include);
    }

    protected function parseIncludes()
    {
        $this->fractal->parseIncludes($this->includes->toArray());
        return $this;
    }
}
