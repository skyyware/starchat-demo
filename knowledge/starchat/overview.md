---
id: starchat
entity: stage
title: 'What Starchat provides'
source: 'https://stage.dev/resources/starchat'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.7.5'
public_path: /resources/starchat
topic_terms:
  - starchat
  - capabilities
  - purpose
  - 'project building'
  - 'session context'
phrase_terms:
  - 'what is starchat'
  - 'what can starchat do'
keywords:
  - starchat
  - capabilities
  - purpose
  - 'project building'
  - 'session context'
links:
  -
    label: 'What Starchat provides'
    url: 'https://stage.dev/resources/starchat'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Maintain knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
  -
    label: 'Use verified session context'
    url: 'https://stage.dev/resources/starchat-request-context'
  -
    label: 'Public example installation'
    url: 'https://github.com/skyyware/starchat-demo'
  -
    label: 'Stage demo chat'
    url: 'https://chat.stage.dev'
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: 'Configure opening app ideas'
    url: 'https://stage.dev/resources/starchat-app-ideas'
  -
    label: 'Continue a downloaded project with an agent'
    url: 'https://stage.dev/resources/starchat-agent-handoff'
based_on: {  }
follow_ups: {  }
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
By default, it saves the visible conversation in the visitor's browser and sends bounded
context to the configured model provider. Selected
reviewed articles can also appear at `/resources/<slug>`.

Opening questions introduce the chat's purpose and possible uses without
assuming the visitor's role or technical knowledge. A building installation can
instead provide a reviewed pool of app ideas. Each new conversation shows four
choices that mix familiar applications with less obvious useful ones. Once a
conversation starts, suggestions answer the open clarification or advance the
stated goal. An unselected suggestion is never a confirmed fact about the visitor.

An installation can enable project building and select `asset.type: project`.
A reviewed starter can appear with the first compatible answer. Other technologies
and custom features use generation and independent review. A custom project
cannot be reset to the starter.

The answer appears before project preparation. A compact card after the input
and suggestions shows progress while you keep chatting.
A concrete goal can produce a first useful version while reversible
choices remain provisional. Those choices and open questions belong in
`PROJECT.md`. A new question hides the old download and cancels preparation.
Only the current ZIP is downloadable, without a model request. Previous files
stay available internally for revisions.
Saved files remain on the visitor's device.

Each archive includes a documented entry point for people and coding agents.
The README explains setup and checks. AGENTS.md, a CLAUDE.md import, and optional
tool guidance help the next agent continue from the recorded requirements.
Plugins are optional and are not installed by downloading the project.

The operator's scope and building settings define the permitted work and
technologies. Projects can use languages other than PHP. Building is off by
default. The service reviews files but does not execute them. See
[Build and download a project](https://stage.dev/resources/starchat-building)
for setup, missing-information cases, manual retry, and limits.

Assets are off by default. An installation can instead offer a reviewed PDF
summary or an editable email draft. Reviewed email and telephone contacts, or
Markdown downloads, can accompany the selected type. Starchat sends no email. See
[conversation assets](https://stage.dev/resources/starchat-assets) for setup and limits.

## Facts from a signed-in application

An installation can opt into verified session context. Its provider verifies
signed session data and supplies bounded facts for one answer. Ordinary knowledge
retrieval, scope, and answer review remain. These facts stay out of the public
index. The browser keeps this conversation only in RAM. A session check clears
it if the account, company, permissions, or verified session changed or context
is unavailable.
This mode cannot be combined with building or origin migration. Summaries and
contacts require fresh context checks before preparation and display.
See [verified session context](https://stage.dev/resources/starchat-request-context)
for the provider contract and privacy limits.

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

[chat.stage.dev](https://chat.stage.dev) demonstrates stage and its packages
using its own reviewed snapshot of the public guides on stage.dev.
