---
id: stage-extensions
entity: stage
title: 'Extend Stage with an idea'
source: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/ideas.md'
retrieved_at: '2026-10-17'
review_status: reviewed
source_version: 'skyyware/stage v0.2.0'
public_path: /resources/extensions
topic_terms:
  - extend
  - extension
  - idea
  - plugin
  - reuse
  - erweitern
  - 'composer package'
phrase_terms: {  }
keywords:
  - extend
  - extension
  - idea
  - plugin
  - reuse
  - erweitern
  - 'composer package'
links:
  -
    label: 'Share an idea'
    url: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/ideas.md'
  -
    label: 'Idea interface'
    url: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/src/Http/Idea.php'
  -
    label: 'Application route composition'
    url: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/src/Http/Application.php'
  -
    label: 'Extend Stage with an idea — Stage guide'
    url: 'https://stage.dev/resources/extensions'
based_on: {  }
follow_ups: {  }
---

# Extend Stage with an idea

An idea is reusable PHP code with a defined interface. For HTTP routes,
implement `Stage\Http\Idea` and pass the object to `Application`.
The interface is available from Stage 0.1.4.

This example builds a greeting route with Stage 0.2.0.
Sources checked on 17 October 2026.

## Write the idea

In an application with Stage installed through Composer, create `idea.php`:

```php
<?php
declare(strict_types=1);

use Stage\Http\Application;
use Stage\Http\Idea;
use Stage\Http\Request;
use Stage\Http\Response;
use Stage\Http\Route;

require __DIR__ . '/vendor/autoload.php';

final readonly class Greeting implements Idea
{
	public function __construct(private string $greeting) {}

	/** @return list<Route> */
	public function routes(): array
	{
		return [Route::get('/hello/{name}', fn (Request $request) =>
			Response::json(['message' => $this->greeting . ' ' . $request->parameters['name']]))];
	}
}

$app = new Application(new Greeting('Hello'));
$response = $app->handle(new Request('GET', '/hello/Sam'));
if ($response->status !== 200 || $response->body !== '{"message":"Hello Sam"}') {
	throw new RuntimeException('Unexpected greeting.');
}
echo $response->body, PHP_EOL;
```

Run `php idea.php`. Expect `{"message":"Hello Sam"}` without a web server.
The return annotation lets static analysis check that `routes()` returns
a list of `Route` objects.

## Reuse the code

Move `Greeting` into your library's namespace and `src/` directory.
Register its PSR-4 namespace in `composer.json`. Require a Stage version
that includes the interfaces you use. The host application installs the
library through Composer, constructs the idea, and passes it to `Application`.

`Application` reads each idea's routes once, during construction.
It rejects duplicate route shapes across ideas and ordinary routes.
Use constructors for dependencies. Keep migrations and data writes out of
`routes()`.

For work outside HTTP, use an ordinary PHP interface. CMS page types, themes,
and publication rules have their own interfaces. Reusable classes do not all
need to implement `Idea`.

Document the supported package versions, constructor arguments, routes,
permissions, state location, tests, and upgrade steps. Add an actual license
and changelog before distributing the library.

Stage does not scan directories or install ideas from page content.
It has no marketplace or global hook registry. You choose which Composer
packages to install and which objects to pass to the application.
Review those packages as executable PHP. An idea does not run in a sandbox.

## Sources

- [Share an idea](https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/ideas.md)
- [Idea interface](https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/src/Http/Idea.php)
- [Application route composition](https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/src/Http/Application.php)
