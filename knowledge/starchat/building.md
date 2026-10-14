---
id: starchat-building
entity: stage
title: 'Build and download a project'
source: 'https://stage.dev/resources/starchat-building'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.5.0'
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
---

# Build and download a project

With building enabled and `asset.type: project`, Starchat prepares project
files and local instructions from the conversation.

## Define the first useful version

Building is off by default. The operator sets `building.enabled` and
`building.instructions`, plus `asset.type: project`, in `installation.json`.
These cannot widen `scope`;
visitor messages cannot replace them. Install PHP's zip extension on the server
and rebuild the index. See [Install Starchat](https://stage.dev/resources/starchat-installation)
for setup.

Projects can use any language allowed by your installation, including
Python or Java, without Stage or PHP. Describe the first useful behavior and
constraints. Suggestions remain proposals until chosen.

A concrete goal can produce a first version with open choices. A task list can
add, edit, complete, and delete tasks while storage remains provisional.
`PROJECT.md` separates these choices from your decisions. A missing requirement
that blocks useful work still needs an answer.

## Offer a ready starter

An operator can set `building.starter` to `starters/minimal.json`. The JSON file
contains `status: "ready"`, `name`, `summary`, `open_questions`, and `files` with
`path` and `content`. Review and run this application before release. Its summary
must match its behavior. Starchat supplies no built-in Stage app. Disabled
building cannot declare a starter.

The answer and its independent reviewer can select the starter for a compatible
introductory request. It can appear with the first answer, without a project name or first feature. An explicit different technology or custom feature uses normal
preparation. Later answers cannot reset a custom project to the starter.
Revising a starter passes its files into custom work.

`starchat index` prepackages it. `GET /project/starter` returns the project and
base64 ZIP without a generation or review model call. Chat answers still use the
model. One runtime cache stores this public starter without conversations.
Missing or changed cache data is rebuilt from validated source and replaced
atomically. Keep source and cache outside `public/`.

## Download the current project

After each completed answer, the browser automatically prepares custom work.
The generator and independent reviewer use the conversation and previous
generated files. You can keep chatting. An answer hides the old download; ZIP
preparation shows progress without a percentage or promised completion time.

**Download ZIP** appears after generation, review, and ZIP creation
succeed for the current conversation. It downloads the archive without a model
request. Repeated downloads reuse that archive.

A new question hides the previous download. Earlier files stay available
internally for the next revision. There is no **Download last ready ZIP** action.
Starchat applies changed files and explicit removals, then validates and reviews
the complete project. Missing essential details, an out-of-scope result, or a
preparation failure produces no current download.

A temporarily unavailable review may run once more within the same 115-second
deadline. Cancellation, timeouts, and rejected or malformed reviews do not trigger
this retry. Generation is not repeated.

A failed preparation offers **Prepare again**. It retries only when selected.
Redraws do not repeat failed attempts. This guard lasts for the open page;
reloading or opening another tab can prepare again without a matching ZIP.

A successful replacement overwrites the installation's separate `:project`
browser-storage entry. Obsolete Blob URLs, the browser's temporary download
addresses, are released. A saved starter selection can restore the configured
starter when its archive is missing. This cannot restore lost custom files.

**New conversation** clears the saved project. Files downloaded onto your device
remain there. A new question, language change, or reset cancels preparation.
Late results cannot replace the current state. If browser storage fails, a
current ready ZIP remains available in memory.

## Continue locally

The ZIP contains source files, `.gitignore`, README setup and check instructions,
and `PROJECT.md` with confirmed requirements, provisional choices, and open
questions. `AGENTS.md`, its `CLAUDE.md` import, and `docs/agent-tools.md` help the
next agent. Existing project-specific instructions remain intact.

A fresh Git repository on `main` has no commits, index, identity, hooks, or
remote. Files are untracked and ready for your first commit. Install dependencies
and SDKs locally; the archive bundles no third-party binaries or dependency trees.

The service does not execute generated code or deploy it. Independent review
cannot prove that the application works. Inspect the files and run their checks.
See [Continue a downloaded project with an agent](https://stage.dev/resources/starchat-agent-handoff)
for Codex, Claude Code, Grok Build, and optional plugins.

Changes outside the chat cannot be uploaded or synchronized. A later website ZIP
does not contain your local edits. Compare it in a separate directory before merging.

## Account for processing and limits

Preparation uses the installation's model account and capacity. Its provider
receives the conversation and previous files. Document this processing and
browser storage before enabling building.

Input allows 80 messages and 24 KiB of serialized conversation within a 192 KiB
HTTP request. The complete project permits 40 UTF-8 text files, 16 KiB each, and
32 KiB of serialized JSON, including handoff files. Oversized input is rejected
without dropping earlier requirements. See [operations](https://stage.dev/resources/starchat-operations)
for deadlines and capacity. Rate limits are not a spending cap.

Temporary ZIPs are removed after each request. Visitor archives are not retained
on the server; the public starter cache is separate. Verify provider retention
from its actual settings and terms.
