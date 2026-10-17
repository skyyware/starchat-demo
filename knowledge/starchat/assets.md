---
id: starchat-assets
entity: stage
title: 'Offer a project, PDF summary, or email draft'
source: 'https://stage.dev/resources/starchat-assets'
retrieved_at: '2026-10-17'
review_status: reviewed
source_version: 'skyyware/starchat v0.10.0'
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
  - 'email creation action'
  - 'duplicate creation action'
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

Assets are off by default; set `asset.type` in `installation.json`:

| Setting | Result |
| --- | --- |
| No `asset`, or `{"type":"none"}` | No primary asset |
| `{"type":"project"}` | Current project ZIP; also requires `building.enabled` |
| `{"type":"pdf"}` | Reviewed conversation summary as a PDF |
| `{"type":"email","recipient":"hello@example.org"}` | Editable draft in the visitor's mail app |

PDF and email need no building. Optional `actions` and `downloads` accompany any
type and default to empty lists. With neither, `none` prepares nothing. Visitors
cannot change these settings. Session context requires fresh scope checks.

Upgrades from 0.4.x need `asset.type: project` for ZIPs. `none` does not disable an
independently enabled project-building API; remove `asset` and `building` to disable both.

## Keep the result current

The answer appears before preparation. Creation actions sit in **Actions** below
the suggestions. Each area has its own limit of four controls.
Only a click starts preparation.
Answers and preparation use three animated dots and a status line in the
conversation; reviewed cards appear only when ready.
Loading, restored history and completed answers never prepare assets. Failures
offer manual retry. Ready cards hide actions they cover for this
answer; a PDF with an email card also hides email creation. Other formats and
later answers remain eligible.
Cards slide and fade unless motion is reduced. Downloads start no model call.
PDFs have no inline preview; their button opens the prepared file.

PDF actions skip a first clarification without useful content. Nonempty steps
or an answer without a follow-up qualify; facts followed by a question, without
steps, wait. Earlier useful answers still qualify. Orientation, missing evidence
and unavailable answers do not. Primary email drafts can follow a completed
clarification; empty history prepares none.

The page keeps up to twelve packages by their answers. A later click uses the
current conversation. Reset, language change or context loss clears results and
URLs. Changed conversations cancel preparation and fence late responses. PDF and
contacts stay in memory; reloads require a new click. Context chat starts empty.
Project ZIP storage and revision input follow
[project downloads](https://stage.dev/resources/starchat-building).

## Prepare a faithful summary

Generation and independent review use the bounded conversation and installation
scope. Summaries preserve facts, corrections, uncertainty, open decisions and
attribution. A proposal is not an agreement; a request is not a confirmed appointment.
Review checks faithfulness, not the truth of every claim.

Links need approved conversation links or verified context; contacts need reviewed
metadata. See
[verified session context](https://stage.dev/resources/starchat-request-context).

Input allows 80 messages and 24 KiB. Generation and review share a 45-second
deadline with no automatic model retry. The browser allows 60 seconds.
Capacity is shared with chat and building.

## Add document downloads and contacts

```json
{"asset":{"type":"pdf","actions":["email","phone"],"downloads":["markdown","bundle"]}}
```

`markdown` exports text. `bundle` requires `type: pdf` and PHP's zip extension;
it packs the same PDF and Markdown into a ZIP, not software. Names use the summary
title in its selected language and an ISO date in the installation timezone,
with unsafe characters removed.
Contact actions require [verified contact metadata](https://stage.dev/resources/starchat-contacts).
No matching contact means no contact action.

Actions request only their selected type: email and phone do not render a PDF;
PDF does not create unrequested Markdown or ZIP files. Unknown or disabled types
fail before model use. Older clients without a selection retain combined responses.

## Use installation branding in PDFs

PDFs use local branding and contain the summary, next steps, contacts, date and
page numbers. Full link addresses wrap and remain clickable. There is no disclaimer footer.

Latin, Greek, and Cyrillic require available glyphs. Complex scripts, including
Arabic, and missing glyphs fail explicitly. Visitors can choose a German PDF;
the service does not silently translate. Source Sans and Roboto Slab have PDF
fonts; D-DIN and system fonts use DejaVu. Output is not tagged for PDF/UA.

The renderer permits no remote images or scripts. Missing logos use the
installation name. PNG and WebP require PHP GD. Output is limited to eight A4 pages
and 2 MiB. Temporary files are removed; no server-side PDF archive is kept.

## Let the visitor send the email

The primary email action follows a completed exchange. Clicking prepares and
reviews a draft for `primary`. Mail buttons and exports use the complete draft.
Email has no preview.
Limits are 140 characters for the subject, 1,200 for the body, and 8,000 for the
encoded mailto URI. Mail apps may impose smaller limits.

`asset.contact_locale` sets the recipient's language, defaulting to the
installation's `locale`. The email uses that language and blank lines between
paragraphs; summaries and labels use the visitor's language.
See [contact language](https://stage.dev/resources/starchat-contacts).
Visitors review, edit, and send the draft in their mail app. Starchat sends no email.

## Start a conversation from a topic

Configure questions under `topics`:

```json
{"topics":{"integration":{"en":"Help me connect our systems","de":"Unsere Systeme sollen zusammenarbeiten"}}}
```

`/?topic=integration&lang=de` submits the question and continues an existing conversation.
The browser removes `topic` first. Unknown topics do nothing; pending answers
keep the question as a draft. Use public topic names. This differs from `?q=`,
which fills an editable question without submitting it.

Notices must describe requested preparation, model input, storage and downloads.
Local deletion does not establish provider retention.
