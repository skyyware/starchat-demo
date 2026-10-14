---
id: starchat-app-ideas
entity: stage
title: 'Configure opening app ideas'
source: 'https://stage.dev/resources/starchat-app-ideas'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.4.7'
public_path: /resources/starchat-app-ideas
topic_terms:
  - 'app ideas'
  - 'application ideas'
  - 'random ideas'
  - 'starter ideas'
  - 'opening suggestions'
  - 'four suggestions'
  - 'use cases'
  - 'app ideen'
  - 'vier ideen'
phrase_terms:
  - 'four random app ideas'
  - 'choose starter ideas'
  - 'app ideen zum start'
keywords:
  - 'app ideas'
  - 'application ideas'
  - 'random ideas'
  - 'starter ideas'
  - 'opening suggestions'
  - 'four suggestions'
  - 'use cases'
  - 'app ideen'
  - 'vier ideen'
  - familiar
  - unexpected
  - phi
links:
  - label: 'Configure opening app ideas'
    url: 'https://stage.dev/resources/starchat-app-ideas'
  - label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  - label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
based_on: { }
---

# Configure opening app ideas

A building installation can show four concrete app ideas when a conversation
starts. Visitors can choose a familiar application or discover a less obvious
use. The suggestions assume no role, technical knowledge, or chosen project.

## Prepare the pool

Enable building before setting `copy.<locale>.app_ideas` in `installation.json`.
Keep ordinary `copy.<locale>.suggestions` as the required fallback.
Each app idea has three fields:

- `kind`: `familiar` or `unexpected`.
- `label`: the short text visitors see, with at most 120 characters.
- `question`: the complete request sent when someone chooses the idea, with
  at most 500 characters.

Supply at least two familiar and three less obvious ideas, with no more than
40 entries. Labels and requests must be distinct, nonempty, and use single spaces without
leading or trailing whitespace. Translate each locale's
entries in the same order so a language change retains the selected positions.
Do not add a period to a short label.

Name an outcome people can recognize. A familiar label might be “Build a task
list”; a less obvious one might be “Keep a repair passport for my things”.
The request can add the first useful behavior, such as adding, completing, and
deleting tasks, or recording an item's repair history.

An idea is an invitation, not evidence that the visitor wants accounts, an
integration, or a public service. Confirm requirements in the conversation.
Keep each proposal within the installation's purpose.

## Understand the selection

Starchat selects four distinct ideas from the reviewed pool. In 53% of
conversations it selects two familiar and two less obvious ideas. Otherwise,
it selects one familiar and three less obvious ideas. This approximates a
familiar-to-unexpected ratio of 1 : phi across conversations; a single set of
four cannot represent that ratio exactly.

Selection is random between conversations and stable within one conversation.
A new conversation can include an idea seen before. The selector makes no model
call and uses no visitor profile. During a conversation, suggestions come from
the answer and address the visitor's current goal or open question.

The pool is curated content. Starchat does not fetch trends or prove that an
idea is novel or in demand. Review entries when relevant evidence or the
installation's purpose changes. Installations without `app_ideas` retain
their ordinary opening questions.

## Verify a change

Run `vendor/bin/starchat index` to validate the configuration. Open a new
conversation and check that four readable, distinct ideas appear. Try another
language and a narrow screen. Choosing an idea must submit its full request.
After the answer, follow-up suggestions should help with that project.

When building is enabled, preparation follows the completed answer. The
[project guide](https://stage.dev/resources/starchat-building) explains when
the current ZIP becomes available. Plugin recommendations belong in the
downloaded project's agent guidance, not these four idea labels.
