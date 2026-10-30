---
id: starchat-building
entity: stage
title: 'Build and download a project'
source: 'https://stage.dev/resources/starchat-building'
retrieved_at: '2026-10-31'
review_status: reviewed
source_version: 'skyyware/starchat v0.12.0'
public_path: /resources/starchat-building
topic_terms:
  - building
  - 'project zip'
  - 'project download'
  - 'project export'
  - 'project preparation'
  - 'prepare again'
  - 'building.environment'
  - 'ready starter'
  - 'prepared starter'
  - 'verified technology versions'
  - 'starter cache'
  - 'download disappears'
  - 'starter recovery'
  - 'fertige starter app'
  - 'composer.lock'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt vorbereiten'
  - 'erneut vorbereiten'
phrase_terms:
  - 'chat.stage.dev'
  - 'stage inventory'
  - 'building policy'
  - 'export policy'
  - exportregeln
  - 'python-only'
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
  - 'chat.stage.dev'
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
  - 'building.environment'
  - 'ready starter'
  - 'prepared starter'
  - 'verified technology versions'
  - 'starter cache'
  - 'download disappears'
  - 'previous zip'
  - 'zip verschwindet'
  - 'starter recovery'
  - 'fertige starter app'
  - 'composer.lock'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt vorbereiten'
  - 'erneut vorbereiten'
  - 'previous files'
  - 'browser archive'
  - 'building policy'
  - 'export policy'
  - 'policy change'
  - 'old zip files'
  - 'alte zip dateien'
  - exportregeln
  - 'stage-web-v3'
  - 'docs/technology.json'
  - 'project-environment.php'
  - 'official release metadata'
  - 'stage inventory'
  - 'python-only'
links:
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: 'Project environments and dependency evidence'
    url: 'https://stage.dev/resources/starchat-project-environment'
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Operate Starchat'
    url: 'https://stage.dev/resources/starchat-operations'
  -
    label: 'Continue a downloaded project with an agent'
    url: 'https://stage.dev/resources/starchat-agent-handoff'
  -
    label: 'Public example installation'
    url: 'https://github.com/skyyware/starchat-demo'
based_on: {  }
---

# Build and download a project

## Define the first useful version

Enable `building.enabled`, `building.instructions`, and `asset.type: project`,
install PHP's zip extension, and reindex. Building defaults off. Visitors cannot
replace instructions or widen `scope`. Any language within scope, including Python and Java, is permitted.

The Stage demo requires Stage routes implementing the feature through
`public/index.php` and `app.php`. An unused dependency does not qualify.
Incompatible platforms receive a scope explanation, not a substitute.
Idea discovery finds a useful workflow, one question at a time. `PROJECT.md`
separates agreements, provisional choices and later work.

Human-facing apps need responsive views, local styles, readable type, keyboard
focus, labeled inputs, validation, empty states and saved results, plus agreed edits
and deletion. The default uses native HTML, CSS and JavaScript
without an npm build. Forms work without JavaScript. API-only requests remain
APIs. Generation and review do not prove execution or visual quality.

## Verify technology at creation

The demo's [project environment](https://stage.dev/resources/starchat-project-environment)
verifies compatible stable Stage 0.2, preserves supported explicit versions
and rejects unverified dependencies. New Stage API families need compatibility
verification before use.
Preparation adds `composer.lock` and `docs/technology.json` before policy and
independent review. Existing ZIPs retain their recorded versions.

Local assets need fixed Stage routes through the canonical PHP router.
A file under `public/` alone is insufficient for `composer start`. Check each
stylesheet and script for HTTP 200 and its correct content type. Never derive
asset paths from request input.

Optional `building.policy` checks exports before review and packaging. The demo
uses `stage-web-v3`. A policy change keeps old files as revision input; a new
creation click requests replacement. Failure preserves them. See
[installation](https://stage.dev/resources/starchat-installation) for setup.

## Offer a ready starter

`building.starter` names JSON with `status: "ready"`, `name`, `summary`,
`open_questions`, and `files` containing `path` and `content`. Review and run
it before release. Building must be enabled. Starchat supplies no built-in app.

Explicit framework, runnable-example or starter requests need no project name
or first feature. Idea discovery first finds a purpose. Scope and eligibility apply. Custom work cannot reset to the
starter. Its files become revision input; first custom generation receives
`starter_project` as reference, without an automatic merge.

`starchat index` prepackages the starter. `GET /project/starter` returns its
base64 ZIP without generation or review. An enabled environment prepares it
before policy and cache lookup. The maintainer validates starters. The cache
stays outside `public/`, contains no conversation, and rebuilds changed or
missing entries atomically from validated source.

## Download the current project

After the answer, click **Create project ZIP** below the questions. The click
appears in the conversation; preparation uses the answer indicator. Loading,
history restoration and answers never start a custom build. Generation and
review use the conversation and previous files.

Ready cards show a star, up to four descriptive words, and **Download ZIP**,
which starts no model call. Details stay in README.md and PROJECT.md. Old long
summaries use up to four words from the name.
Cards stay beside their answer. The covered creation action and preceding
questions hide after success; the composer remains. Failures retain questions
and retry. Later answers offer fresh choices with the current conversation and earlier files.

Changed files and removals are assembled before preparation, validation and
review. Missing essentials, scope violations or failure preserve the previous
project. An unavailable review may retry once within the same 150-second deadline.
Cancellation, timeout, rejected or malformed review never retry. Generation is
not repeated. **Try again** requires a click; redraws never retry.

One `:project` archive is saved; at most twelve project responses stay open.
Without a matching ZIP, reloads or another tab need a creation click.
A saved starter selection can restore its configured archive, never lost custom
files. There is no **Download last ready ZIP** action. **New conversation** clears
the saved project, not downloaded files. Conversation or language changes cancel
preparation and reject late results. Storage failure leaves the ZIP in memory.

## Continue locally

The ZIP includes sources, `.gitignore`, README.md, PROJECT.md, AGENTS.md,
CLAUDE.md and tool guidance, preserving existing project instructions.
A fresh Git repository on `main` has no commits, index, identity, hooks or remote.
Install dependencies and run checks locally. No dependency trees or binaries
are bundled. The service never executes or deploys generated code.
[Continue with an agent](https://stage.dev/resources/starchat-agent-handoff)
explains optional plugins. Local edits do not synchronize; compare later ZIPs.

## Account for limits and processing

Disclose browser storage and model input.
Input allows 80 messages and 24 KiB
of conversation within a 192 KiB request. Projects allow 40 UTF-8 files, 16 KiB
each, and 32 KiB of serialized JSON including dependency and handoff files. Dependency and handoff reservations reduce the generation budget; the complete
prepared project still needs to fit. Oversized input is
rejected without dropping requirements. See [operations](https://stage.dev/resources/starchat-operations)
for deadlines and shared capacity. Rate limits are not a spending cap. Temporary
ZIPs are removed per request; the starter cache is separate. Check provider retention.
