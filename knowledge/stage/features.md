---
id: "stage-features"
entity: "stage"
title: "Compose features"
source: "https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/features.md"
retrieved_at: "2026-10-09"
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: "/resources/features"
topic_terms: ["features", "permissions", "services", "contracts"]
keywords: ["features", "permissions", "services", "contracts"]
links: [{"label": "Compose features source", "url": "https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/features.md"}]
based_on: []
---

# Compose features

In Stage 0.1.5, a feature can be an ordinary PHP object. Put input validation
and permission checks in the operation that owns the data. HTTP routes,
commands, and agent adapters can then call the same operation.

## Keep access checks with the operation

Use `Stage\Security\Caller::require()` before reading or changing protected
state. Obtain the caller from trusted authentication code. A `Caller` carries
an identity and exact permission strings; it does not authenticate anyone.
Permissions have no wildcard matching. Your application also checks which
resource and tenant the caller may access.

Pass narrow interfaces into other features when they need only part of an
operation. A reporting feature can receive a read interface without receiving
the write method. PHP types make the intended dependency visible, but they do
not prevent direct database access elsewhere in your application.

## Translate errors at the entry point

`require()` throws `Stage\Security\Forbidden` when permission is absent.
An HTTP adapter must catch it and return a 403 response. Stage's `Application`
does not make that translation for you; an uncaught exception reaches the
generic 500 response in `run()`.

Keep validation and permission checks usable outside HTTP. Test successful,
denied, and malformed calls, and verify that rejected writes leave state
unchanged. The versioned tutorial linked below builds a counter and a report
and exercises all three cases.

## Choose storage separately

The tutorial counter lives in memory for one command invocation. It supplies
no persistence, transactions, concurrency control, or tenant storage.
Create mutable request state per request. An immutable router does not make
a mutable object captured by a handler safe to share between requests.

Stage does not include an ORM, queue, or application service container.
Add those only when the application needs them. For a reusable group of HTTP
routes, see [Create an idea](https://stage.dev/resources/extensions).
