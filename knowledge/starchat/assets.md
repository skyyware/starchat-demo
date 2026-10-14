---
id: starchat-assets
entity: stage
title: 'Offer a project, PDF summary, or email draft'
source: 'https://stage.dev/resources/starchat-assets'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.5.0'
public_path: /resources/starchat-assets
topic_terms:
  - 'conversation assets'
  - 'optional assets'
  - 'asset type'
  - 'PDF summary'
  - 'conversation summary'
  - 'email draft'
  - mailto
  - 'PDF Zusammenfassung'
  - 'E-Mail Entwurf'
  - 'no download'
  - 'topic links'
phrase_terms:
  - 'disable assets'
  - 'PDF from conversation'
  - 'prepare email'
  - 'start from a topic'
keywords:
  - 'conversation assets'
  - 'optional assets'
  - 'asset.type'
  - 'PDF summary'
  - 'conversation summary'
  - 'email draft'
  - mailto
  - 'PDF Zusammenfassung'
  - 'E-Mail Entwurf'
  - 'topic links'
  - progress
  - branding
  - languages
links:
  - label: 'Offer a project, PDF summary, or email draft'
    url: 'https://stage.dev/resources/starchat-assets'
  - label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  - label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
based_on: { }
---

# Offer something to take away

An installation can offer a project ZIP, a PDF summary, or an email draft.
Assets are off by default. Set one `asset.type` in `installation.json`:

| Setting | Result |
| --- | --- |
| No `asset`, or `{"type":"none"}` | No asset control or summary preparation |
| `{"type":"project"}` | Current project ZIP; also requires `building.enabled` |
| `{"type":"pdf"}` | Reviewed conversation summary as a PDF |
| `{"type":"email","recipient":"hello@example.org"}` | Editable draft in the visitor's mail app |

PDF and email do not require project building. These settings belong to the
operator; visitor messages cannot change the type or recipient. Installations
using verified session context cannot enable assets.

When upgrading a building installation from 0.4.x, explicitly set
`asset.type: project` to retain its visible ZIP download. Setting assets to
`none` does not disable an independently enabled project-building API. To
disable both, remove `asset` and `building`.

## Keep the result current

After a completed answer, the browser prepares the selected asset automatically.
A new question hides the previous ZIP or PDF. Preparation shows a progress
indicator without an invented percentage or completion time. The download
appears only when the current result is ready. Clicking it starts no model call.
An unavailable result offers a manual retry.

A reset, language change, or newer conversation state prevents an older result
from replacing the current one. PDF and email summaries remain in browser memory.
Reloading can prepare them again. Project ZIPs use their separate browser-storage
entry and retain earlier files as revision input; see
[project downloads](https://stage.dev/resources/starchat-building).

## Prepare a faithful summary

The summary generator receives the bounded conversation and trusted installation
scope. A separate reviewer checks the result before it is released. Both preserve
speaker attribution, later corrections, uncertainty, and unresolved decisions.
A proposal is not an agreement; an appointment request is not a confirmation.
Review checks faithfulness to the conversation, not the truth of every claim.

Only useful exact links already in the conversation and accepted by the
installation's link policy can appear. Links are optional. Summary generation
does not retrieve private documents or add new knowledge.

Input permits 80 messages and 24 KiB of serialized conversation. Generation and
review share a 45-second deadline, with no automatic model retry. The browser
allows 60 seconds for preparation. Capacity is shared with chat and building.
These are limits, not a delivery promise.

## Use installation branding in PDFs

PDFs use local logos, brand colors, and supported local fonts. They contain the
summary, key points, next steps, optional links, date, and page numbers. A short
note identifies the content as conversation guidance, not official confirmation.

Latin, Greek, and Cyrillic text are supported when their glyphs are available.
Arabic, other complex scripts, and missing glyphs fail explicitly. The visitor
can choose a German PDF instead; the service does not silently translate.
Source Sans and Roboto Slab have PDF fonts. D-DIN and system-font selections use
DejaVu in PDFs. The current output is not tagged for PDF/UA accessibility.

The renderer reads no remote images, executes no scripts, and uses only trusted
local branding. A missing local logo falls back to the installation name.
PNG and WebP logos require PHP GD. The output is limited to eight A4 pages and
2 MiB. Temporary rendering files are removed after the request; no server-side
archive of visitor PDFs is maintained.

## Let the visitor send the email

The contact action remains available while its summary is being prepared.
It opens a `mailto:` draft for the configured recipient. The visitor can review,
edit, and send it in their own mail application. Starchat sends no email.

The encoded mailto link is limited to 1,900 characters for compatibility, so the
draft may be shortened. Check the contents in the mail application before sending.
No account connection or permission to contact someone is created by this feature.

## Start a conversation from a topic

Configure locale-specific questions under `topics`, for example:

```json
{"topics":{"integration":{"en":"Help me connect our systems","de":"Unsere Systeme sollen zusammenarbeiten"}}}
```

`/?topic=integration&lang=de` submits that configured question and continues an
existing conversation. The browser removes `topic` before submission. Unknown
topics do nothing; a topic selected during a pending answer stays as a draft.
Only use public topic names. This differs from `?q=`, which fills an editable
question without submitting it.

Update the installation's notices for automatic summary preparation, model
input, browser storage, and downloads. Temporary local files do not establish
the model provider's retention policy.
