---
id: stage-codex-connector
entity: stage
title: 'Codex connector configuration and limits'
source: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/README.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage-chat-codex v0.2.3"
public_path: /resources/codex-connector
topic_terms:
  - codex
  - fast
  - ultrafast
  - reasoning
  - provider
  - retention
  - cli
phrase_terms: []
keywords:
  - codex
  - fast
  - ultrafast
  - reasoning
  - provider
  - retention
  - cli
links:
  -
    label: 'Codex connector configuration and limits — Stage guide'
    url: 'https://stage.dev/resources/codex-connector'
  -
    label: 'Connector overview'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/README.md'
  -
    label: 'Operation and verification limits'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/docs/operations.md'
  -
    label: 'Supported executable versions'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Codex.php'
  -
    label: 'Options and limits'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Options.php'
  -
    label: 'Execution profile'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Profile.php'
based_on: []
---

# Codex connector configuration and limits

Applies to Stage Chat Codex 0.2.3. Sources checked on 9 October 2026.

`skyyware/stage-chat-codex` implements the Stage Chat interface with one Codex
CLI process per request. It returns a final JSON object as text, not a stream
of partial answers. Its verified executable allowlist contains Codex CLI
0.159.2, 0.159.3, and 0.160.0. Other versions fail before receiving conversation
data. This list records compatibility with the package. It does not identify
the latest CLI release.

`Options` requires an absolute executable path, a private Codex home, a separate
empty working directory, a model, and a trusted output-schema file. The two
directories must have mode 0700. The JSON schema must describe an object and
fit within 64 KiB. PHP must permit process execution and access to those paths.
The package does not create accounts or provision credentials.

The default deadline is 25 seconds and covers startup, version checking,
and completion. Output and stderr share a default limit of 256 KiB.
The application sets rate limits, controls concurrent requests, and sets
HTTP deadlines.
Each completion occupies a PHP worker while its child process runs.

Instructions, schema, model, reasoning, and service tier belong to trusted
application configuration. Context and messages are sent through stdin.
The connector checks the process protocol and that the answer is a JSON object.
The application still checks the answer's shape, sources, links, and meaning.

## Reasoning and speed

Reasoning effort defaults to `low`. Supported local choices are `none`,
`minimal`, `low`, `medium`, `high`, and `max`. The selected model must support
the requested value. Automatic delegation mode `ultra` is rejected.

The default service tier is null. Explicit `fast` requests Fast Mode, which
the verified CLI maps to provider `priority`. `ultrafast` requires a protected,
explicit model catalog advertising the exact model, reasoning, and tier.
The connector does not silently switch models or retry with another tier.

The catalog lists advertised capabilities. It does not prove that an account
can use them. A successful answer does not confirm which tier the provider
served or guarantee a response time. The interface returns no
provider-confirmed model or tier data.
Availability and usage terms depend on the approved account and service.

## Privacy and execution

The connector writes no prompt or answer files and disables tools, browser
access, plugins, hooks, memories, and delegation in its verified CLI profile.
It uses ephemeral execution and sends `store: false` in the tested provider
request. The CLI still creates authentication and metadata files.

The provider receives the supplied conversation and context. `store: false`
is not a promise of zero provider retention. Account policies, infrastructure
logs, crash dumps, and backups remain separate concerns. Do not send private
documents merely because a connector can read the supplied string.

The repository's wire probe runs the actual executable against a test server
and checks the request it sends. It makes no real provider call, so it does not
test authentication, answer quality, production capacity, or provider retention.
Record that result separately from a test question sent to the actual provider.

## Sources

- [Connector overview](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/README.md)
- [Operation and verification limits](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/docs/operations.md)
- [Supported executable versions](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Codex.php)
- [Options and limits](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Options.php)
- [Execution profile](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/src/Profile.php)
