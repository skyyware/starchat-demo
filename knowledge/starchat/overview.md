---
id: starchat
entity: stage
title: 'What Starchat provides'
source: 'https://stage.dev/resources/starchat'
retrieved_at: '2026-10-10'
review_status: reviewed
source_version: 'skyyware/starchat v0.2.7'
public_path: /resources/starchat
topic_terms:
  - starchat
  - capabilities
  - purpose
phrase_terms:
  - 'what is starchat'
  - 'what can starchat do'
keywords:
  - starchat
  - capabilities
  - purpose
links:
  -
    label: 'What Starchat provides'
    url: 'https://stage.dev/resources/starchat'
  -
    label: 'Maintain knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
  -
    label: 'Public example installation'
    url: 'https://github.com/skyyware/starchat-demo'
  -
    label: 'Stage demo chat'
    url: 'https://chat.stage.dev'
based_on: {  }
---

# What Starchat provides

Starchat is a chat application for a defined product, organization, community,
or person. Each installation has its own Markdown knowledge, purpose, design,
and private runtime. The shared PHP engine arrives through Composer and requires
access to the private Starchat repository. The public example installation is
[starchat-demo](https://github.com/skyyware/starchat-demo).

Stage is the framework. Stage Chat defines a provider interface. Starchat
combines an interface for visitors, knowledge retrieval, and answer review.
Installing Stage or Stage Chat alone does not create a Starchat website.

## Answers from prepared knowledge

The installation stores articles in `knowledge/<category>/*.md`. An agent or
editor prepares those articles from sources the operator is allowed to use.
Each article records its owner, evidence, and review state. Starchat searches
a derived SQLite index, supplies relevant articles to the model, and checks
the candidate answer before displaying it.

The model does not browse your repository, connect to external document folders,
or update the knowledge itself. Maintaining the articles is a separate agent
workflow under the repository owner's instructions. Useful knowledge contains
precise facts, complete procedures, examples, and limits tailored to visitors'
questions. A folder of unreviewed documents is not the same product.

## What the engine can do

Starchat answers questions, explains procedures, cites supplied sources, and
displays code as text. Links appear only when they help the answer; each
destination appears once. A complete answer or focused question can have no
links. Its factual claims still undergo review against the supplied evidence.
It retains the visible conversation in the visitor's browser and sends bounded
context to the configured model provider. Selected
reviewed articles can also appear at `/resources/<slug>`.

Opening questions introduce the chat's purpose and possible uses without
assuming the visitor's role or technical knowledge. Once a conversation starts,
suggestions should answer the open clarification or advance the stated goal.
An unselected suggestion is never a confirmed fact about the visitor.

Starchat cannot execute an example, submit a form, deploy an application,
book an appointment, or grant access to another installation. Public answers
must use material suitable for visitors and the provider. Leaving an article
off the resources page does not make its contents private.

## Model and operating limits

The default model configuration requests Astra with low reasoning and Fast. The operator
must have suitable provider access and configure the supported connector.
Prepared knowledge narrows the task and supplies evidence; it does not establish
a performance advantage over other models or guarantee a correct answer.

An independent review call checks the candidate before the complete answer is
shown. The model and reviewer can still share mistakes. No candidate is released
when review fails. The application also enforces host and knowledge-owner
matching, input bounds, and allowed links in code.

Use the installation and knowledge guides to build your own application.
The technical demo at [chat.stage.dev](https://chat.stage.dev) answers questions
about stage and its packages. The regular website at stage.dev provides the
public documentation used to prepare the demo's own Markdown knowledge.
