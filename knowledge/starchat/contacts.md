---
id: starchat-contacts
entity: stage
title: 'Offer verified email and phone contacts'
source: 'https://stage.dev/resources/starchat-contacts'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.6.1'
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
phrase_terms:
  - 'email and phone'
  - 'contact verification'
  - 'E-Mail und Telefon'
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
a useful answer. The operator enables the channels and maintains their recipients
in reviewed installation knowledge. Conversation text cannot introduce a recipient.
Starchat sends no message, makes no call, and submits no application.

## Enable the channels you support

Add `actions` to the installation's existing `asset` configuration:

```json
{"asset":{"type":"pdf","actions":["email","phone"]}}
```

Actions default to an empty list. They can accompany `none`, `pdf`, `email`, or
`project`. A project installation keeps its ZIP panel and prepares contact actions
separately. The PDF and Markdown exports contain the same reviewed actions.
See [conversation assets](https://stage.dev/resources/starchat-assets) for downloads.

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

Each entry has exactly `id`, `kind`, `address`, `label`, `purpose`, and `verified_at`.
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

Email actions contain a localized label, subject, and editable body. The subject
allows 140 characters and the body 1,200. Their encoded mailto URI allows 8,000
characters; mail applications may impose smaller limits. The fixed-recipient
`asset.type: email` shortcut instead uses the shorter limit in the assets guide.
Telephone actions include preparation for the call, with at most six checklist
items of 300 characters each. Expand the details to inspect the draft or checklist.

An inquiry is not a booking or formal application. Drafts must preserve unknown
facts, avoid invented commitments or documents, and leave sending to the visitor.
The interface and exported PDF or Markdown use the same validated content.

## Keep scope and privacy intact

A new question cancels earlier preparation and removes stale actions. PDF and
action-only panels wait for useful content; a first clarification alone starts
no summary. The fixed email shortcut remains available without a summary.

With verified session context, preparation and display require fresh checks.
Changed or unavailable context, reset, or a hidden page clears actions and
revokes download URLs. Saved files remain on the visitor's device. Describe
the conversation, contact metadata, and request facts sent to the model in the
installation's privacy notice. This feature creates no external messaging account.
