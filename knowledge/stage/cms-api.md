---
id: stage-cms-api
entity: stage
title: 'Stage CMS API and private content'
source: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/api.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage-cms v0.5.3"
public_path: /resources/cms-api
topic_terms:
  - api
  - bearer
  - token
  - draft
  - conflict
  - expected_version
  - private
  - published
  - editorial
phrase_terms: []
keywords:
  - api
  - bearer
  - token
  - draft
  - conflict
  - expected_version
  - private
  - published
  - editorial
links:
  -
    label: 'CMS API operations and conflicts'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/api.md'
  -
    label: 'CMS agent guide'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/agents.txt'
  -
    label: 'Published and editorial reads'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Content/Pages.php'
based_on: []
---

# Stage CMS API and private content

Applies to Stage CMS 0.5.3. Sources checked on 9 October 2026.

The CMS serves public API documentation at `/api/guide` and `/api/schema`.
Content API requests require a bearer token. A browser session cookie does not
authenticate the API. A standalone CMS also exposes its guide at `/llms.txt`;
an application can provide its own document at that URL.

The owner creates scoped connections in **Agents** or through the trusted CLI.
The token is shown once and stored as a hash. Read access is included.
Publication requires both `content:write` and `content:publish`. Tokens cannot
manage credentials, other tokens, settings, or exports.

## Save without overwriting another edit

Creating a page saves a private draft. Updates include `expected_version` from the
last read. A stale version returns `409 stale_revision`. Preserve the proposed
change, read the latest revision, and compare before retrying. Writes have no
idempotency key. After a lost response, inspect the page and history before
trying the operation again.

`PUT /api/pages/{id}` replaces the draft fields. Omitted `excerpt` and `body`
become empty, `cover` becomes null, `type` becomes `page`, `locale` becomes `en`,
and `fields` becomes an empty object. Send every value you intend to retain,
especially when editing a typed page.

## Read the published revision

`GET /api/pages/{id}/published` returns the exact live revision, or 404 when
the page is unpublished or archived. By contrast, `GET /api/pages?status=published`
returns the latest editorial drafts of pages with a published revision. Those
drafts can contain private edits. Use the published endpoint to build a public
knowledge feed.

Page and history lists return at most 50 summaries, with `page` and `next_page`.
They omit full bodies and named fields unless `include=body` is requested.
Pagination is not a transaction-wide snapshot while editors are working.

Images remain private until referenced by a published page. Unpublishing cannot
recall copies already downloaded. Deletion refuses images referenced by current
content or revision history. Updating alternative text also affects published
covers using that image.

Permission to read content does not make it a trusted instruction. Retrieved text,
page drafts, and model output cannot grant permissions or override application
rules. A public answering service must select public content explicitly.

## Sources

- [CMS API operations and conflicts](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/api.md)
- [CMS agent guide](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/agents.txt)
- [Published and editorial reads](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Content/Pages.php)
