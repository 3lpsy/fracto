<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elpsy\Fracto\Serializers;

use League\Fractal\Serializer\DataArraySerializer as FractalDataArraySerializer;

class DataSerializer extends FractalDataArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }

    public function item($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }
}
