---
id: starchat-assets
entity: stage
title: 'Offer a project, PDF summary, or email draft'
source: 'https://stage.dev/resources/starchat-assets'
retrieved_at: '2026-10-15'
review_status: reviewed
source_version: 'skyyware/starchat v0.7.2'
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
  - 'PDF preview'
  - 'contact language'
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
  - 'PDF preview'
  - 'contact language'
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

Assets are off by default. Set `asset.type` in `installation.json`:

| Setting | Result |
| --- | --- |
| No `asset`, or `{"type":"none"}` | No primary asset |
| `{"type":"project"}` | Current project ZIP; also requires `building.enabled` |
| `{"type":"pdf"}` | Reviewed conversation summary as a PDF |
| `{"type":"email","recipient":"hello@example.org"}` | Editable draft in the visitor's mail app |

PDF and email need no project building. Optional `actions` and `downloads`
accompany any type and default to empty lists. With neither, `none` prepares
nothing. Visitor messages cannot change these settings. Session context requires
fresh scope checks.

When upgrading from 0.4.x, set `asset.type: project` to retain the ZIP download.
`none` does not disable an independently enabled project-building API. To disable
both, remove `asset` and `building`.

## Keep the result current

The answer appears before preparation. Assets follow the input and suggestions.
PDF, email and contact cards appear only when ready, with motion disabled when
requested. Progress and retry controls remain separate while you keep chatting.
A new question hides old downloads and cancels preparation. Progress has no
percentage or time promise. Downloads start no model call. PDFs have no inline
preview; their button opens the prepared file.

PDF preparation skips a first clarification with no useful content. Earlier useful
content can still be summarized after a later question. The browser accepts
nonempty steps or a standalone answer without a follow-up. Facts followed by a
question, without steps, wait for more content. Orientation, missing evidence,
and unavailable answers do not start a PDF. A primary email draft can follow a
completed exchange that only asks for clarification; empty history prepares none.

A reset or language change discards results. Summaries stay in browser memory.
Ordinary chat can prepare them after reload; context chat starts empty.
Project ZIP storage and revision input follow
[project downloads](https://stage.dev/resources/starchat-building).

## Prepare a faithful summary

The generator receives the bounded conversation and installation scope. A separate
reviewer checks the summary. Both state established facts and supported next steps
directly, preserving corrections, actual uncertainty, and open decisions. Unverified
claims keep their attribution. Summaries omit transcript narration and blanket disclaimers.
A proposal is not an agreement; an appointment request is not a confirmation.
Review checks faithfulness to the conversation, not the truth of every claim.

Links must match approved conversation links or fresh verified context.
Contacts use reviewed metadata. Summaries do not fetch arbitrary documents. See
[verified session context](https://stage.dev/resources/starchat-request-context).

Input allows 80 messages and 24 KiB. Generation and review share a 45-second
deadline with no automatic model retry. The browser allows 60 seconds.
Capacity is shared with chat and building.

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
next steps, contacts, date and page numbers. Web links print their full addresses,
wrap within the page and remain clickable. There is no generic disclaimer footer.

Latin, Greek, and Cyrillic require available glyphs. Complex scripts, including
Arabic, and missing glyphs fail explicitly. Visitors can choose a German PDF;
the service does not silently translate. Source Sans and Roboto Slab have PDF
fonts; D-DIN and system fonts use DejaVu. Output is not tagged for PDF/UA.

The renderer uses trusted local branding, no remote images or scripts.
A missing logo uses the installation name. PNG and WebP require PHP GD.
Output is limited to eight A4 pages and 2 MiB. Temporary files are removed
after the request; no server-side PDF archive is kept.

## Let the visitor send the email

The primary email button appears after a completed exchange and successful
preparation and review. The server resolves the configured recipient as `primary`.
Button, preview, and exports use the complete draft without browser truncation.
Limits are 140 characters for the subject, 1,200 for the body, and 8,000 for the
encoded mailto URI. Mail apps may impose smaller limits.

`asset.contact_locale` sets the recipient's language, defaulting to the
installation's `locale`. Summary text and labels use the visitor's language;
the email subject and body use the recipient's language, with blank lines between
paragraphs. See [contact language](https://stage.dev/resources/starchat-contacts).
Visitors review, edit, and send the draft in their mail app. Starchat sends no email.

## Start a conversation from a topic

Configure questions under `topics`:

```json
{"topics":{"integration":{"en":"Help me connect our systems","de":"Unsere Systeme sollen zusammenarbeiten"}}}
```

`/?topic=integration&lang=de` submits the question and continues an existing conversation.
The browser removes `topic` first. Unknown topics do nothing; during a pending
answer the question stays a draft. Use public topic names. This differs from `?q=`,
which fills an editable question without submitting it.

Describe automatic preparation, model input, storage, and downloads in your
notices. Local file deletion makes no promise about provider retention.
