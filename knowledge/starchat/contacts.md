---
id: starchat-contacts
entity: stage
title: 'Offer verified email and phone contacts'
source: 'https://stage.dev/resources/starchat-contacts'
retrieved_at: '2026-10-15'
review_status: reviewed
source_version: 'skyyware/starchat v0.7.2'
public_path: /resources/starchat-contacts
topic_terms:
  - 'contact actions'
  - 'contact metadata'
  - 'email recipient'
  - 'phone number'
  - 'telephone checklist'
  - 'verified contacts'
  - kontaktaktionen
  - telefonnummer
  - 'contact language'
  - 'recipient language'
  - 'primary email'
phrase_terms:
  - 'email and phone'
  - 'contact verification'
  - 'E-Mail und Telefon'
  - 'English summary German email'
keywords:
  - 'contact actions'
  - 'contact metadata'
  - 'email recipient'
  - 'phone number'
  - 'telephone checklist'
  - 'verified contacts'
  - kontaktaktionen
  - telefonnummer
  - mailto
  - verified_at
  - 'contact language'
  - 'recipient language'
  - 'primary email'
  - contact_locale
  - Empfängersprache
links:
  -
    label: 'Offer verified email and phone contacts'
    url: 'https://stage.dev/resources/starchat-contacts'
  -
    label: 'Offer a project, PDF summary, or email draft'
    url: 'https://stage.dev/resources/starchat-assets'
  -
    label: 'Maintain an installation knowledge base with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
based_on: {  }
follow_ups: {  }
---

# Offer verified email and phone contacts

Starchat can suggest an editable email or preparation for a telephone call after
an answer. The operator enables the channels and maintains their recipients
in reviewed installation knowledge. Conversation text cannot introduce a recipient.
Starchat sends no message, makes no call, and submits no application.

## Enable the channels you support

Add `actions` to the installation's existing `asset` configuration:

```json
{"asset":{"type":"pdf","contact_locale":"de","actions":["email","phone"]}}
```

Actions default to an empty list. They can accompany `none`, `pdf`, `email`, or
`project`. A project installation keeps its ZIP panel and prepares contact actions
separately. The PDF and Markdown exports contain the same reviewed actions.
Cards follow the input and suggestions at the end of the conversation.
See [conversation assets](https://stage.dev/resources/starchat-assets) for downloads.

## Choose the recipient's language

`asset.contact_locale` sets the organization's correspondence language and
defaults to the installation's `locale`. A source contact's optional `locale`
overrides that default for its recipient. Both settings use a supported language
code. The visitor's language selection does not change them.

The summary, action labels, and telephone checklists use the visitor's selected
language. Each email subject and body use the recipient's language. An English
summary can therefore include a German email. Letters written directly in chat
follow the same rule; surrounding explanations retain the conversation language.
Generation and independent review check this separation.

## Record contacts in their source article

Add up to eight contacts to an article's YAML metadata. For example:

```yaml
contacts:
  - id: service-email
    kind: email
    address: service@example.org
    label: Service office
    purpose: General questions about the service
    verified_at: '2026-10-14'
    locale: de
  - id: service-phone
    kind: phone
    address: '+497110000000'
    label: Service office
    purpose: Discuss the next step by telephone
    verified_at: '2026-10-14'
```

These are fictional addresses. Replace them, their purpose, and their verification
date with checked source facts. Do not mark an inferred address as verified.
Keep the verification evidence with the installation. Rebuild its knowledge index.

Each entry requires `id`, `kind`, `address`, `label`, `purpose`, and `verified_at`.
Only `locale` is optional.
IDs are unique within the article and use 2 to 60 lowercase letters, digits, or
hyphens. Email addresses are single plain recipients, at most 160 characters.
Phone numbers use E.164: a plus sign followed by 7 to 15 digits, without an initial
zero. Labels allow 120 characters; purposes allow 600.

`verified_at` uses YYYY-MM-DD. Contacts expire after `source_max_age_days`, even
when their article describes an immutable release. The article must also belong
to this installation, be reviewed and current, and use an allowed HTTPS source.
Checking a contact does not renew the rest of the article.

## Match the current concern

The server selects relevant reviewed sources from the conversation, a bounded
search for contact sources, and source links in the latest answer. At most twelve
contacts reach the model. Fresh verified request documents take precedence over
public documents with the same ID. Stale contacts and disabled channels are excluded.

The model chooses a catalogue ID. The server resolves the exact address and URI;
the model cannot supply a new destination. No matching contact means no action.
Up to four actions can appear, each checked by the independent summary reviewer.
An older topic must not supply an irrelevant contact for the current concern.

A current email draft with a matching verified recipient must offer that email
action. It preserves the latest corrections and placeholders. A writing-only
revision keeps the last substantive contact query; a new topic replaces it.
Superseded drafts and unrelated or unverified addresses create no action.

Email actions contain a complete editable letter with a greeting, the stated
situation, a request, and a closing. Blank lines separate paragraphs; the server
normalizes them to blank CRLF lines. The subject allows 140 characters and the
body 1,200. Their encoded mailto URI allows 8,000 characters; mail applications
may impose smaller limits. These limits also apply to `asset.type: email`.
The browser does not shorten the server-prepared draft.
Telephone actions include preparation for the call, with at most six checklist
items of 300 characters each. Expand the details to inspect the draft or checklist.

An inquiry is not a booking or formal application. Drafts must preserve unknown
facts, avoid invented commitments or documents, and leave sending to the visitor.
The interface and exported PDF or Markdown use the same validated content.

## Keep scope and privacy intact

A new question cancels earlier preparation and removes stale actions. PDF and
action-only panels wait for useful content; a first clarification alone starts
no summary. A primary `asset.type: email` draft requires a completed exchange,
including a clarification, and successful preparation and review. Empty history
shows no contact card. The configured recipient enters the trusted catalogue as
`primary`; generation must include its draft. No email button appears before that
draft is ready.

With verified session context, preparation and display require fresh checks.
Changed or unavailable context, reset, or a hidden page clears actions and
revokes download URLs. Saved files remain on the visitor's device. Describe
the conversation, contact metadata, and request facts sent to the model in the
installation's privacy notice. This feature creates no external messaging account.
