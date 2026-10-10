---
id: "stage-codex-operations"
entity: "stage"
title: "Operate the Codex connector"
source: "https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/docs/operations.md"
retrieved_at: "2026-10-09"
review_status: reviewed
source_version: "skyyware/stage-chat-codex v0.2.3"
public_path: "/resources/codex-operations"
topic_terms: ["codex", "connector", "configuration", "timeouts"]
keywords: ["codex", "connector", "configuration", "timeouts"]
links: [{"label": "Operate the Codex connector source", "url": "https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/docs/operations.md"}]
based_on: []
---

# Operate the Codex connector

This guide covers Stage Chat Codex 0.2.3. The connector starts the supported
Codex CLI for a complete answer. Your application owns host setup, access,
concurrency limits, and accurate privacy notices.

## Prepare a service identity

Run PHP and Codex under the application's dedicated, unprivileged service
identity. Keep its Codex home and empty working directory private, outside
the document root and uploads. Both directories must have mode 0700.
Never give a web process a developer's personal home or copy personal credentials.

Configure a direct, administrator-owned, version-pinned executable through
`Options::$binary`. Verify its actual path. A global command can be a wrapper;
the displayed version alone does not establish the executable that runs.
A human completes the approved service account's authentication.

Use a readable, absolute schema path, at most 64 KiB, with a root JSON object
type. Deploy the schema with trusted code. Never construct it from visitor
input. PHP needs `proc_open` and access to the configured paths.

## Bound requests

The default connector timeout is 25 seconds. The PHP worker and proxy deadlines
must leave time for the connector to finish and render an error. Each request
occupies a worker and starts a CLI process. Apply rate and concurrency limits
before invoking the connector.

Published probes cover three concurrent requests under stated test conditions.
They do not establish capacity above three workers or an expired-credential
refresh race. Verify the intended host and account before serving visitors.

## Verify the selected model

Model, reasoning effort, and service tier are separate settings. Ultrafast
requires an explicit, trusted model catalogue that advertises that exact
combination. Its path must be absolute, regular, readable, at most 4 MiB,
and not writable by group or other users.

The connector validates the catalogue's shape and advertised support. It cannot
prove the file's issuer or the account's entitlement. A login status or catalogue
snapshot is not a successful completion. Use the package's synthetic wire probe
and an authorized test under the actual service identity.

A rejected provider call does not switch models or tiers. A successful completion
also does not independently confirm the tier the provider served. Keep latency
claims limited to measured requests and their conditions.

## Describe retention accurately

The connector disables tools and browser access and writes no prompt or answer
files. The tested request profile uses `store: false`, ephemeral operation, and
disabled history and telemetry. Codex still creates authentication and metadata
files. These observations do not prove zero retention by the provider or host.

Disable request-body logging and debug exception output. Keep secrets out of
prompts, URLs, logs, and examples. Review the package's operations guide after
a CLI, model, profile, or host change. The application owns its deployment
verification and privacy notice.
