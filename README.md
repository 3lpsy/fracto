# Fractal Wrapper

A framework agnostic wrapper for Fractal with fluent API.
The package is relatively small and has weak test coverage.


## Usage

Constructing the wrapper:

```
$books = Books::all();

$fracto = new Fracto;

$data =$fracto->transformer(TestBookTransformer::class)
    ->data($books)
    ->toArray();

```

Using a static constructor
```
$data = Fracto::create($books, TestBookTransformer::class)->toArray();
```

Using the helper
```
$data = fracto($books, TestBookTransformer::class)->toArray();
```


Including data

```
$fracto = new Fracto;
$data = $fracto->transformer(TestBookTransformer::class)
    ->data($books)
    ->includes('author', 'author.address')
    ->toArray();

```

Setting the Resource Key

```
$fracto = new Fracto;

$data =$fracto->transformer(TestBookTransformer::class)
    ->key('book')
    ->data($books)
    ->toArray();

// the key function will set the item and resource key (plural) for the the top level resource
```

Remove "data" key from includes

```
// setting the third argument of item or collection to false, drops the resource key for the includes
public function includeAuthor(array $book)
{
    $author = $book['author'];
    return $this->item($author, new TestAuthorTransformer, false);
}
```

## Architecture

### Manager

The Fracto manager is your primary api interface with the Package. The Fracto manager
will pass relevant data to the presenter.

### Presenter

The Presenter wraps the Fractal manager and calls the transformation.

### Transformer

The Transformer dictates how the array or object will be transformed.
