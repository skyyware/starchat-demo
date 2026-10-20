---
id: starchat-answer-api
entity: stage
title: 'Read suggested replies and contacts from the answer API'
source: 'https://stage.dev/resources/starchat-answer-api'
retrieved_at: '2026-10-20'
review_status: reviewed
source_version: 'skyyware/starchat v0.11.0'
public_path: /resources/starchat-answer-api
topic_terms:
  - 'answer API'
  - 'suggestion labels'
  - 'short suggestions'
  - suggestion_labels
  - contacts
  - expires
  - 'contact expiry'
phrase_terms:
  - 'short label full question'
  - 'HTTP response fields'
  - 'direct phone button'
keywords:
  - 'answer API'
  - 'suggestion labels'
  - suggestion_labels
  - suggestions
  - contacts
  - contact_ids
  - expires
  - midnight
  - tel
links:
  -
    label: 'Read suggested replies and contacts from the answer API'
    url: 'https://stage.dev/resources/starchat-answer-api'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Offer verified email and phone contacts'
    url: 'https://stage.dev/resources/starchat-contacts'
  -
    label: 'Offer a project, PDF summary, or email draft'
    url: 'https://stage.dev/resources/starchat-assets'
based_on: {  }
follow_ups: {  }
---

# Read suggested replies and contacts from the answer API

Starchat 0.10.4 adds optional `suggestion_labels` and `contacts` fields to the
answer returned by `POST /chat`. Existing answer fields remain. For a streamed
response, these fields are inside the final `result` frame's `data` object.
Early failures can still return ordinary JSON; clients check the content type.
The endpoint retains its origin, request validation, and capacity checks.

## Suggested replies

| Field | Meaning and limit |
| --- | --- |
| `suggestions` | Up to four full next-turn texts, each at most 120 characters |
| `suggestion_labels` | Optional display labels in the same order and count, each at most 60 characters |

Labels preserve the corresponding question's meaning. Generation aims for two
to five words and at most 42 characters; the enforced maximum is 60.
Independent answer review checks both the full text and its label.

For example, this part of an answer offers a short label for a longer reply:

```json
{
	"suggestions": ["Keep tasks in this browser without account registration"],
	"suggestion_labels": ["Keep tasks here"]
}
```

The browser displays `Keep tasks here` and submits the full `suggestions[0]`
text when clicked. Labels stay on one line. A long label can end in a visual
ellipsis, while the control's title retains the full question.
If labels are absent, the browser uses the full suggestion as its label.

Labels and submitted suggestions omit trailing full stops and ellipses.
Question marks and internal punctuation, such as `Node.js` or `1.2`, remain.
Restored suggestions use the same rendering; saved conversation messages are
not rewritten. Opening app ideas keep their configured label and question.

## Reviewed contact offers

`contacts` contains at most four contacts selected for the current answer.
The server resolves their destinations from the installation's fresh verified
catalogue. Independent answer review checks that each contact's purpose fits
the current concern. Addresses in conversation text alone do not qualify.

| Contact field | Meaning |
| --- | --- |
| `kind` | `email` or `phone` |
| `address` | One plain email recipient or an E.164 phone number |
| `label` | Contact name, at most 120 characters |
| `locale` | Recipient's correspondence language |
| `source` | Approved source URL |
| `expires` | Unix timestamp in seconds for the next midnight in the installation's timezone |

For example, this fictional contact offer issued on 20 October 2026 with
timezone `Europe/Berlin` expires at local midnight on 21 October:

```json
{
	"kind": "phone",
	"address": "+497110000000",
	"label": "Service office",
	"locale": "de",
	"source": "https://example.org/contact",
	"expires": 1792533600
}
```

The browser validates the contact fields and requires `expires * 1000` to be
greater than its current time. Missing or expired metadata offers no contextual
email or telephone action. Older saved answers do not infer contacts from prose,
and a new answer does not inherit a previous answer's contacts.

An enabled telephone channel offers a direct `tel:` button for the reviewed
number. The click uses the visitor's telephone handler without a model request.
A contextual email action prepares a draft only after a click. The configured
primary email recipient remains available for an answered in-scope exchange,
even when contextual metadata is absent.

Requested drafts and documents resolve contacts again from fresh sources.
An empty contact result removes that creation choice for the current transcript;
transient generation failures still offer manual retry. Completed documents keep
their reviewed contact cards and preparation lists.

## Model fields and compatibility

The model schema requires `suggestion_labels` and `contact_ids`.
`contact_ids` contains up to four exact catalogue keys. It is an internal model
field, not a client-supplied destination. HTTP answers expose resolved `contacts`;
they do not expose those selection IDs. Empty optional fields are omitted.

Older HTTP answers without the new fields remain readable. Custom clients must
tolerate absent labels and contacts. Installation settings still determine which
asset types and channels are available. This response grants no additional scope,
account access, call, or message delivery.

See [verified contacts](https://stage.dev/resources/starchat-contacts) for source
metadata and [conversation assets](https://stage.dev/resources/starchat-assets)
for preparation, downloads, and session-context checks.
