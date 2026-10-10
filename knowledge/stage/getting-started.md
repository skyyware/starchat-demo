---
id: stage-getting-started
entity: stage
title: 'Create a Stage application'
source: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/README.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: /resources/getting-started
topic_terms:
  - 'getting started'
  - installation
  - install
  - composer
  - 'first application'
  - einstieg
  - start
  - setup
phrase_terms: []
keywords:
  - 'getting started'
  - installation
  - install
  - composer
  - 'first application'
  - einstieg
  - start
  - setup
links:
  -
    label: 'Stage installation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/README.md'
  -
    label: 'First HTTP application and checks'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/getting-started.md'
  -
    label: 'Application implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Application.php'
based_on: []
---

# Create a Stage application

Build a PHP endpoint that returns JSON. This example uses Stage 0.1.5 and
PHP 8.4 or a later PHP 8 release. Sources checked on 9 October 2026.

## Install the framework

With PHP and Composer installed, run:

```sh
mkdir stage-app
cd stage-app
composer require skyyware/stage:^0.1.5
mkdir public
```

Composer downloads Stage from Packagist without a GitHub sign-in or a custom
repository setting. Keep the generated `composer.lock`.

## Add the endpoint

Create `public/index.php`:

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

From the application directory, start the local server:

```sh
php -S 127.0.0.1:8080 -t public public/index.php
```

Open `http://127.0.0.1:8080`. Expect status 200 and `{"hello":"world"}`.
Press Ctrl+C in the terminal to stop the server. PHP's built-in server is
for development. A public server must expose only `public/`.

## Check a response without a server

Create `check.php` in the application directory:

```php
<?php
declare(strict_types=1);

use Stage\Http\Application;
use Stage\Http\Request;
use Stage\Http\Response;
use Stage\Http\Route;

require __DIR__ . '/vendor/autoload.php';

$app = new Application(
	Route::get('/', fn () => Response::json(['hello' => 'world'])),
);
$response = $app->handle(new Request('GET', '/'));
if ($response->status !== 200 || $response->body !== '{"hello":"world"}') {
	throw new RuntimeException('Unexpected response.');
}
echo 'Response checked', PHP_EOL;
```

Run `php check.php`. Expect `Response checked`. `handle()` returns a response
without sending headers or output. Use it to test your own routes, including
rejected input and denied access.

Add your own test tools and scripts. Installing Stage does not add a
`composer check` command to your application.

## Sources

- [Stage installation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/README.md)
- [First HTTP application and checks](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/getting-started.md)
- [Application implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/Application.php)
