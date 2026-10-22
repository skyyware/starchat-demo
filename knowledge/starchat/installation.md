---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-22'
review_status: reviewed
source_version: 'skyyware/starchat v0.11.3'
public_path: /resources/starchat-installation
topic_terms:
  - 'configure building policy'
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
  - 'suggestion labels'
phrase_terms:
  - project-policy.php
  - 'suggested questions and actions'
  - 'separate actions'
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
  - suggestion_labels
  - 'building policy'
  - project-policy.php
  - stage-web-v1
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
  -
    label: 'Read suggested replies and contacts from the answer API'
    url: 'https://stage.dev/resources/starchat-answer-api'
based_on: {  }
follow_ups: {  }
---

# Install Starchat

Starchat 0.11.3 needs PHP 8.4 or later PHP 8, Composer, its declared extensions
and SQLite FTS5. Serve only `public/` over HTTPS; keep credentials and runtime outside it and Git.

## Create the project

The core is private; the [public example](https://github.com/skyyware/starchat-demo)
grants no access. With access, copy Starchat 0.11.3's `examples/installation`
into an empty project:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.11.3 --no-plugins --no-scripts
```

Commit both Composer files. Route non-file requests to `public/index.php`,
which calls `Starchat\App::run()` with the project root.

## Set the purpose and knowledge

In `installation.json`, set a unique `id`, allowed HTTPS `hosts`, `website`,
`scope`, interface `copy` and `brand`. Host and knowledge owner must agree.
Visitors cannot select another installation.

Optional `copy.<locale>.missing` sets a 1–500-character nonblank plain-text no-information
answer with locale fallback, without changing service errors.

Suggestions use short single-line labels and submit their full question.
See the [answer API](https://stage.dev/resources/starchat-answer-api).
Labels and replies omit trailing full stops, including restored choices.
Question marks and internal punctuation remain.

Building installations can mix four familiar and less obvious
[opening app ideas](https://stage.dev/resources/starchat-app-ideas) per conversation.

`brand` sets fonts, logo, favicon and stylesheet. The logo opens HTTPS
`brand.home_url` in the same tab, or `/` when unset.

`brand.asset_origin` permits styles, fonts and images under a trusted HTTPS
origin's `/branding/`, never scripts or APIs. Revalidate styles and font CORS.
Otherwise assets stay local.

`header_link` adds an HTTPS link beside the language selector.
Questions and actions each allow four controls independently.
Actions appear below questions with regular text and no icons.
`brand.reset_icon: true` adds a desktop plus to **New conversation**; mobile
keeps its accessible 44px icon button. The boolean defaults to false; other
actions remain icon-free.
**More actions** pages extra formats, three per page. Four questions use two columns when space allows.

Tab focuses suggestions; Enter, Space, clicks and taps activate.
Number keys and custom shortcuts do not select suggestions.
Remove `suggestion_shortcuts` when upgrading.

Put reviewed Markdown under `knowledge/<category>/`, with `entity` set to your
installation ID. Supply legal notices.

Index from the project directory:

```sh
vendor/bin/starchat index
```

Validation failure preserves the index. Indexing does not check facts.

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

Building is off by default. The engine supports permitted languages, including
Python or Java; the chat server needs PHP's zip extension.

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

`building.instructions` cannot widen `scope`; visitors cannot replace either.
Reindex. Upgrades leave assets off. Remove `asset` and `building` to disable them.

Optional `building.policy` names a version such as `web-app-v1`. Trusted
`config/project-policy.php` returns a closure accepting `Starchat\Project`
and strict `true` on success; a missing closure fails validation. Inspect text,
never execute files. It checks starters and assembled revisions before review
and packaging. Increment the version when requirements change; old files remain
revision input after an explicit click.
The Stage demo uses `stage-web-v2`. Its generation and review instructions
also require responsive interfaces for human-facing projects.

Click **Create project ZIP** after an answer. Three animated dots and a status
line precede the result; answers alone never build it.
An optional `building.starter` supplies a reviewed app. Custom work passes
generation and independent review. **Download ZIP** starts no further model request.

See [project downloads](https://stage.dev/resources/starchat-building)
for contents, revisions and limits. Disclose model input and browser storage.
The service does not execute or deploy generated code.

## Offer other conversation assets

PDF summaries and email drafts need no project building. Contact actions and
Markdown downloads can accompany the selected type. See
[conversation assets](https://stage.dev/resources/starchat-assets) for configuration and limits.

## Connect a signed-in application

Optional [session context](https://stage.dev/resources/starchat-request-context)
cannot coexist with building or origin migration. Summaries and contacts require
fresh context checks before preparation and display.

## Check the installation

Check `/health`: ID, article count and `aggregate_rate_limit`. Read synthetic
answers and sources on desktop and mobile. Keep rollback code and index;
preserve data and credentials. See [operations](https://stage.dev/resources/starchat-operations)
for deployment, deadlines and rate limits.
