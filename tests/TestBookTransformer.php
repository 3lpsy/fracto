<?php
namespace Elpsy\Fracto\Test;

use League\Fractal\TransformerAbstract;
use Elpsy\Fracto\Test\TestAuthorTransformer;

class TestBookTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'author'
    ];

    /**
     * @param array $author
     *
     * @return array
     */
    public function transform(array $book)
    {
        return [
            'id' => (int) $book['id'],
            'title' => implode(' ', array_map(function ($word) {
                return ucfirst($word);
            }, explode(' ', $book['title']))),
            'publishedAt' => $book['published_at']->format('Y-m-d')
        ];
    }

    /**
     * Include characters.
     *
     * @param array $author
     *
     * @return \League\Fractal\ItemResource
     */
    public function includeAuthor(array $book)
    {
        $author = $book['author'];
        return $this->item($author, new TestAuthorTransformer, false);
    }
}
