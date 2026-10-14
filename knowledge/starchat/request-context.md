---
id: starchat-request-context
entity: stage
title: 'Use verified session context'
source: 'https://stage.dev/resources/starchat-request-context'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.6.7'
public_path: /resources/starchat-request-context
topic_terms:
  - 'request context'
  - 'session context'
  - 'signed session'
  - signed-in
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
  - signed-in
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
follow_ups: {  }
---

# Use verified session context

Starchat 0.6.7 can use verified account or cart facts from a signed-in application.
This optional mode requires an installation-owned context provider. Ordinary chat
remains the default. It does not connect external Markdown folders.

## Verify the session before using its facts

The application authenticates the session and returns a signed token and scope
digest. The browser supplies them with the question. A PHP provider verifies
them before any model call and returns the permitted facts as documents.

Verify the signature, algorithm, issuer, audience, expiry, schema, exact question,
and scope. Decoding alone is insufficient. Browser claims and history cannot
establish access. Read credentials inside the provider from private runtime.

The scope is a digest of 64 lowercase hexadecimal characters without readable
identity. It must change when the account, company, session, or relevant
permissions change. Starchat compares the supplied and verified digests.
Missing or invalid context returns HTTP 403 with `request_context_unavailable`
before model work. The request does not fall back to ordinary chat.

## Provide the endpoint and verifier together

Set `request_context.endpoint` in `installation.json` and supply
`config/request-context.php`; a missing provider is rejected. It returns a closure
accepting `array $envelope`, `Starchat\Conversation $conversation`, and
`Starchat\Installation $installation`, in that order. Return
`Starchat\RequestContext` with verified scope and documents. The installation
owns signing and document conversion.

The endpoint uses HTTPS and a lowercase hostname, without credentials, ports,
query parameters, or fragments. The browser POSTs a form-encoded `question` with
session credentials, no caching or redirects, and an eight-second timeout.
An empty question probes the session. Return only `token` and `scope` in JSON
with `Cache-Control: no-store`. For another origin, allow that exact chat origin
and credentialed requests. Test the application's actual browser session.

`/chat`, `/asset`, `/project`, and `/language` retain gateway cookies through
`credentials: 'same-origin'`; keep them HttpOnly. Those cookies are not verified
application facts. The context endpoint uses `credentials: 'include'`.

Request context cannot be combined with enabled project building or
`migration_origin`. Summaries and contact actions can use fresh verified
context. Enabling context is a separate integration decision.

## Prepare summaries in the same verified scope

After displaying the answer, summary preparation signs the exact last user
question. `/asset` verifies that envelope before any summary model call and
returns `request_scope`. Fresh request documents reach generation and independent
review in full, ahead of public documents with the same ID for contact selection.
Tokens and scope digests stay out of model input.

Before showing a download or contact draft, the browser probes again. A scope
change, failed check, reset, or hidden page cancels preparation, clears contacts,
and revokes download URLs. Late responses cannot restore them. Input stays
usable during these background checks. Explicitly saved downloads remain on the
visitor's device. See [conversation assets](https://stage.dev/resources/starchat-assets).

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

The model receives `request_local` evidence and instructions to prefer current
verified facts over conflicting history. Facts grant no authority to change an
account or place an order. Prices can change after the snapshot.

## Keep context conversations in memory

This conversation stays in the current tab's RAM, without localStorage or
sessionStorage. Reloading starts empty. Earlier public-chat history remains
untouched and is never imported into context mode.

Starchat checks context on load, focus, return to a visible page, and reconnection,
hiding history during checks. Changed or unavailable context clears visible and
pending history, cancels the answer, and discards any question being prepared.
The public input stays editable and opening suggestions visible; the website
link remains available. Submission requires a fresh successful check for the
exact question.

Before showing an answer, the browser checks its `request_scope` and probes the
session again. A changed scope, failed probe, reset, or newer request prevents
an old answer from appearing. Automatic failed-answer recovery is disabled.
An explicit retry obtains fresh context.

## Check privacy and failure cases before adoption

Send only needed facts, the question, and bounded history. Keep tokens, request
bodies, and model input out of logs. RAM-only history cannot erase transmitted
data or establish provider retention. Describe the provider, transmitted facts,
and actual retention in the installation's notices.

Test expired tokens, wrong questions and audiences, scope mismatches, and
unavailable context. Check logout, account and company changes during answers
and summary preparation, reload, and recovery after failed probes. Use synthetic
facts to test grounding and instructions embedded in data. Package tests do not
prove an installation adapter correct.
