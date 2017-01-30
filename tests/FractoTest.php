<?php

namespace Elpsy\Fracto\Test;

use League\Fractal\Pagination\Cursor;
use Elpsy\Fracto\Fracto;

class FractoTest extends TestCase
{
    /** @test */
    public function it_can_init_fracto_instance()
    {
        $fracto = new Fracto;

        $this->assertEquals($fracto, $fracto);
    }
}
