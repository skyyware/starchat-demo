---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-11'
review_status: reviewed
source_version: 'skyyware/starchat v0.3.1'
public_path: /resources/starchat-installation
topic_terms:
  - 'starchat installation'
  - 'install starchat'
  - 'starchat setup'
  - 'keyboard shortcuts'
  - 'keyboard shortcut'
  - 'suggestion shortcuts'
  - 'number shortcuts'
  - 'suggested question'
  - 'suggested questions'
  - 'tastenkürzel'
  - 'fragevorschläge'
  - building
  - 'project zip'
  - 'project export'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt export'
phrase_terms:
  - 'install starchat'
  - 'set up starchat'
keywords:
  - 'starchat installation'
  - 'install starchat'
  - 'starchat setup'
  - keyboard
  - shortcuts
  - 'number shortcuts'
  - 'suggested question'
  - 'suggested questions'
  - 'tastenkürzel'
  - 'fragevorschläge'
  - building
  - 'project zip'
  - 'project export'
  - 'python project'
  - 'java project'
  - 'projekt zip'
  - 'projekt export'
links:
  -
    label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  -
    label: 'Maintain knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
  -
    label: 'Public example installation'
    url: 'https://github.com/skyyware/starchat-demo'
  -
    label: 'Operate Starchat'
    url: 'https://stage.dev/resources/starchat-operations'
based_on: {  }
---

# Install Starchat

Starchat 0.3.0 requires PHP 8.4 or later PHP 8, Composer, its declared extensions,
and SQLite FTS5. Serve only `public/` through HTTPS. Keep credentials and runtime
outside Git and the public directory.

## Create the project

The core repository is private. The public
[example installation](https://github.com/skyyware/starchat-demo) requires
existing authorized access to that Composer dependency. It does not grant access.

With access to Starchat 0.3.0, copy `examples/installation` from that release
into an empty project directory. Run:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.3.0 --no-plugins --no-scripts
```

Keep Composer authentication outside Git and retain both Composer files.
The starter calls `Starchat\App::run()` with the project root. Route requests
that do not match public files to `public/index.php`.

## Set the purpose and knowledge

Edit `installation.json`. Set a unique `id`, allowed HTTPS `hosts`, `website`,
`scope`, interface `copy`, and `brand`. Define what the chat helps with.
The host and knowledge owner must agree. Visitors cannot select another installation.

Use broad starter questions without assuming a technical background or chosen
project. Later suggestions follow the visitor's stated goal.

Set `brand.home_url` to your HTTPS homepage. The logo or wordmark opens it in
the same tab, or `/` when unset. There is no additional Home link. Supply your
fonts, logo, favicon, and stylesheet through `brand`.

For shared branding, set `brand.asset_origin` to a trusted HTTPS origin with
paths under `/branding/`. Revalidate styles and allow cross-origin font reads.
Permission covers styles, fonts, and images, excluding scripts and APIs.
Without this setting, assets stay local.

Optional `header_link` adds a labelled HTTPS destination beside the language
selector. Suggestions fit their text and wrap unless your stylesheet changes it.

Suggestions have no custom keyboard shortcuts or numbered labels. Use Tab to
focus, then Enter or Space to activate. Clicking and tapping work too.
Number keys do not select suggestions. Remove `suggestion_shortcuts` when
upgrading. It no longer enables shortcuts.

Replace the starter article with reviewed Markdown under `knowledge/<category>/`.
Set each document's `entity` to your installation ID. Supply your legal notices.

Build the index from the project directory:

```sh
vendor/bin/starchat index
```

Expect the installation ID and document count. Validation preserves the previous
index on failure and does not fact-check articles.

## Connect the model

Stage Chat Codex is the default adapter. Configure `STARCHAT_CODEX_BINARY`,
`STARCHAT_CODEX_HOME`, and `STARCHAT_CODEX_WORK` for an approved executable,
dedicated authenticated service home, and empty private working directory.
A human completes account setup.

Set `STARCHAT_RUNTIME` to private writable storage. `STARCHAT_MODEL` and
`STARCHAT_REASONING_EFFORT` select the model and reasoning level.
Defaults are Astra (`gpt-6-astra`), `low`, and `fast`. Existing overrides apply.
Set `STARCHAT_SERVICE_TIER=fast` when replacing `auto`; explicit `auto` can select
catalogue-verified Ultrafast through `STARCHAT_MODEL_CATALOG`. These settings
grant no access. A provider rejection does not trigger a tier fallback.

## Enable project ZIP downloads

Building is optional and off by default. It can generate projects in any language
allowed by your installation, including Python or Java. Stage and PHP are not
required in the generated project. Install PHP's zip extension on the chat server.

Adapt these fields in `installation.json` to the work you support:

```json
{
	"scope": "Help visitors build small Python command-line tools.",
	"building": {
		"enabled": true,
		"instructions": "Use Python's standard library. Document setup and checks."
	}
}
```

`building.instructions` cannot widen `scope`. These are operator settings;
visitor messages cannot replace them. Rebuild the index to validate the settings
and zip extension. Set `building.enabled` to `false`, or remove `building`,
to disable the control and project generation.

After describing a goal, select **Project ZIP**. Missing essential decisions
produce a question. A ready ZIP contains source files, a README with setup and
checks, `PROJECT.md`, `.gitignore`, and a fresh Git repository on `main` with
no commits or remote. Install dependencies locally. The service generates and
reviews files but does not execute generated code or deploy it.

The browser saves the latest successful project. Downloading it again without
conversation changes reuses that snapshot. After new decisions, **Update project
ZIP** uses the previous files and conversation to create a replacement snapshot.
External file edits cannot be uploaded or synchronized. **New conversation**
clears the saved project. If browser storage fails, the current download remains
available in memory.

Exports allow 40 UTF-8 text files, 16 KiB per file, and 32 KiB per serialized
project. Conversation input is limited to 80 messages and 24 KiB. Oversized input
is rejected visibly. Generation and review share the installation's model profile
and request capacity. Describe this processing and browser storage in your notices.
Review the files and run their documented checks locally. Model review does not
establish that the generated code works.

## Check the installation

Check the installation ID, document count, and `aggregate_rate_limit` at `/health`.
Try a guide, synthetic and unrelated questions, and desktop and mobile layouts.
Read the answers and sources.

Keep previous code and index for rollback. Preserve production data and credentials.
Installation grants no hosting, accounts, spending cap, or organizational policies.
See [operations](https://stage.dev/resources/starchat-operations) for deployment
checks, deadlines, and rate limits.
