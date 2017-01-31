<?php

namespace Elpsy\Fracto\Test;

use Elpsy\Fracto\Fracto;
use Elpsy\Fracto\Test\TestBookTransformer;
use Elpsy\Fracto\Serializers\DataSerializer;
use Illuminate\Support\Collection;

class BookTest extends TestCase
{
    /** @test */
    public function it_can_create_array_of_books()
    {
        $books = $this->data['books'];
        $this->assertNotEmpty($books);
        $this->assertGreaterThan(0, count($books));
    }

    /** @test */
    public function it_can_transform_books_with_constructor()
    {
        $books = $this->data['books'];
        $fracto = new Fracto;
        $data =$fracto->transformer(TestBookTransformer::class)
            ->data($books)
            ->toArray();

        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals(count($data['data']), count($books));
    }

    /** @test */
    public function it_can_transform_book_with_constructor()
    {
        $book = $this->data['books'][0];
        $fracto = new Fracto;
        $data = $fracto->transformer(TestBookTransformer::class)
            ->data([$book])
            ->toArray();
        $this->assertEquals($data['data'][0]['publishedAt'], $book['published_at']->format('Y-m-d'));
    }

    /** @test */
    public function it_can_transform_book_with_static_creator()
    {
        $books = $this->data['books'];
        $data = Fracto::create($books, TestBookTransformer::class)->toArray();
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('data', $data);
        $this->assertEquals(count($data['data']), count($books));
    }

    /** @test */
    public function it_creates_the_same_fractal_with_static_creator()
    {
        $books = $this->data['books'];

        $manual = new Fracto;
        $manual->transformer(TestBookTransformer::class)
            ->data($books);

        $helper = Fracto::create($books, TestBookTransformer::class);

        $this->assertEquals($manual, $helper);
    }

    /** @test */
    public function it_can_transform_book_collection_with_constructor()
    {
        $books = new Collection($this->data['books']);
        $fracto = new Fracto;

        $data = $fracto->transformer(TestBookTransformer::class)
            ->data($books)
            ->includes('author')
            ->toArray();

        $this->assertEquals($books[0]['author']['id'], $data['data'][0]['id']);
    }

    /** @test */
    public function it_can_transform_book_with_include()
    {
        $books = $this->data['books'];
        $fracto = new Fracto;
        $data = $fracto->transformer(TestBookTransformer::class)
            ->data($books)
            ->includes('author')
            ->toArray();

        $this->assertEquals($books[0]['author']['id'], $data['data'][0]['id']);
    }

    /** @test */
    public function it_can_transform_book_with_nested_include()
    {
        $books = $this->data['books'];
        $fracto = new Fracto;
        $data = $fracto->transformer(TestBookTransformer::class)
            ->data($books)
            ->includes('author', 'author.address')
            ->toArray();

        $this->assertEquals($books[0]['author']['address']['id'], $data['data'][0]['author']['address']['id']);
    }
}
