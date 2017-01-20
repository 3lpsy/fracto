
<?php
namespace Elpsy\Fracto\Test;

use League\Fractal\TransformerAbstract;
use Elpsy\Fracto\Test\TestAddressTransformer;

class TestAddressTransformer extends TransformerAbstract
{

    /**
     * @param array $author
     *
     * @return array
     */
    public function transform(array $author)
    {
        return [
            'id' => (int) $author['id'],
            'line1' => $author['line_1'],
            'line2' => $author['line_2'],
            'city' => $author['city']

        ];
    }
}
