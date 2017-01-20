<?php

namespace Elpsy\Fracto\Test;

use League\Fractal\Pagination\Cursor;

use Elpsy\Fractalistic\ArraySerializer;

class FractoTest extends TestCase
{
    /** @test */
    public function it_can_transform_multiple()
    {
        $fractal = $this->fractal;

        $this->assertEquals($fractal, $fractal);
    }
}
