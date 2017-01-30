<?php
namespace Elpsy\Fracto\Test;

use League\Fractal\TransformerAbstract;
use Elpsy\Fracto\Test\TestAddressTransformer;

class TestAuthorTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'address',
    ];

    /**
     * @param array $author
     *
     * @return array
     */
    public function transform(array $author)
    {
        return [
            'id' => (int) $author['id'],
            'firstName' => $author['first_name'],
            'lastName' => $author['last_name'],
            'email' => $author['email']

        ];
    }

    /**
     * Include characters.
     *
     * @param array $author
     *
     * @return \League\Fractal\ItemResource
     */
    public function includeAddress(array $author)
    {
        $address = $author['address'];
        return $this->item($address, new TestAddressTransformer, false);
    }
}
