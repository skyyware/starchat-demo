---
id: starchat-contacts
entity: stage
title: 'Offer verified email and phone contacts'
source: 'https://stage.dev/resources/starchat-contacts'
retrieved_at: '2026-10-20'
review_status: reviewed
source_version: 'skyyware/starchat v0.10.4'
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
  - 'direct call'
  - 'contact expiry'
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
  - expires
  - 'direct call'
  - 'contact expiry'
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
  -
    label: 'Read suggested replies and contacts from the answer API'
    url: 'https://stage.dev/resources/starchat-answer-api'
based_on: {  }
follow_ups: {  }
---

# Offer verified email and phone contacts

Starchat offers email drafts and direct call buttons for reviewed contacts.
Operators enable channels and maintain recipients in installation knowledge.
Conversation text cannot introduce a recipient. Visitors initiate calls or send drafts.

## Enable the channels you support

Add `actions` to the installation's existing `asset` configuration:

```json
{"asset":{"type":"pdf","contact_locale":"de","actions":["email","phone"]}}
```

Actions default to an empty list and can accompany any asset type.
Known telephone numbers use direct `tel:` buttons without generation.
Email and document preparation require a click; result cards appear in the
conversation. PDF and Markdown exports contain the same reviewed actions.
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

Replace these fictional contacts and dates with checked source facts.
Keep verification evidence with the installation and rebuild its index.

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

The answer selects up to four catalogue IDs for its current concern.
Independent review checks their purpose before the server exposes destinations.
Offers expire at the next installation-local midnight. Missing or expired contact
metadata offers no contextual action, including in older saved answers.
The [answer API](https://stage.dev/resources/starchat-answer-api) defines these fields.
Draft review checks the contact key, label, subject, exact body and checklist.
Recipient and language come from the trusted catalogue; unapproved links are rejected.

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
Telephone checklists have up to six items of 300 characters each in expandable
details. Email opens the full draft in the mail app, without
a preview. Contact cards show an icon, title and button, with no description.

An inquiry is not a booking or formal application. Drafts must preserve unknown
facts, avoid invented commitments or documents, and leave sending to the visitor.
The interface and exported PDF or Markdown use the same validated content.

## Keep scope and privacy intact

Creation clicks resolve contacts again from fresh sources. No suitable result
removes that creation choice for the current transcript; transient failures allow retry.
Completed results stay by their answer. A first clarification offers no summary.
A primary `asset.type: email` can follow an answered in-scope exchange without
contextual contact metadata. Its configured recipient enters the catalogue as
`primary`; generation must include its draft before an email button appears.
Empty history offers none.

With verified session context, preparation and display require fresh checks.
Changed or unavailable context, reset, or a hidden page clears actions and
revokes download URLs. Saved files remain on the visitor's device. Describe
the conversation, contact metadata, and request facts sent to the model in the
installation's privacy notice. This feature creates no external messaging account.
