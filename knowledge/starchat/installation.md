---
id: starchat-installation
entity: stage
title: 'Install Starchat'
source: 'https://stage.dev/resources/starchat-installation'
retrieved_at: '2026-10-10'
review_status: reviewed
source_version: 'skyyware/starchat v0.2.5'
public_path: /resources/starchat-installation
topic_terms:
  - 'starchat installation'
  - 'install starchat'
  - 'starchat setup'
  - 'keyboard shortcuts'
  - 'keyboard shortcut'
  - 'suggestion shortcuts'
  - 'tastenkürzel'
phrase_terms:
  - 'install starchat'
  - 'set up starchat'
keywords:
  - 'starchat installation'
  - 'install starchat'
  - 'starchat setup'
  - keyboard
  - shortcuts
  - 'tastenkürzel'
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
based_on: {  }
---

# Install Starchat

Create a separate project for your installation. Starchat 0.2.5 requires PHP
8.4 or a later PHP 8 release, Composer, and the extensions declared by its
packages. Its knowledge index uses SQLite FTS5. Serve only `public/` through HTTPS.

## Create the project

The Starchat core repository is private. The public example installation lives
at [starchat-demo](https://github.com/skyyware/starchat-demo). Its source can be
read publicly, but installing the private Composer dependency requires existing
authorized repository access. The public demo does not grant that access.

With access to Starchat 0.2.5, copy `examples/installation` from that release
into an empty project directory. Run these commands in that directory:

```sh
composer config repositories.starchat vcs https://github.com/skyyware/starchat
composer require skyyware/starchat:^0.2.5 --no-plugins --no-scripts
```

The repository setting is needed because this package is distributed through
its private GitHub repository. Configure Composer authentication outside the
repository; never commit credentials. Keep both `composer.json` and `composer.lock`.
The starter's `public/index.php` calls `Starchat\App::run()` with the project
root. Configure the web server to route non-file requests to that entry point.

## Set the purpose and knowledge

Edit `installation.json`. Set a unique `id`, allowed HTTPS `hosts`, `website`,
`scope`, interface `copy`, and `brand`. Keep the purpose narrow enough that a
visitor can understand what the chat covers. The host and knowledge owner
must agree; a visitor cannot select another installation.

Use broad starter questions: what the chat is about, what it can help with,
whether it fits the visitor's idea, and how to begin. Do not assume a technical
background or a chosen project. Later suggestions follow the conversation.

Set `brand.home_url` to your HTTPS homepage if the logo should lead there.
It defaults to `/`. Supply your own fonts, logo, favicon, and stylesheet through
the supported branding settings; visitor content cannot change these assets.

Optional `header_link` adds a labelled HTTPS link with an external-link icon
beside the language selector. Suggestions fit their text and wrap to another
line when needed. An installation can supply a different layout in its stylesheet.

Set `suggestion_shortcuts` to `true` to number up to four choices from 1 to 4 on
desktop screens at least 800 CSS pixels wide with hover and a fine pointer.
Use Command on Mac or Control elsewhere with the number. The hint and accessible
shortcut names follow the platform and the number of available choices.

Browsers may reserve these combinations for switching tabs. From the empty
question field, press Tab, then a number to choose without a modifier. Plain
numbers select only outside editable controls. An existing draft, pending
request, repeated key, input composition, or wrong modifier prevents submission.
The setting defaults to `false`; mobile keeps touch buttons.

Replace the starter's example article with reviewed Markdown under
`knowledge/<category>/`. Set each document's `entity` to your installation ID.
Supply your own legal notices and assets. Keep credentials and runtime files
outside Git and the public directory.

From the project directory, build the index:

```sh
vendor/bin/starchat index
```

Expect the installation ID and indexed document count. A failed validation
keeps the previous index. The command checks structure; it does not fact-check
the articles or mark them reviewed.

## Connect the model

The default provider adapter is Stage Chat Codex. Prepare an approved Codex
executable, a dedicated authenticated service home, and an empty private working
directory. A human completes account setup. Configure `STARCHAT_CODEX_BINARY`,
`STARCHAT_CODEX_HOME`, and `STARCHAT_CODEX_WORK` for the service.

Set `STARCHAT_RUNTIME` to the installation's private writable runtime.
`STARCHAT_MODEL` and `STARCHAT_REASONING_EFFORT` select the supported model
and reasoning level. `STARCHAT_SERVICE_TIER` and `STARCHAT_MODEL_CATALOG`
control the verified tier request. These settings cannot buy or grant access.
Starchat 0.2.5 defaults to Astra (`gpt-6-astra`), `low`, and `fast`. Existing
environment overrides still apply; set `STARCHAT_SERVICE_TIER=fast` explicitly
when replacing an earlier `auto` configuration. Explicit `auto` can still select
catalogue-verified Ultrafast. No provider rejection triggers a tier fallback.
See the operating guide for deadlines, permissions, rate limits, and verification.

## Check the installation

Open `/health` through the configured HTTPS host. Check the installation ID,
document count, and `aggregate_rate_limit` value. Check a public guide, a real
synthetic question, an unrelated question, and the interface on mobile and desktop.
Read the answer and its sources; HTTP 200 alone does not establish correctness.

Keep the previous code release and matching index for rollback. Do not copy
development credentials or data onto a public host. Installing Starchat does
not provision hosting, accounts, a spending cap, or your organization's policies.
