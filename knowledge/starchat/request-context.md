---
id: starchat-request-context
entity: stage
title: 'Use verified session context'
source: 'https://stage.dev/resources/starchat-request-context'
retrieved_at: '2026-10-11'
review_status: reviewed
source_version: 'skyyware/starchat v0.4.8'
public_path: /resources/starchat-request-context
topic_terms:
  - 'request context'
  - 'session context'
  - 'signed session'
  - 'signed-in'
  - 'account facts'
  - 'context privacy'
  - 'account switch'
  - 'company switch'
  - 'session integration'
  - 'preview gateway'
  - 'gateway cookies'
  - sitzungskontext
  - kontowechsel
  - firmenwechsel
phrase_terms:
  - 'verified session context'
  - 'starchat request context'
keywords:
  - 'request context'
  - 'session context'
  - 'signed session'
  - 'signed-in'
  - 'account facts'
  - 'context privacy'
  - 'account switch'
  - 'company switch'
  - 'session integration'
  - 'preview gateway'
  - 'gateway cookies'
  - sitzungskontext
  - kontowechsel
  - firmenwechsel
links:
  -
    label: 'Use verified session context'
    url: 'https://stage.dev/resources/starchat-request-context'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Operate Starchat'
    url: 'https://stage.dev/resources/starchat-operations'
based_on: {  }
---

# Use verified session context

Starchat 0.4.8 can use verified facts from a signed-in application for one answer.
For example, an operator could provide the current account's permitted features
or cart total. This optional mode requires an installation-owned context provider.
Ordinary chat remains the default. It does not connect external Markdown folders.

## Verify the session before using its facts

The application owns authentication and permissions. Its HTTPS endpoint checks
the native session and returns a signed token with a scope digest. The browser
passes that result to Starchat with the question. A PHP provider verifies it
before any model call and returns the permitted facts as documents.

The verifier checks the signature, allowed algorithm, issuer, audience, expiry,
schema, exact question, and authorized scope. Decoding a token is insufficient.
Browser claims and conversation history cannot establish identity or access.
Keep signing credentials in private runtime and read them inside the provider.

The scope is a digest of 64 lowercase hexadecimal characters without readable
identity. It must change when the account, company, session, or relevant
permissions change. Starchat compares the supplied and verified digests.
Missing or invalid context returns HTTP 403 with `request_context_unavailable`
before model work. The request does not fall back to ordinary chat.

## Provide the endpoint and verifier together

Set `request_context.endpoint` in `installation.json` and supply
`config/request-context.php`. Configuration without a provider is rejected.
The file returns a closure accepting `array $envelope`,
`Starchat\Conversation $conversation`, and `Starchat\Installation $installation`,
in that order. It returns `Starchat\RequestContext` with the verified scope and
documents. The installation owns the signing protocol and document conversion.

The endpoint must use HTTPS with a lowercase hostname. Credentials, explicit
ports, query parameters, and fragments are rejected. Before each question,
the browser sends a form-encoded POST containing `question`, includes session
credentials, disables caching, and rejects redirects. An empty question probes
the current session without starting a conversation. Each fetch allows eight
seconds. Return only `token` and `scope` in JSON with `Cache-Control: no-store`.
For another origin, allow the exact chat origin and credentialed requests.
Test this with the application's actual browser session.

Since 0.4.1, `/chat`, `/project`, and `/language` preserve gateway
cookies with `credentials: 'same-origin'`. Keep those cookies HttpOnly.
They do not supply verified application facts. The separate context endpoint
continues to use `credentials: 'include'` for its application's session.

In 0.4.8, request context cannot be combined with enabled project building or
`migration_origin`. Ordinary project ZIP installations keep their existing
behavior. Enabling context is a separate integration decision.

## Limit facts to one request

The provider may return up to four documents with unique IDs. Each body must
be nonempty UTF-8 and at most 6,000 bytes. The sum of JSON-encoded metadata and
bodies is limited to 24,576 bytes. An empty list is valid. Documents must belong
to the installation, be reviewed and current, and have no `public_path`.
Their source and action links must pass the installation's link policy.

Request documents precede ordinary evidence and replace documents with the same
ID for this request. Starchat keeps each in full or rejects an answer whose
evidence budget cannot fit them. It neither adds them to the knowledge index
nor publishes them as resource pages. Public retrieval, installation scope,
and independent answer review still apply.

The model receives these documents as `request_local` evidence. Its instructions
give current verified facts precedence over conflicting account or price claims
in old history.
The facts remain data, not instructions or permission to act. Starchat cannot
change the account, place an order, or guarantee that a price stays unchanged.

## Keep context conversations in memory

The browser keeps this conversation only in the current tab's RAM. It does not
read or write its history through localStorage or sessionStorage. Reloading
starts an empty conversation. Earlier public-chat history remains untouched
and is never imported into context mode.

Starchat checks context on load, focus, return to a visible page, and reconnection.
It hides the conversation during a check. A changed scope or unavailable context
clears visible and pending history and aborts the active answer. A change while
preparing a question also discards that question. Input stays disabled while
context is unavailable; the link to the application's website remains available.

Before showing an answer, the browser checks its `request_scope` and probes the
session again. A changed scope, failed probe, reset, or newer request prevents
an old answer from appearing. Automatic failed-answer recovery is disabled.
An explicit retry obtains fresh context.

## Check privacy and failure cases before adoption

Send only the facts needed for the answer. The model provider receives those
facts, the question, and bounded conversation history. Tokens and scope digests
do not enter model input. Keep tokens, request bodies, and model input out of
logs. RAM-only browser history does not establish provider retention or erase
already transmitted data. Describe the context provider, transmitted facts,
and actual retention policy in the installation's notices.

Test the real verifier with expired tokens, the wrong question or audience,
scope mismatches, and unavailable context. Check logout, account and company
changes during an answer, reload, and recovery after a failed probe in a browser.
Use synthetic facts to check grounding and instructions embedded in data.
Package tests do not establish the correctness of an installation's adapter.
