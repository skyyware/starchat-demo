---
id: starchat-assets
entity: stage
title: 'Offer a project, PDF summary, or email draft'
source: 'https://stage.dev/resources/starchat-assets'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.6.1'
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
  - 'summary downloads'
  - 'download filenames'
  - 'answer first'
  - 'PDF clarification'
phrase_terms:
  - 'disable assets'
  - 'PDF from conversation'
  - 'prepare email'
  - 'start from a topic'
keywords:
  - 'conversation assets'
  - 'optional assets'
  - asset.type
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
  - 'summary downloads'
  - 'download filenames'
  - 'answer first'
  - 'PDF clarification'
links:
  -
    label: 'Offer a project, PDF summary, or email draft'
    url: 'https://stage.dev/resources/starchat-assets'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: 'Offer verified email and phone contacts'
    url: 'https://stage.dev/resources/starchat-contacts'
based_on: {  }
follow_ups: {  }
---

# Offer something to take away

An installation can offer a project ZIP, a PDF summary, or an email draft.
Assets are off by default. Set one `asset.type` in `installation.json`:

| Setting | Result |
| --- | --- |
| No `asset`, or `{"type":"none"}` | No primary asset |
| `{"type":"project"}` | Current project ZIP; also requires `building.enabled` |
| `{"type":"pdf"}` | Reviewed conversation summary as a PDF |
| `{"type":"email","recipient":"hello@example.org"}` | Editable draft in the visitor's mail app |

PDF and email need no project building. Optional `actions` and `downloads` can
accompany any type, including `none`; both default to empty lists. With neither,
`none` prepares nothing. Visitor messages cannot change these operator settings.
Verified session context permits summaries under its fresh scope checks.

When upgrading a building installation from 0.4.x, explicitly set
`asset.type: project` to retain its visible ZIP download. Setting assets to
`none` does not disable an independently enabled project-building API. To
disable both, remove `asset` and `building`.

## Keep the result current

The answer appears before asset preparation starts. A compact panel above the
input shows progress; you can keep chatting. A new question hides the previous
ZIP or PDF and cancels preparation. Progress has no percentage or completion time.
Only the current result gets a download. Clicking it starts no model call.
A failed preparation offers a manual retry.

PDF preparation skips a first clarification with no useful content. Earlier useful
content can still be summarized after a later question. The browser accepts
nonempty steps or a standalone answer without a follow-up. Facts followed by a
question, without steps, wait for more content. Orientation, missing evidence,
and unavailable answers do not start a PDF. The fixed email contact stays available.

A reset or language change discards older results. Summaries stay in browser
memory. Ordinary chat can prepare them again after reload; context chat starts
empty. Project ZIPs keep separate browser storage and previous revision input; see
[project downloads](https://stage.dev/resources/starchat-building).

## Prepare a faithful summary

The generator receives the bounded conversation and installation scope. A separate
reviewer checks the summary. Both preserve speaker attribution, later corrections,
uncertainty, and unresolved decisions.
A proposal is not an agreement; an appointment request is not a confirmation.
Review checks faithfulness to the conversation, not the truth of every claim.

Links are optional and must match approved conversation links or fresh verified
context. Enabled contact actions use reviewed source metadata. Summaries do not
fetch arbitrary private documents. See
[verified session context](https://stage.dev/resources/starchat-request-context).

Input permits 80 messages and 24 KiB of serialized conversation. Generation and
review share a 45-second deadline, with no automatic model retry. The browser
allows 60 seconds for preparation. Capacity is shared with chat and building.
These are limits, not a delivery promise.

## Add document downloads and contacts

```json
{"asset":{"type":"pdf","actions":["email","phone"],"downloads":["markdown","bundle"]}}
```

`markdown` exports the reviewed summary as text. `bundle` requires `type: pdf`
and PHP's zip extension; it packs that same PDF and Markdown into a ZIP.
It generates no software. Files use the summary title in its selected language
and an ISO date in the installation timezone, with unsafe characters removed.
Contact actions require [verified contact metadata](https://stage.dev/resources/starchat-contacts).
No matching contact means no contact action.

## Use installation branding in PDFs

PDFs use local branding and supported fonts. They contain the reviewed summary,
next steps, contacts, links, date, page numbers, and a note that this is guidance.

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

This fixed-recipient mailto link allows 1,900 characters, so the draft may be
shortened. Check it in the mail app. It creates no account connection or permission
to contact someone. Contextual email actions have their own documented limits.

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

Describe automatic preparation, model input, storage, and downloads in your
notices. Local file deletion makes no promise about provider retention.
