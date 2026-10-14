---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.6.1'
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
  - tastenkürzel
  - fragevorschläge
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
  - tastenkürzel
  - fragevorschläge
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
  -
    label: 'Use verified session context'
    url: 'https://stage.dev/resources/starchat-request-context'
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: 'Configure opening app ideas'
    url: 'https://stage.dev/resources/starchat-app-ideas'
based_on: {  }
follow_ups: {  }
---

# Install Starchat

Starchat 0.6.1 requires PHP 8.4 or later PHP 8, Composer, its declared extensions,
and SQLite FTS5. Serve only `public/` through HTTPS. Keep credentials and runtime
outside Git and the public directory.

## Create the project

The core is private. The public
[example installation](https://github.com/skyyware/starchat-demo) requires
authorized access to that dependency and grants none.

With authorized access, copy `examples/installation` from Starchat 0.6.1
into an empty project. Run:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.6.1 --no-plugins --no-scripts
```

Keep Composer credentials outside Git and retain both Composer files. Route
non-file requests to `public/index.php`, which calls `Starchat\App::run()`
with the project root.

## Set the purpose and knowledge

Edit `installation.json`. Set a unique `id`, allowed HTTPS `hosts`, `website`,
`scope`, interface `copy`, and `brand`. Define what the chat helps with.
The host and knowledge owner must agree. Visitors cannot select another installation.

Use broad starter questions without assuming a technical background or chosen
project. Later suggestions follow the visitor's stated goal.

Building installations can offer four app ideas per conversation, mixing
familiar and less obvious uses. See [opening app ideas](https://stage.dev/resources/starchat-app-ideas)
for configuration and limits.

Set `brand.home_url` to your HTTPS homepage. The logo or wordmark opens it in the same tab,
or `/` when unset. There is no extra Home link. Set fonts, logo, favicon, and
stylesheet through `brand`.

For shared branding, set `brand.asset_origin` to a trusted HTTPS origin with
paths under `/branding/`. Revalidate styles and allow cross-origin font reads.
Permission covers styles, fonts, and images, excluding scripts and APIs.
Without this setting, assets stay local.

Optional `header_link` adds a labelled HTTPS destination beside the language
selector. Four suggestions use two columns. Other counts wrap to fit their text.
Your stylesheet can change this layout.

Suggestions have no custom keyboard shortcuts or numbered labels. Tab focuses.
Enter or Space activates. Clicking and tapping work too.
Number keys do not select suggestions. Remove `suggestion_shortcuts` when
upgrading. It no longer enables shortcuts.

Replace the starter article with reviewed Markdown under `knowledge/<category>/`.
Set each document's `entity` to your installation ID. Supply your legal notices.

Build the index from the project directory:

```sh
vendor/bin/starchat index
```

Expect the installation ID and document count. Failed validation preserves the
index. Indexing does not fact-check articles.

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

Building is off by default. Projects can use any language
allowed by your installation, including Python or Java, without Stage or PHP.
Install PHP's zip extension on the chat server.

Adapt these fields in `installation.json` to the work you support:

```json
{
	"scope": "Help visitors build small Python command-line tools.",
	"asset": {"type": "project"},
	"building": {
		"enabled": true,
		"instructions": "Use Python's standard library. Document setup and checks."
	}
}
```

`building.instructions` cannot widen `scope`. These are operator settings;
visitor messages cannot replace them. Rebuild the index to validate the settings
and zip extension. Assets are off by default, including after an upgrade: set
`asset.type` to `project` for the download. To disable downloads and generation,
remove both `asset` and `building`.

The answer appears before project preparation starts. You can keep chatting.
An optional `building.starter` supplies a reviewed ready application. Custom
work still passes generation, independent review, and ZIP creation.
**Download ZIP** downloads the prepared archive without a model request.

See [project downloads](https://stage.dev/resources/starchat-building)
for contents, revisions, limits, and recovery. Describe automatic
preparation, model input, and browser storage in your notices before enabling it.
The service does not execute generated code or deploy it.

## Offer other conversation assets

PDF summaries and email drafts need no project building. Contact actions and
Markdown downloads can accompany the selected type. See
[conversation assets](https://stage.dev/resources/starchat-assets) for configuration and limits.

## Connect a signed-in application

For optional account facts, see
[verified session context](https://stage.dev/resources/starchat-request-context).
It cannot share an installation with building or origin migration. Summaries
and contacts require fresh context checks before preparation and display.

## Check the installation

Check the ID, document count, and `aggregate_rate_limit` at `/health`. Try a guide,
synthetic and unrelated questions, and desktop and mobile layouts. Read each
answer and its sources.

Keep previous code and index for rollback. Preserve data and credentials.
Installation grants no hosting, accounts, spending cap, or organizational policies.
See [operations](https://stage.dev/resources/starchat-operations) for deployment
checks, deadlines, and rate limits.
