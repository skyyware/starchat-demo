---
id: starchat-operations
entity: stage
title: 'Operate a Starchat installation'
source: 'https://stage.dev/resources/starchat-operations'
retrieved_at: '2026-10-12'
review_status: reviewed
source_version: 'skyyware/starchat v0.4.6'
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
---

# Operate a Starchat installation

Keep the installation's immutable code and reviewed Markdown separate from its
private writable runtime. Deploy the Composer lockfile and a matching knowledge
index together. The installation owns its host, provider account, privacy notice,
and recovery procedure.

## Check limits and privacy

Chat and custom projects share three concurrent requests per runtime. APCu enables an aggregate
twenty-requests-per-minute limit per installation and PHP pool. Verify
`aggregate_rate_limit: true` in `/health` and configure an appropriate edge
limit for a public deployment. Rate limits are not a spending cap.

Building shares chat's model profile and capacity. Its input allows 80 messages
and 24 KiB of serialized conversation within a 192 KiB request. Ordinary chat
allows 64 KiB. Oversized history is rejected without dropping requirements.
See [project limits](https://stage.dev/resources/starchat-building) for file
and archive bounds.

Allow at least 55 seconds at the proxy and PHP worker. Selection, answering,
and review calls have a 25-second limit. Project generation has a 35-second
limit. Each answer or project shares a 45-second deadline across its phases,
so project review also stops when the remaining time runs out. The browser
gives up at 50 seconds. A disconnected browser does not prove that provider
work stops immediately.

In ordinary chat, the browser keeps the conversation until it is reset or cleared.
The model provider receives a bounded history and relevant knowledge. Verify
the actual server, connector, and provider settings before making retention
claims. Never put private records in public answering knowledge.

Custom project preparation sends the conversation and previous files to the model.
Describe this processing and browser storage in the notices before enabling it.
Temporary ZIPs are removed after each request. Visitor-generated archives are
not kept on the server. A configured public starter has one runtime cache,
replaced atomically when its source changes. Fetching it needs no generation
model call. The service does not run generated code. Review and test files locally.

## Recover an interrupted answer

In ordinary chat, the browser can retry an interrupted question after reload or connection loss
once after its sixty-second lease expires. Web Locks let one tab claim the retry.
The question keeps its place; a late result from the earlier request cannot
replace the recovered answer. Starting a new conversation cancels recovery.

Completed answers and terminal HTTP or validation errors are not resubmitted
automatically. If the recovery also fails, manual retry remains available.
Without browser storage or Web Locks, temporary tab-only mode still applies.
This mechanism does not run requests in the background after the browser closes.

Keep the generated version parameters on package JavaScript URLs. They prevent
cached child modules from retaining old behavior after an update.

Optional [session context](https://stage.dev/resources/starchat-request-context)
uses RAM-only history. A scope change or failed session check clears it.
It disables automatic recovery and cannot coexist with building or origin
migration in 0.4.6. Its notices must identify the context provider, transmitted
facts, and actual retention. Memory-only browser history makes no provider
retention promise.

## Present legal information

Write the installation's notices in `legal/en.md` and `legal/de.md`. Use the
level-two headings `Legal notice` and `Privacy`, or `Impressum` and `Datenschutz`,
with shorter level-three sections underneath. Starchat keeps stable section
anchors and a combined title for assistive technology. The visible page starts
with the individual section headings, without a duplicate contents list.
The `/impressum`, `/privacy`, and `/datenschutz` aliases preserve the selected
language and open the matching section.

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
