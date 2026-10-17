---
id: starchat-building
entity: stage
title: 'Build and download a project'
source: 'https://stage.dev/resources/starchat-building'
retrieved_at: '2026-10-17'
review_status: reviewed
source_version: 'skyyware/starchat v0.10.0'
public_path: /resources/starchat-building
topic_terms:
  - building
  - 'project zip'
  - 'project download'
  - 'project export'
  - 'project preparation'
  - 'prepare again'
  - 'automatic preparation'
  - 'ready starter'
  - 'prepared starter'
  - 'first answer'
  - 'starter cache'
  - 'download disappears'
  - 'starter recovery'
  - 'fertige starter app'
  - 'erste antwort'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt vorbereiten'
  - 'erneut vorbereiten'
phrase_terms:
  - 'loading indicator'
  - ladebalken
  - 'project description'
  - 'four words'
  - 'project review'
  - 'unavailable project review'
  - 'project review retry'
  - 'last ready project'
  - 'starter download'
  - 'previous zip'
  - 'zip verschwindet'
  - 'download project zip'
  - 'build a project'
  - 'projekt zip herunterladen'
keywords:
  - 'last ready project'
  - 'starter download'
  - building
  - 'project zip'
  - 'project download'
  - 'project export'
  - 'project preparation'
  - 'loading indicator'
  - ladebalken
  - 'project description'
  - 'four words'
  - 'prepare again'
  - 'automatic preparation'
  - 'ready starter'
  - 'prepared starter'
  - 'first answer'
  - 'starter cache'
  - 'download disappears'
  - 'previous zip'
  - 'zip verschwindet'
  - 'starter recovery'
  - 'fertige starter app'
  - 'erste antwort'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt vorbereiten'
  - 'erneut vorbereiten'
  - 'previous files'
  - 'browser archive'
links:
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Operate Starchat'
    url: 'https://stage.dev/resources/starchat-operations'
  -
    label: 'Continue a downloaded project with an agent'
    url: 'https://stage.dev/resources/starchat-agent-handoff'
based_on: {  }
follow_ups: {  }
---

# Build and download a project

With building enabled and `asset.type: project`, visitors can request project
files and local instructions from their conversation.

## Define the first useful version

Building is off by default. Set `building.enabled`, `building.instructions`,
and `asset.type: project` in `installation.json`. These cannot widen `scope`;
visitors cannot replace them. Install PHP's zip extension and rebuild the index.
See [Install Starchat](https://stage.dev/resources/starchat-installation).

Projects can use any language allowed by your installation, including
Python or Java. Describe useful behavior and constraints. Suggestions are proposals.

A concrete goal can produce a first version with open choices, such as a task
list with provisional storage. `PROJECT.md` separates assumptions from decisions.
Missing requirements that block useful work still need an answer.

## Offer a ready starter

An operator can set `building.starter` to `starters/minimal.json`. The JSON file
contains `status: "ready"`, `name`, `summary`, `open_questions`, and `files` with
`path` and `content`. Review and run it before release; its summary uses at most
four words. Starchat supplies no built-in app. Disabled building cannot declare a starter.

The answer and independent reviewer may select the starter for an introductory
request. After the first answer, **Create project ZIP** offers it without a
project name or first feature. An explicit different technology or custom feature
uses normal preparation. A custom project cannot be reset to the starter.
Revising a starter passes its files into custom work.

`starchat index` prepackages it. `GET /project/starter` returns the project and
base64 ZIP without a generation or review model call. Chat answers still use the model.
One runtime cache stores the public starter without conversations, outside `public/`.
Missing or changed data is rebuilt from validated source and replaced atomically.

## Download the current project

The answer appears first. Click **Create project ZIP** under **Actions**
to begin. Loading, restored history and completed answers never start a build.
The click appears in the conversation. Answers and preparation use the same
three animated dots and a short status line.
Preparation says **Creating project**.
Generation and independent review use the conversation and previous files.
Only a reviewed, assembled ZIP becomes downloadable.

The ready response shows a code-folder icon, at most four words describing the
implemented function, and **Download ZIP**. It slides and fades in unless reduced
motion is on. Details stay in README.md and PROJECT.md; there is no contents disclosure.
The final download starts no model call. A ready card hides the creation action
for that answer. A later answer can offer a new project.
Older saved ZIPs with long summaries use up to four words from their project name.

Completed packages stay beside their original answer. A later click uses the
current conversation. Earlier files stay available internally for the next revision.
There is no **Download last ready ZIP** action. Changed files and removals are
applied before full validation and review. Missing essential details, scope
violations or failures produce no replacement; an earlier ZIP is not the updated project.

A temporarily unavailable review may run once more within the same 115-second
deadline. Cancellation, timeouts, and rejected or malformed reviews do not trigger
this retry. Generation is not repeated.

A failure offers **Try again**, which retries only when selected. Redraws
never retry it. Reloading or another tab can prepare again without a matching ZIP.

A successful replacement overwrites the separate `:project` browser-storage
entry. Only one archive is persisted; the open page keeps at most twelve package
responses. Reloaded projects still require a creation click before display.
A saved starter selection can restore its configured archive, but cannot recover lost custom files.

**New conversation** clears the saved project. Files downloaded onto your device
remain there. A changed conversation, language change, or reset cancels preparation.
Late results cannot replace the current state. If browser storage fails, a
current ready ZIP remains available in memory.

## Continue locally

The ZIP contains sources, `.gitignore`, README setup/check instructions, and
`PROJECT.md` decisions. `AGENTS.md`, its `CLAUDE.md` import, and `docs/agent-tools.md`
help the next agent. Existing project instructions remain intact.

A fresh Git repository on `main` has no commits, index, identity, hooks, or
remote. Files are untracked and ready for your first commit. Install dependencies
and SDKs locally; the archive bundles no third-party binaries or dependency trees.

The service neither executes nor deploys generated code. Review cannot prove it
works; inspect the files and run their checks.
See [Continue a downloaded project with an agent](https://stage.dev/resources/starchat-agent-handoff)
for Codex, Claude Code, Grok Build, and optional plugins.

Local edits cannot be uploaded or synchronized. Compare a later ZIP separately before merging.

## Account for processing and limits

Preparation uses the installation's model account and capacity. Its provider
receives the conversation and previous files. Document this processing and
browser storage before enabling building.

Input allows 80 messages and 24 KiB of conversation within a 192 KiB request.
Projects permit 40 UTF-8 files, 16 KiB each, and 32 KiB of serialized JSON,
including handoff files. Oversized input is rejected without dropping requirements.
See [operations](https://stage.dev/resources/starchat-operations) for deadlines
and capacity. Rate limits are not a spending cap.

Temporary ZIPs are removed after each request. Visitor archives are not retained
on the server; the public starter cache is separate. Verify provider retention
from its actual settings and terms.
