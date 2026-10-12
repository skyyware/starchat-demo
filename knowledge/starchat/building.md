---
id: starchat-building
entity: stage
title: 'Build and download a project'
source: 'https://stage.dev/resources/starchat-building'
retrieved_at: '2026-10-12'
review_status: reviewed
source_version: 'skyyware/starchat v0.4.6'
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
based_on: {  }
---

# Build and download a project

When an operator enables building, Starchat prepares a project from the
conversation. The download contains source files and instructions for working
locally. It is not a transcript of the chat.

## Enable the work your installation supports

Building is off by default. An operator enables `building.enabled` and supplies
`building.instructions` in `installation.json`. Those instructions cannot widen
the installation's `scope`. Visitor messages cannot replace these settings.
Install PHP's zip extension on the chat server and rebuild the knowledge index.
See [Install Starchat](https://stage.dev/resources/starchat-installation) for
the configuration example.

Projects can use any language allowed by your installation, including Python or
Java. The generated project does not need Stage or PHP. Define the intended
users, a first useful behavior, and constraints for custom work. Suggestions are
proposals until the visitor chooses them.

## Offer a ready starting point

An operator can set `building.starter` to `starters/minimal.json`. This file is
a complete project object with `status: "ready"`, `name`, `summary`,
`open_questions`, and `files`. Each file supplies `path` and `content`.
The operator reviews and runs this application before release. Its summary must
match its technology and behavior. Starchat does not supply a built-in Stage app.
A disabled building configuration cannot declare a starter.

The answer and independent answer reviewer can select it for a compatible
introductory or nonspecific request. It can appear with the first answer, without
a project name, audience, or first feature. An explicit different technology or
custom feature uses normal preparation. A later answer cannot reset a saved
custom project to the starter. Revising a starter passes its files into custom work.

`starchat index` prepackages the configured application. The browser fetches it
through `GET /project/starter`, which returns project data and a base64 ZIP
without a generation or review model call. Chat answers still use the model.
The server keeps one runtime cache of this public starter, containing no
conversation. It rebuilds a missing or changed cache from validated source and
replaces the older artifact atomically. Keep the source and cache outside
`public/`. The same file and archive limits apply.

## Download when preparation finishes

After a completed answer, the browser automatically prepares custom work
in the background. The generator and an independent reviewer use the actual
conversation and any previous files. The visitor can keep chatting.

**Download project ZIP** appears only after generation, review, and ZIP creation
succeed. Clicking downloads that prepared archive without a model request.
Repeating the download reuses the same archive. Missing essential decisions
or an out-of-scope result produce no new archive. An existing ready ZIP remains
available.

A failed preparation offers **Prepare again**. It retries only when selected.
Ordinary redraws do not repeat failed attempts. This guard lasts for the open
page; reloading or opening another tab can prepare again without a matching ZIP.

## Keep the archive aligned with the conversation

The last ready ZIP stays available while you ask another question or wait for
changes. **Download last ready ZIP** identifies the earlier version until a
replacement is ready. Later changes are not included yet.

Missing details, out-of-scope results, and preparation failures preserve that
ZIP. A successful replacement overwrites the previous project under the
installation's separate `:project` browser-storage key. Obsolete Blob URLs,
the browser's temporary download addresses, are released.

A saved starter selection can restore the configured starter when its archive
is missing. This recovery cannot restore lost custom files.

**New conversation** clears the saved project. Files already downloaded onto
the visitor's device remain there. A new question, language change, or reset
cancels preparation in progress. Late results cannot replace the current state.
If browser storage fails, the ready ZIP remains available in memory. Changes
to files outside the chat cannot be uploaded or synchronized.

## Inspect the project before using it

The ZIP contains source files, a README with setup, run, and check instructions,
`PROJECT.md` with decisions and open questions, and `.gitignore`. It includes a
fresh Git repository on `main`, with no commits, index, identity, hooks, or
remote. Extracted files are untracked and ready for the visitor's first commit.
Install dependencies and platform SDKs locally. The archive does not bundle
third-party binaries or dependency trees.

The service does not execute generated code or deploy it. Independent review
checks the proposed files but cannot establish that they work. Read them and
run the documented checks locally before relying on the result.

## Account for automatic processing and limits

Custom preparation uses the installation's model account, profile, and request
capacity in addition to the chat answer. The model receives the conversation
and previous generated files when available. Before enabling building, describe
this processing and browser storage in the installation's privacy notice.

Input allows up to 80 messages and 24 KiB of serialized conversation, within a
192 KiB HTTP request. Output permits 40 UTF-8 text files, 16 KiB each, and 32 KiB
per serialized project. Oversized input is rejected without dropping earlier
requirements. See [operations](https://stage.dev/resources/starchat-operations)
for request capacity and generation deadlines. Rate limits are not a spending cap.

Temporary ZIP files are removed after each server request. Visitor-generated
archives are not retained on the server; the public starter cache is separate.
This does not establish provider retention. Verify the actual settings and terms.
