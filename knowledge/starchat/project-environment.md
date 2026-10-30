---
id: starchat-project-environment
entity: stage
title: 'Project environments and dependency evidence'
source: 'https://stage.dev/resources/starchat-project-environment'
retrieved_at: '2026-10-31'
review_status: reviewed
source_version: 'skyyware/starchat v0.12.0'
public_path: /resources/starchat-project-environment
topic_terms:
  - 'building.environment'
  - 'project-environment.php'
  - 'project environment'
  - 'release facts'
  - 'technology versions'
  - 'verified technology versions'
  - 'composer.lock'
  - 'docs/technology.json'
  - 'reservedBytes'
  - 'generation budget'
  - 'dependency evidence'
  - 'local stylesheets'
  - 'asset routes'
  - 'scripts'
phrase_terms:
  - 'verify technology versions'
  - 'unverified packages'
  - 'unverified dependencies'
  - 'serialized growth'
  - 'project environment'
  - 'local stylesheets'
  - 'asset routes'
keywords:
  - 'building.environment'
  - 'project-environment.php'
  - 'ProjectEnvironment'
  - 'ProjectRequest'
  - 'reservedBytes'
  - 'release facts'
  - 'technology versions'
  - 'composer.lock'
  - 'docs/technology.json'
  - 'official release metadata'
  - 'generation budget'
  - 'dependency evidence'
  - 'unverified packages'
  - 'npm build'
  - 'local stylesheets'
  - 'asset routes'
  - 'scripts'
links:
  - label: 'Project environments and dependency evidence'
    url: 'https://stage.dev/resources/starchat-project-environment'
  - label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  - label: 'Install Starchat'
    url: 'https://stage.dev/resources/starchat-installation'
  - label: 'Stage example project contract'
    url: 'https://github.com/skyyware/starchat-demo/blob/382159d0dd0e53c3360cfc868c8192435beb811a/docs/building.md'
based_on: {  }
---

# Project environments and dependency evidence

An optional project environment supplies verified facts and prepares dependency
files for a requested ZIP. Starchat itself contains no registry or network resolver.
The installation owns the provider, its permitted sources and freshness rules.

## Configure the provider

Set `building.environment` to a versioned identifier. Trusted
`config/project-environment.php` returns a closure accepting
`Starchat\ProjectRequest`, or `null` for the configured starter. It returns
`Starchat\ProjectEnvironment` with a nonempty data object of at most 8 KiB,
a preparation closure and optional `reservedBytes`.

The provider runs only for explicit creation or starter retrieval.
Ordinary chat and page rendering never call it. An invalid or unavailable
environment stops creation before generation. Its facts reach generation and
independent review. Bump the export policy when enabling this contract.

Preparation receives the assembled ready `Starchat\Project` before policy and
review, then returns a Project with the same name and ready status. The engine
adds its agent handoff files. Normal path, file, size, installation-policy and
independent-review checks still apply. Unready results skip preparation and
still need semantic review. Prepared starters retain maintainer-owned validation;
changed prepared content invalidates their archive cache.

Never execute generated files or install dependencies in the provider or
preparation closure. Use allowlisted official metadata with bounded requests.
Conversation URLs are not metadata sources. Existing ZIPs retain the versions
recorded when they were created; there is no automatic upgrade.

## Reserve space for prepared files

`reservedBytes` declares the maximum serialized growth from preparation. Its
default is 0 and its maximum is 16,384 bytes. Exceeding the reservation rejects
the result. The Stage provider reserves 4,096 bytes for dependency files.

The generation budget is 32,768 bytes minus the environment reservation and the
engine's serialized handoff reservation. Retained files, README.md, PROJECT.md
and tests count toward that budget. Keep documentation compact; the allowance
is a ceiling, not an output target. Final validation still limits the complete
prepared project, including dependency and handoff files, to 32 KiB of JSON.

## What the Stage example verifies

The public Stage example checks official Packagist and PHP data on creation day.
Its cache uses the Europe/Berlin date; older data cannot establish today's
releases. Requests accept only the configured official endpoints, with a
three-second timeout, no redirects, HTTP 200 and a one-MiB response limit.

It chooses compatible stable Stage 0.2 and a supported PHP 8 release from 8.4
through 8.9. It preserves supported explicit choices. A new Stage API family
needs compatibility verification before use. Unverified dependencies need
clarification; the provider is not a general Composer resolver.

Preparation pins the exact Stage release and adds `composer.lock` and
`docs/technology.json`. The evidence records the check date, sources and selected
versions. Lock preparation verifies the official repository, immutable source
reference and supported requirements; the model does not invent lock hashes.
The generated application must use Stage routes for its feature.

The default frontend uses native HTML, CSS and JavaScript without an npm build.
Forms work without JavaScript. Local stylesheets and scripts need explicit fixed
Stage routes through the canonical PHP router, with HTTP 200 and the correct
content type. Merely putting a stylesheet in `public/` is insufficient.
The service never executes or deploys generated code. Maintainers and builders
run the documented checks in their own appropriate environment.

See the [Stage example contract](https://github.com/skyyware/starchat-demo/blob/382159d0dd0e53c3360cfc868c8192435beb811a/docs/building.md)
and the [project-building guide](https://stage.dev/resources/starchat-building)
for the visitor flow, review limits and recovery behavior.
