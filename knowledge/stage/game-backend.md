---
id: stage-game-backend
entity: stage
title: 'Build a game with a Stage HTTP backend'
source: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/getting-started.md'
source_title: 'Stage routes and JSON input'
retrieved_at: '2026-10-17'
review_status: reviewed
source_version: 'skyyware/stage v0.2.0'
public_path: /resources/game-backend
topic_terms:
  - game
  - games
  - gaming
  - spiel
  - spiele
  - quiz
  - multiplayer
  - turn-based
  - rundenbasiert
phrase_terms:
  - 'build a game'
  - 'ein Spiel bauen'
keywords:
  - browser
  - realtime
  - real-time
  - move
  - server
links:
  -
    label: 'Game backend example'
    url: 'https://stage.dev/resources/game-backend'
  -
    label: 'Stage routes and JSON validation'
    url: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/getting-started.md'
  -
    label: 'Stage application boundaries'
    url: 'https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/design.md'
based_on: {  }
follow_ups: {  }
---

# Build a game with a Stage HTTP backend

Stage can provide the PHP backend for a game. The browser or a separate game
engine handles rendering, input, and the playable loop. Stage 0.2.0 provides
HTTP routing and JSON messages. It does not provide graphics, physics, a game
loop, or WebSocket multiplayer.

For a first game, choose one playable action. A quiz can fetch a question and
submit an answer. A turn-based game can send a move, validate it on the server,
and return the new state. These are application designs, not ready-made Stage
game packages. A single-player browser prototype may need no PHP server yet.

The choice between turn-based and real-time play changes the backend design.
For turn-based play, a request can carry one move and return its result.
Real-time play needs a separately designed transport and update loop.

## Start with one quiz question

Install Stage with PHP 8.4 or a later PHP 8 release and Composer:

```sh
mkdir quiz
cd quiz
composer require skyyware/stage:^0.2
mkdir public
```

Create `public/index.php`:

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
    Route::get('/quiz', fn () => Response::json([
        'question' => 'How many sides does a hexagon have?',
    ])),
    new Route('POST', '/quiz/answer', function (Request $request): Response {
        $input = $request->json();
        if (!is_array($input) || !is_int($input['answer'] ?? null)) {
            throw new HttpError(422);
        }

        return Response::json(['correct' => $input['answer'] === 6]);
    }),
))->run();
```

Start the local development server from the application directory:

```sh
php -S 127.0.0.1:8080 -t public public/index.php
```

`GET /quiz` returns status 200 with the question. To submit an answer:

```sh
curl -i http://127.0.0.1:8080/quiz/answer \
    -H 'Content-Type: application/json' \
    -d '{"answer":6}'
```

Expect status 200 and `{"correct":true}`. Answer 5 returns
`{"correct":false}`. A string such as `"6"`, a missing answer, or an invalid
shape returns 422. Malformed JSON returns 400. Stop the development server
with Ctrl+C. Production must serve only `public/`.

This example has one fixed question and no player identity, saved scores,
rate limiting, or durable state. It is a first backend feature, not a complete
game. The server checks the answer rather than accepting a score chosen by
the client.

## Add shared state deliberately

For a turn-based multiplayer game, store the game state and a version in your
chosen database. Authenticate the player, check whose turn it is, validate the
move, and commit the update in a transaction that rejects a stale version.
These responsibilities belong to your application. Stage's caller permission
value does not supply login, storage, or concurrency control.

For real-time multiplayer, choose and test a separate transport and game server
for live state updates. Stage may still handle HTTP functions around it, such
as loading account data through your own authenticated application. The core
does not provide arbitrary response streaming or worker lifecycle guarantees.
No production capacity or latency is established by this quiz example.

## Sources

- [Stage routes and JSON validation](https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/getting-started.md)
- [Stage application boundaries](https://github.com/skyyware/stage/blob/0a11702bfc66e088f9717b32b87e2e1bcf48ae03/docs/design.md)
