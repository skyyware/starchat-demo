---
id: stage-framework
entity: stage
title: 'What Stage does'
source: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/design.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: /resources/framework
topic_terms:
  - framework
  - architecture
  - caller
  - permissions
  - orm
  - queue
  - persistence
  - scaling
phrase_terms: []
keywords:
  - framework
  - architecture
  - caller
  - permissions
  - orm
  - queue
  - persistence
  - scaling
links:
  -
    label: 'Stage design and limits'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/design.md'
  -
    label: 'Compose features'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/features.md'
  -
    label: 'Caller implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Security/Caller.php'
based_on: []
---

# What Stage does

Applies to Stage 0.1.5. Sources checked on 9 October 2026.

Stage provides an HTTP router, request and response objects, file transfer
helpers, and optional permission checks. Keep your application's rules in PHP
objects and pass their dependencies through constructors.

An HTTP handler passes input to an application operation and turns its result
into a response. The operation validates input, checks access, and applies
the application's rules. Commands and agent adapters can call that same
operation without going through HTTP.

## Check permissions inside the operation

`Stage\Security\Caller` carries an identity and a list of exact permission
strings. `require()` throws `Forbidden` when a permission is missing.
It does not authenticate anyone, support wildcard permissions, or decide
which tenant or record a caller can access. The application establishes the
caller from trusted credentials and checks resource access inside the operation.

A feature can define a PHP interface for another feature to call.
The Counter and Reports example stores a count in memory. It shows how to
connect features, not how to persist data or handle concurrent writes.

## Choose the other libraries your application needs

Stage has no built-in ORM, database, queue, session system, template language,
dependency injection container, or model provider. Applications can choose
libraries for those jobs. Stage does not implement PSR-7 or PSR-15.

An immutable router does not make the objects used by its handlers immutable.
If a worker reuses a handler for several requests, those requests may share
the object's state. Design worker lifecycles and any distributed transactions
for your application. Measure its behavior before scaling across servers
or claiming a production capacity.

## Sources

- [Stage design and limits](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/design.md)
- [Compose features](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/features.md)
- [Caller implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Security/Caller.php)
