---
id: "stage-tutorial"
entity: "stage"
title: "Build your first HTTP application"
source: "https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/getting-started.md"
retrieved_at: "2026-10-09"
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: "/resources/first-http-application"
topic_terms: ["first application", "tutorial", "getting started", "json", "routing"]
keywords: ["first application", "tutorial", "getting started", "json", "routing"]
links: [{"label": "Build your first HTTP application source", "url": "https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/getting-started.md"}]
based_on: []
---

# Build your first HTTP application

Build a named greeting route and a JSON endpoint with Stage 0.1.5.
Start with the Composer project in [Create a Stage application](https://stage.dev/resources/getting-started).

## Add the routes

Replace `public/index.php` with this complete example:

```php
<?php
declare(strict_types=1);

use Stage\Http\Application;
use Stage\Http\HttpError;
use Stage\Http\Request;
use Stage\Http\Response;
use Stage\Http\Route;

require dirname(__DIR__) . '/vendor/autoload.php';

(new Application(
	Route::get('/hello/{name}', fn (Request $request) => Response::json([
		'hello' => $request->parameters['name'],
	])),
	new Route('POST', '/hello', function (Request $request): Response {
		$data = $request->json();
		if (!is_array($data) || !is_string($data['name'] ?? null) || trim($data['name']) === '') {
			throw new HttpError(422);
		}
		return Response::json(['hello' => trim($data['name'])]);
	}),
))->run();
```

The named GET route reads the decoded `name` segment. The POST route accepts
a nonblank string in JSON. `Request::json()` rejects malformed JSON before
the handler checks the value.

## Run the application

From your project directory, start the development server:

```sh
php -S 127.0.0.1:8080 -t public public/index.php
```

In another terminal, run:

```sh
curl -i http://127.0.0.1:8080/hello/Ada%20Lovelace
curl -i http://127.0.0.1:8080/hello -H 'Content-Type: application/json' -d '{"name":"Ada"}'
```

Both return status 200. The bodies are `{"hello":"Ada Lovelace"}` and
`{"hello":"Ada"}` respectively.

## Check failures

Repeat the POST request with `-d '{'`. Expect 400 and `{"error":400}`.
Use `-d '{"name":42}'` or `-d '{"name":" "}'`. Both return 422 and
`{"error":422}`. The handler checks the name's shape as well as its presence.

GET `/hello` returns 405 with `Allow: OPTIONS, POST`. An unknown path returns
404. Press Ctrl+C to stop the server. Expose only `public/` on a public host;
PHP's built-in server is for development.

For a check without a server, construct the same `Application` and call
`handle(new Request(...))`. Check both status and body before changing the
example. See [HTTP routing](https://stage.dev/resources/http) for body limits
and method handling.
