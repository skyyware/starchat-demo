---
id: starchat-operations
entity: stage
title: 'Operate a Starchat installation'
source: 'https://stage.dev/resources/starchat-operations'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.9.0'
public_path: /resources/starchat-operations
topic_terms:
  - 'starchat operations'
  - 'starchat deploy'
  - 'question handoff'
  - 'starchat limits'
  - 'project limits'
  - 'zip privacy'
  - 'starter cache'
  - 'context privacy'
  - STARCHAT_ASSET_RUNTIME
  - 'read-only runtime'
  - 'PDF temporary directory'
phrase_terms:
  - 'starchat operations'
  - 'starchat deployment'
  - 'question link'
keywords:
  - 'starchat operations'
  - 'starchat deploy'
  - 'question handoff'
  - 'starchat limits'
  - 'project limits'
  - 'zip privacy'
  - 'starter cache'
  - 'context privacy'
  - STARCHAT_ASSET_RUNTIME
  - 'read-only runtime'
  - 'PDF temporary directory'
links:
  -
    label: 'Operate a Starchat installation'
    url: 'https://stage.dev/resources/starchat-operations'
  -
    label: 'Maintain knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
  -
    label: 'Use verified session context'
    url: 'https://stage.dev/resources/starchat-request-context'
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
based_on: {  }
follow_ups: {  }
---

# Operate a Starchat installation

Deploy locked code with its reviewed index and separate private runtime.
The operator owns hosting, model access, notices, and recovery.

`STARCHAT_ASSET_RUNTIME` selects a pre-created writable directory for temporary
PDF and bundle work. It defaults to the application runtime. Keep it private,
outside `public/`, and permit worker writes. The index, capacity, sources, account,
and project archive paths remain unchanged, so the index can stay read-only.

## Check limits and privacy

Chat, custom projects, and summaries share three concurrent requests per runtime. APCu enables an aggregate
twenty-requests-per-minute limit per installation and PHP pool. Verify
`aggregate_rate_limit: true` in `/health` and configure an appropriate edge
limit for a public deployment. Rate limits are not a spending cap.

Building shares chat's model profile and capacity. Its input allows 80 messages
and 24 KiB of serialized conversation within a 192 KiB request. Ordinary chat
allows 64 KiB. Oversized history is rejected without dropping requirements.
See [project limits](https://stage.dev/resources/starchat-building) for file
and archive bounds.

Ordinary chat needs at least 55 seconds at the proxy and PHP worker.
Selection, answering, and review have a 25-second limit within a shared
45-second deadline. The browser allows 50 seconds.

Building needs at least 130 seconds at the proxy and worker. Generation has
a 90-second limit; each review call has a 25-second limit. Review may retry once
if its service is unavailable. All phases must fit the remaining time in the shared
115-second deadline. The browser allows 120 seconds. These bounds promise no
delivery time. Disconnecting may leave provider work running.

In ordinary chat, the browser keeps the conversation until it is reset or cleared.
The model provider receives a bounded history and relevant knowledge. Verify
the actual server, connector, and provider settings before making retention
claims. Never put private records in public answering knowledge.

Project generation sends the conversation and previous files to the model.
Describe this and browser storage in your notices. Temporary ZIPs are removed.
One cache retains the configured public starter, replaced atomically when changed.
The service never executes generated code. Test it locally.

## Recover an interrupted answer

In ordinary chat, the browser can retry an interrupted question after reload or connection loss
once after its sixty-second lease expires. Web Locks let one tab claim the retry.
The question keeps its place; late results cannot replace the recovered answer.
A new conversation cancels recovery.

Completed answers and terminal HTTP or validation errors are not resubmitted
automatically. If the recovery also fails, manual retry remains available.
Without browser storage or Web Locks, temporary tab-only mode still applies.
Closing the browser stops recovery.

Keep version parameters on package JavaScript URLs. They prevent
cached child modules from retaining old behavior after an update.

Optional [session context](https://stage.dev/resources/starchat-request-context)
uses RAM-only history. A scope change or failed session check clears it.
It disables automatic recovery and cannot coexist with building or origin
migration. Summaries and contacts require fresh scope checks; scope changes
revoke their download URLs and clear contact actions. Notices must identify
the provider, transmitted facts, and retention. RAM-only history makes no
provider retention promise.

## Present legal information

Write notices in `legal/en.md` and `legal/de.md`. Use level-two `Legal notice`
and `Privacy`, or `Impressum` and `Datenschutz`, with level-three subsections.
Starchat keeps stable anchors and a combined accessible title, without a duplicate
contents list. `/impressum`, `/privacy`, and `/datenschutz` preserve the language
and open the matching section.

Verify the operator, actual processing, and provider terms for the installation.
The renderer cannot establish legal grounds or a provider agreement.

## Open a question in the demo chat

A link such as `https://chat.stage.dev/?q=How%20do%20I%20install%20Starchat%3F`
opens the question as an editable draft. Loading the page removes `q` from the
address bar and preserves other parameters, the fragment, and saved history.
The visitor chooses when to send it. A populated draft is not overwritten.
The regular website at stage.dev forwards old root links containing `q` to
the chat while preserving their query. Public guides stay on stage.dev.

The question must be a single nonblank value of at most 1,800 Unicode characters.
Invalid or repeated values are removed without becoming a question. It is plain
text, not HTML or an instruction with special access.

Removing a query from the address bar does not remove it from the initial HTTP
request or infrastructure logs. Use public, generic technical questions in
handoff links. Never include a visitor's private conversation, credentials, or
personal details in a URL.

## Release a reviewed change

After a behavior or dependency change, review internal docs and the affected
knowledge articles. Run local checks and execute changed examples. Build the
index and confirm the intended public resources before preparing a release.
Keep credentials, uploads, and runtime files out of the bundle.

Preserve the prior code and index for rollback. After activation, verify the
actual source version, health, guides, a synthetic answer, and a browser journey.
Keep finite test results separate from guarantees of correctness or capacity.

In Starchat 0.2.0, `markdown_sources` is no longer supported. Move approved
material into reviewed installation-owned articles, remove that setting, and
rebuild the index. A remaining external-source configuration fails explicitly.
Do not carry an old connector-built index into the new release.
