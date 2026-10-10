---
id: "stage-cms-publication"
entity: "stage"
title: "CMS publication and revisions"
source: "https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/publication.md"
retrieved_at: "2026-10-09"
review_status: reviewed
source_version: "skyyware/stage-cms v0.5.3"
public_path: "/resources/cms-publication"
topic_terms: ["publish", "draft", "revision", "preview"]
keywords: ["publish", "draft", "revision", "preview"]
links:
  -
    label: 'CMS publication and revisions — Stage guide'
    url: 'https://stage.dev/resources/cms-publication'
  -
    label: 'CMS publication and revisions source'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/publication.md'
based_on: []
---

# CMS publication and revisions

Stage CMS 0.5.3 stores edits as private drafts until an authorized publication.
Publishing checks required fields and the application's `PublicationRule`
before changing the public revision.

## Validate the proposed revision

Implement `StageCms\Content\PublicationRule::validate()` and pass the rule to
the application's `Cms` constructor. The `PublicationCandidate` contains the
page ID, new revision number, and complete immutable draft. Validate that
candidate, not a previous publication or a stale editorial read.

Permission and expected-version checks run first. Throwing `StageCms\Failure`
rolls the publication back. A successful rule records the revision and moves
the live pointer in the same transaction. Do not call external services while
holding that transaction's writer lock.

Use required fields for presence checks. A cross-field requirement, such as
a source URL for a particular page type, can use a publication rule. A URL's
presence does not establish its authority or freshness.

## Preserve drafts and history

Saving after publication leaves the previous public revision visible.
Restoring history creates a new private draft; publish that draft to replace
the public revision. Each translation has its own publication and history.

For an API update, send the version you read. On a 409 conflict, retain your
proposed edit, read the newer revision, compare, and reconcile. Blindly
replacing the expected version can overwrite another editor's work.

## Use one application configuration

All scripts that write application content must use the same types and rules
as the website. The generic package CLI provides setup, identity, export,
restore, and diagnosis; it does not load application-specific publication rules.

Public reads do not rerun publication rules. Check time-sensitive validity
when reading content too. A portable restore reinstates historical publications;
review their validity before reopening the restored site.
