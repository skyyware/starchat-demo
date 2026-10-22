---
id: starchat-building
entity: stage
title: 'Build and download a project'
source: 'https://stage.dev/resources/starchat-building'
retrieved_at: '2026-10-22'
review_status: reviewed
source_version: 'skyyware/starchat v0.11.3'
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
  - chat.stage.dev
  - 'stage inventory'
  - 'building policy'
  - 'export policy'
  - exportregeln
  - python-only
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
  - chat.stage.dev
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
  - 'building policy'
  - 'export policy'
  - 'policy change'
  - 'old zip files'
  - 'alte zip dateien'
  - exportregeln
  - stage-web-v1
  - 'stage inventory'
  - python-only
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
  -
    label: 'Stage demo export contract'
    url: 'https://github.com/skyyware/starchat-demo/blob/42491f8fd4175bd2d937792f37df68dd6e8bb0cb/docs/building.md'
based_on: {  }
follow_ups: {  }
---

# Build and download a project

## Define the first useful version

Building is off by default. Set `building.enabled`, `building.instructions`,
and `asset.type: project`. These cannot widen `scope`; visitors cannot replace them.
Install PHP's zip extension and rebuild the index.

Projects can use any language allowed by your installation, including
Python or Java. The engine imposes no framework.

At **chat.stage.dev**, all projects and revisions run on Stage 0.2 and PHP 8.4.
`public/index.php` runs `app.php`; Stage routes implement the feature. An unused
dependency is insufficient. Incompatible platforms receive an honest scope
explanation, not a substituted project.

The Stage demo helps people without an idea or programming knowledge find an
everyday problem and one useful workflow, asking one material question at a time.
`PROJECT.md` separates provisional choices, agreements and later work.

Human-facing exports require responsive views, local styles, readable type,
keyboard focus, labeled inputs, validation, empty states and saved results.
The primary workflow includes agreed edits and deletion. Explicit API-only
requests remain APIs. Generation and review do not prove execution or visual quality.

Optional `building.policy` enforces an installation's export contract before
independent review and packaging. The Stage demo uses `stage-web-v2`.
Changing the policy version makes an old snapshot revision input, not a current
download. Only a creation click requests replacement; failure preserves its files.
See [Install Starchat](https://stage.dev/resources/starchat-installation).

## Offer a ready starter

`building.starter`, for example `starters/minimal.json`, contains `status: "ready"`,
`name`, `summary`, `open_questions`, and `files` with `path` and `content`.
Review and run it before release. Starchat supplies no built-in app.
Disabled building cannot declare a starter.

An explicit framework, runnable-example or starter request can offer it without
a project name or first feature. Pure idea discovery first finds a useful purpose;
it does not explain or offer a greeting starter. Installation rules may narrow
eligibility. An explicit different technology must still fit installation scope.
A custom project cannot be reset to the starter.
Revising a starter passes its files into custom work. On first custom generation,
`starter_project` supplies reference files; they are not merged automatically.

`starchat index` prepackages it. `GET /project/starter` returns the project and
base64 ZIP without generation or review; chat answers still use the model.
The conversation-free cache stays outside `public/`. Missing or changed entries
are rebuilt from validated source and replaced atomically.

## Download the current project

The answer appears first. Click **Create project ZIP** below the questions
to begin; loading, history restoration and answers never start a build.
The click appears in the conversation. Preparation uses the same three animated
dots as answers, with **Creating project**. Generation and independent review
use the conversation and previous files. Only a reviewed ZIP becomes downloadable.

Ready responses show a package icon, up to four words describing its function and
**Download ZIP**, which starts no model call. Details stay inside README.md and
PROJECT.md. Creation hides for that answer; later answers can offer new projects.
Old ZIPs with long summaries use up to four words from their project name.

Packages stay beside their original answer. Later clicks use the current
conversation and earlier files. There is no **Download last ready ZIP** action.
Changed files and removals are applied before validation and review. Missing
essentials, scope violations or failures leave the earlier project unreplaced.

An unavailable review may retry once within the same 150-second deadline.
Cancellation, timeouts and rejected or malformed reviews do not retry.
Generation is not repeated.

A failure offers **Try again**, only when selected. Reloading or another tab
can prepare again without a matching ZIP; redraws never retry.

A successful replacement overwrites the `:project` storage entry: one saved
archive, at most twelve package responses in the open page. Reloads require a creation click.
A saved starter selection can restore its configured archive, but cannot recover lost custom files.

**New conversation** clears the saved project. Files downloaded onto your device
remain there. Conversation or language changes cancel preparation and fence late results.
If storage fails, the ready ZIP remains in memory.

## Continue locally

The ZIP contains sources, `.gitignore`, README instructions and `PROJECT.md`.
AGENTS.md, CLAUDE.md and optional tool guidance help the next agent.
Existing project instructions remain intact.

A fresh Git repository on `main` has no commits, index, identity, hooks, or remote.
Install dependencies and SDKs locally; no binaries or dependency trees are bundled.

The service neither executes nor deploys generated code. Run its checks locally.
See [Continue a downloaded project with an agent](https://stage.dev/resources/starchat-agent-handoff)
for coding hosts and optional plugins.

Local edits do not synchronize. Compare later ZIPs before merging.

## Account for processing and limits

The provider receives the conversation and previous files, using the installation's
model account and capacity. Disclose this and browser storage before enabling it.

Input allows 80 messages and 24 KiB of conversation within a 192 KiB request.
Projects permit 40 UTF-8 files, 16 KiB each, and 32 KiB of serialized JSON,
including handoff files. Oversized input is rejected without dropping requirements.
See [operations](https://stage.dev/resources/starchat-operations) for deadlines
and capacity. Rate limits are not a spending cap.

Temporary ZIPs are removed after each request; the public starter cache is separate.
Verify provider retention from its settings and terms.
