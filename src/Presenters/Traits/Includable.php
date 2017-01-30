<?php

namespace Elpsy\Fracto\Presenters\Traits;

trait Includable
{
    public $includes = [];

    public $excludes = [];

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

    public function excludes($excludes)
    {
        if (is_array($excludes)) {
            return collect($exclude)->each(function ($exc) {
                $this->pushInclude($exc);
            });
        }
        return $this->pushExclude($exclude);
    }

    public function pushExclude($exclude)
    {
        if ($this->excludes->contains($exclude)) {
            return $this;
        }
        $this->excludes->push($exclude);
    }

    protected function parseExcludes()
    {
        $this->fractal->parseExcludes($this->excludes->toArray());
        return $this;
    }
}
