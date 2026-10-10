---
id: starchat-operations
entity: stage
title: 'Operate a Starchat installation'
source: 'https://stage.dev/resources/starchat-operations'
retrieved_at: '2026-10-10'
review_status: reviewed
source_version: 'skyyware/starchat v0.2.5'
public_path: /resources/starchat-operations
topic_terms:
  - 'starchat operations'
  - 'starchat deploy'
  - 'question handoff'
  - 'starchat limits'
phrase_terms:
  - 'starchat operations'
  - 'starchat deployment'
  - 'question link'
keywords:
  - 'starchat operations'
  - 'starchat deploy'
  - 'question handoff'
  - 'starchat limits'
links:
  -
    label: 'Operate a Starchat installation'
    url: 'https://stage.dev/resources/starchat-operations'
  -
    label: 'Maintain knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
based_on: {  }
---

# Operate a Starchat installation

Keep the installation's immutable code and reviewed Markdown separate from its
private writable runtime. Deploy the Composer lockfile and a matching knowledge
index together. The installation owns its host, provider account, privacy notice,
and recovery procedure.

## Check limits and privacy

Starchat permits three concurrent requests per runtime. APCu enables an aggregate
twenty-requests-per-minute limit per installation and PHP pool. Verify
`aggregate_rate_limit: true` in `/health` and configure an appropriate edge
limit for a public deployment. Rate limits are not a spending cap.

Allow at least 55 seconds at the proxy and PHP worker. Each model call has a
25-second limit; selection, answering, and review share a 45-second deadline.
The browser gives up at 50 seconds. A disconnected browser does not prove that
provider work stops immediately.

The browser keeps the visible conversation until it is reset or cleared.
The model provider receives a bounded history and relevant knowledge. Verify
the actual server, connector, and provider settings before making retention
claims. Never put private records in public answering knowledge.

## Recover an interrupted answer

After a reload or connection loss, the browser can retry an interrupted question
once after its sixty-second lease expires. Web Locks let one tab claim the retry.
The question keeps its place; a late result from the earlier request cannot
replace the recovered answer. Starting a new conversation cancels recovery.

Completed answers and terminal HTTP or validation errors are not resubmitted
automatically. If the recovery also fails, manual retry remains available.
Without browser storage or Web Locks, temporary tab-only mode still applies.
This mechanism does not run requests in the background after the browser closes.

Keep the generated version parameters on package JavaScript URLs. They prevent
cached child modules from retaining old behavior after an update.

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
