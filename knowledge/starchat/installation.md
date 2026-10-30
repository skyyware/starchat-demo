---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-31'
review_status: reviewed
source_version: 'skyyware/starchat v0.12.0'
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
  - 'tastenkürzel'
  - 'fragevorschläge'
  - building
  - 'project zip'
  - 'project export'
  - 'building.environment'
  - 'project-environment.php'
  - 'projekt zip'
  - 'service profiles'
  - 'STARCHAT_SERVICE_TIER'
phrase_terms:
  - 'project-policy.php'
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
  - 'tastenkürzel'
  - 'fragevorschläge'
  - building
  - 'project zip'
  - 'project export'
  - 'building.environment'
  - 'project-environment.php'
  - 'projekt zip'
  - 'service profiles'
  - suggestion_labels
  - 'building policy'
  - 'project-policy.php'
  - 'stage-web-v3'
  - 'fastest supported service'
  - 'ultrafast'
  - 'default service'
  - 'release facts'
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
    label: 'Project environment contract'
    url: 'https://stage.dev/resources/starchat-project-environment'
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
---

# Install Starchat

Starchat needs PHP 8.4 or later PHP 8, Composer, declared extensions and SQLite
FTS5. Serve only `public/` over HTTPS; keep credentials and runtime outside it and Git.

## Create the project

With core access, copy its `examples/installation` into an empty project.
The [public example](https://github.com/skyyware/starchat-demo) grants no access:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.12.0 --no-plugins --no-scripts
```

Commit both Composer files. Route non-files to `public/index.php`, calling
`Starchat\App::run()` with the project root.

## Set the purpose and knowledge

Set `id`, allowed HTTPS `hosts`, `website`, `scope`, `copy` and `brand` in
`installation.json`. Host and knowledge owner must match. Visitors cannot switch them.

`copy.<locale>.missing` sets 1–500 nonblank plain-text characters for no-information
answers with locale fallback. It does not change service errors.

Suggestions submit full questions through short single-line labels. Labels and
replies omit trailing full stops, also after restoration. Other punctuation remains.
See [answer API](https://stage.dev/resources/starchat-answer-api).

Building can offer four [opening app ideas](https://stage.dev/resources/starchat-app-ideas) per conversation.

`brand` sets fonts, logo, favicon and styles. The logo opens HTTPS
`brand.home_url` in the same tab, defaulting to `/`.

`brand.asset_origin` permits styles, fonts and images under trusted HTTPS
`/branding/`, never scripts or APIs. Recheck styles and font CORS. Otherwise use local assets.

`header_link` adds an HTTPS link beside the language selector.
Each area allows four controls. Actions below questions use regular text without icons.
`brand.reset_icon: true` adds a desktop plus to **New conversation**; mobile
keeps its accessible 44px icon button. The boolean defaults to false; other
actions remain icon-free.
**More actions** pages extra formats, three per page. Four questions use two columns when space allows.

Tab focuses suggestions; Enter, Space, clicks and taps activate. Number keys
and custom shortcuts do not. Remove `suggestion_shortcuts` on upgrade.

Put reviewed Markdown in `knowledge/<category>/` with your installation ID as
`entity`. Supply legal notices. Index from the project directory:

```sh
vendor/bin/starchat index
```

Validation failure preserves the index; indexing does not check facts.

## Connect the model

Stage Chat Codex uses `STARCHAT_CODEX_BINARY`, `STARCHAT_CODEX_HOME` and
`STARCHAT_CODEX_WORK`: approved executable, dedicated authenticated service home,
and empty private working directory. Account setup requires a human.

Set private writable `STARCHAT_RUNTIME`. `STARCHAT_MODEL` and
`STARCHAT_REASONING_EFFORT` select model and reasoning.
Defaults are Astra (`gpt-6-astra`) and `low`. Answers, source selection and answer
review use Default service. Projects, summaries and their reviews select
catalogue-advertised Ultrafast, else Fast, else Default. Without
`STARCHAT_MODEL_CATALOG`, assets request Fast without confirming access. Invalid
catalogues fail closed. Rejections never trigger a tier fallback; project-review
retry keeps its profile. `STARCHAT_SERVICE_TIER` has no effect; remove it at
authorized deployment. Model and reasoning overrides apply to both request
types. Custom connector factories remain installation-owned. No setting grants access. After an account or credential change, verify capabilities
again through the intended service identity and approved client. An old catalogue
is not evidence for a new account. Verify the selected mode before activation.

## Enable project ZIP downloads

Building defaults off. Install PHP's zip extension. Adapt `installation.json`
to your permitted languages:

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

Optional `building.policy` names an export version, such as `web-app-v1`. Trusted
`config/project-policy.php` returns a closure accepting `Starchat\Project` and
strict `true` on success. Missing closures fail validation. Inspect text, never execute files. Starters
and revisions are checked before review and packaging.
Increment changed policies; old files remain revision input after a click.
Optional `building.environment` selects a versioned trusted provider in
`config/project-environment.php`. Follow the [project environment contract](https://stage.dev/resources/starchat-project-environment)
for release facts, preparation and byte reservations. Bump the export policy
when enabling it.

Click **Create project ZIP** after an answer. Preparation uses the answer
indicator; answers alone never build it. `building.starter` supplies an optional
reviewed app. Custom work passes generation and review. **Download ZIP** calls no model.

Disclose model input and browser storage. The service never executes or deploys
generated code.

## Offer other conversation assets

PDF summaries and email drafts need no building. See [conversation assets](https://stage.dev/resources/starchat-assets)
for contact actions, Markdown downloads, configuration and limits.

## Connect a signed-in application

[Session context](https://stage.dev/resources/starchat-request-context) excludes building
and origin migration. Summaries and contacts need fresh checks before preparation
and display.

## Check the installation

Check `/health`, answers and sources on desktop and mobile. Keep rollback code
and index; preserve data and credentials. See [operations](https://stage.dev/resources/starchat-operations).
