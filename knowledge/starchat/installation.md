---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-20'
review_status: reviewed
source_version: 'skyyware/starchat v0.10.4'
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
  - 'suggestion labels'
phrase_terms:
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

Starchat 0.10.4 requires PHP 8.4 or later PHP 8, Composer, its declared extensions,
and SQLite FTS5. Serve only `public/` through HTTPS. Keep credentials and runtime
outside Git and the public directory.

## Create the project

The core is private; the [public example](https://github.com/skyyware/starchat-demo)
grants no access. With authorized access, copy `examples/installation` from
Starchat 0.10.4 into an empty project:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.10.4 --no-plugins --no-scripts
```

Keep Composer credentials outside Git. Commit both Composer files.
Route non-file requests to `public/index.php`; it calls `Starchat\App::run()`
with the project root.

## Set the purpose and knowledge

Edit `installation.json`. Set a unique `id`, allowed HTTPS `hosts`, `website`,
`scope`, interface `copy`, and `brand`. Define what the chat helps with.
The host and knowledge owner must agree. Visitors cannot select another installation.

Optional `copy.<locale>.missing` sets the no-information answer: 1 to 500
nonblank plain-text characters. Locale fallback applies.
Omit it for defaults; service-unavailable messages are unchanged.

Suggestions use short single-line labels and submit their full question.
The [answer API](https://stage.dev/resources/starchat-answer-api) defines both fields.
Labels and submitted replies omit trailing full stops, including restored choices.
Question marks and internal punctuation remain.

Building installations can mix four familiar and less obvious
[opening app ideas](https://stage.dev/resources/starchat-app-ideas) per conversation.

Set fonts, logo, favicon, and stylesheet through `brand`. The logo opens
`brand.home_url` in the same tab, or `/` when unset. Use an HTTPS homepage.

For shared branding, set `brand.asset_origin` to a trusted HTTPS origin with
paths under `/branding/`. Revalidate styles and allow cross-origin font reads.
This permits styles, fonts, and images, not scripts or APIs. Otherwise assets stay local.

`header_link` adds an HTTPS link beside the language selector.
Questions and actions each allow four controls. Neither displaces the other.
Actions sit below questions, using regular text without icons.
**More actions** pages extra formats, three per page. Four questions use two columns when space allows.

Tab focuses suggestions; Enter, Space, clicks and taps activate.
Number keys and custom shortcuts do not select suggestions.
Remove `suggestion_shortcuts` when upgrading.

Replace the starter article with reviewed Markdown under `knowledge/<category>/`.
Set each document's `entity` to your installation ID. Supply your legal notices.

Build the index from the project directory:

```sh
vendor/bin/starchat index
```

The command reports the ID and article count. Validation failure preserves the
index. Indexing does not check facts.

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

Building is off by default. It supports permitted languages, including Python or
Java without Stage or PHP. The chat server needs PHP's zip extension.

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
Rebuild the index to validate settings and the zip extension. Assets stay off
after upgrades; set `asset.type` to `project` for downloads. Remove both `asset`
and `building` to disable downloads and generation.

Click **Create project ZIP** after an answer. Three animated dots and a status
line precede the result; answers alone never build it.
An optional `building.starter` supplies a reviewed app. Custom work passes
generation and independent review. **Download ZIP** starts no further model request.

See [project downloads](https://stage.dev/resources/starchat-building)
for contents, revisions and limits. Notices must describe requested preparation,
model input and browser storage. The service does not execute or deploy generated code.

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

Check `/health` for the ID, article count and `aggregate_rate_limit`.
Try synthetic and unrelated questions on desktop and mobile. Read answers and sources.

Keep previous code and index for rollback. Preserve data and credentials.
Installation grants no hosting, accounts, budget or organizational policy.
See [operations](https://stage.dev/resources/starchat-operations) for deployment
checks, deadlines, and rate limits.
