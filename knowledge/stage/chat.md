---
id: stage-chat
entity: stage
title: 'Stage Chat and its connectors'
source: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/README.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage-chat v0.1.1"
public_path: /resources/chat
topic_terms:
  - 'chat contract'
  - connector
  - messages
  - conversation
  - stateless
  - 'stage chat'
  - stream
  - streaming
phrase_terms: []
keywords:
  - 'chat contract'
  - connector
  - messages
  - conversation
  - stateless
  - 'stage chat'
  - stream
  - streaming
links:
  -
    label: 'Stage Chat and its connectors — Stage guide'
    url: 'https://stage.dev/resources/chat'
  -
    label: 'Stage Chat contract and limits'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/README.md'
  -
    label: 'Connector interface'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Connector.php'
  -
    label: 'Request validation'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Request.php'
  -
    label: 'Message validation'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Message.php'
  -
    label: 'Runtime dependencies'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/composer.json'
based_on: []
---

# Stage Chat and its connectors

Applies to Stage Chat 0.1.1. Sources checked on 9 October 2026.

Stage Chat defines a PHP interface for requesting one final answer. Each
request supplies its own conversation context.
`Stage\Chat\Connector::complete(Request $request, ?Closure $cancelled = null)`
returns `Stage\Chat\Response`. The application owns retrieval, conversation
state, authentication, and answer validation.

The package installs with `composer require skyyware/stage-chat:^0.1.1`.
Installing the contract does not contact a provider or require a subscription.
A provider answer needs a connector implementation and the credentials or
other setup required by that service.

`Request` separates trusted application `instructions` from untrusted `context`
and `messages`. Only user and assistant message roles exist. Messages form
a nonempty list ending in a user message. Browser-supplied assistant history
is also untrusted. Role separation is not an authorization system.

| Limit | Value |
| --- | --- |
| Messages per request | 40 |
| Bytes per message | 16,384 |
| Instruction bytes | 16,384 |
| Combined instructions, context, and messages | 131,072 bytes |

Limit incoming HTTP bytes before decoding JSON. Your application can set
smaller limits and choose how much history to include in each request.

`Response::$text` contains the final answer. The contract does not promise
streaming or structured JSON. A connector can request JSON, but the application
must still validate its schema, facts, source IDs, and links.

`Failure` reports `Unavailable`, `Timeout`, `Cancelled`, or `InvalidResponse`
without provider content. Invalid application inputs throw
`InvalidArgumentException`. A cancellation closure returns true to ask the
connector to stop waiting.

The package contains no storage, session IDs, tools, network client, retries,
background jobs, tenant selection, or retrieval engine. It has no dependency
on Stage core or Stage CMS. `skyyware/stage-chat-codex` is a separate connector.
Build the chat interface and application behavior separately.

## Sources

- [Stage Chat contract and limits](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/README.md)
- [Connector interface](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Connector.php)
- [Request validation](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Request.php)
- [Message validation](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/src/Message.php)
- [Runtime dependencies](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/composer.json)
