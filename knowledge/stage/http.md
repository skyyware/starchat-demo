---
id: stage-http
entity: stage
title: 'HTTP routing and request limits'
source: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/http.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: /resources/http
topic_terms:
  - routing
  - routes
  - request
  - response
  - json
  - head
  - options
  - http
phrase_terms: []
keywords:
  - routing
  - routes
  - request
  - response
  - json
  - head
  - options
  - http
links:
  -
    label: 'HTTP routing and request limits — Stage guide'
    url: 'https://stage.dev/resources/http'
  -
    label: 'HTTP reference'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/http.md'
  -
    label: 'Request implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Request.php'
  -
    label: 'Application implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Application.php'
  -
    label: 'Response implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Response.php'
based_on: []
---

# HTTP routing and request limits

Applies to Stage 0.1.5. Sources checked on 9 October 2026.

`Stage\Http\Application` accepts `Route` and `Idea` objects.
`Route::get()` constructs a GET route. `new Route('POST', '/path', $handler)`
constructs a route for another method. A handler receives `Request` and
returns `Response`.

## Return JSON from a GET route

With PHP 8.4 or a later PHP 8 release, install `skyyware/stage:^0.1.5`
through Composer. Create `public/index.php`:

```php
<?php
declare(strict_types=1);

use Stage\Http\Application;
use Stage\Http\Response;
use Stage\Http\Route;

require dirname(__DIR__) . '/vendor/autoload.php';

(new Application(
    Route::get('/', fn () => Response::json(['hello' => 'world'])),
))->run();
```

`Response::json()` encodes the value and sets the JSON content type.
It returns status 200 unless you pass another status as its second argument.
The handler above needs no request data, so it declares no argument.

From the project directory, run:

```sh
php -S 127.0.0.1:8080 -t public public/index.php
```

Open `http://127.0.0.1:8080/`. The response is `{"hello":"world"}` with
status 200. Stop the development server with Ctrl+C. For production, configure
your web server to expose only `public/`.

## Match paths and methods

A named parameter fills one path segment, such as `{slug}` in `/pages/{slug}`.
The handler reads `$request->parameters['slug']`. Values are decoded once.
Decoded slashes, backslashes, control characters, and empty values do not match.
Parameter values still need application validation.

The router checks literal paths before named patterns. Other overlapping
patterns use registration order. `Application` rejects duplicate method and
path shapes during construction, even when only the parameter names differ.
A method mismatch does not fall through to a less specific path.

| Request | Behavior |
| --- | --- |
| Unknown path | 404 |
| Unsupported method on a known path | 405 with `Allow` |
| OPTIONS on a known path | 204 with `Allow` |
| HEAD without a dedicated HEAD route | Uses the GET handler; `run()` omits the response body |

Applications cannot register their own OPTIONS route. A GET handler may also
run for HEAD, so it must account for side effects such as download counters.

## Validate input

`Request::json()` decodes JSON into PHP values. Malformed JSON throws
`HttpError(400)`. Valid JSON can be a scalar, array, or null. The application
must validate the required shape and values before using them.

`Application::run()` and `Request::fromGlobals()` default to a raw body limit
of 1,048,576 bytes, or 1 MiB. Oversized raw input produces 413. This limit does
not cover PHP-parsed multipart uploads. Server and PHP limits remain separate.

## Handle errors and output

`handle()` converts a handler's `HttpError` into a JSON error with the same
status. Unexpected exceptions escape `handle()`. `run()` catches them and
returns a generic 500. `Stage\Security\Forbidden` is not an `HttpError`:
the HTTP adapter must translate it into 403.

Ordinary response bodies are buffered strings. HTML output is not escaped
automatically. Each response header has one string value; repeated
`Set-Cookie` headers and arbitrary response streaming are unsupported.

## Sources

- [HTTP reference](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/http.md)
- [Request implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Request.php)
- [Application implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Application.php)
- [Response implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Response.php)
