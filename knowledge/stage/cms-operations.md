---
id: stage-cms-operations
entity: stage
title: 'Stage CMS storage, recovery, and limits'
source: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/operations.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage-cms v0.5.3"
public_path: /resources/cms-operations
topic_terms:
  - backup
  - restore
  - sqlite
  - schema
  - storage
  - 'image limits'
  - deployment
phrase_terms: []
keywords:
  - backup
  - restore
  - sqlite
  - schema
  - storage
  - 'image limits'
  - deployment
links:
  -
    label: 'Storage, deployment, and recovery'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/operations.md'
  -
    label: 'Supported features and size limits'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md'
  -
    label: 'Environment configuration'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Infrastructure/Config.php'
based_on: []
---

# Stage CMS storage, recovery, and limits

Applies to Stage CMS 0.5.3. Sources checked on 9 October 2026.

`CMS_DATA_DIR` is an absolute private directory outside the public web root.
`CMS_URL` is the public HTTP or HTTPS origin without a path. An HTTPS origin
enables Secure session cookies. HTTP and CLI processes need consistent settings.
The application does not load `.env` files automatically.

SQLite and its write-ahead log, or WAL, need a local filesystem with working locks.
The documented setup does not use a network share or multiple servers writing
separate database copies. Code and runtime data have separate directories.
Public requests must expose only `public/`.

The CMS supports one owner and one publication. It has no team roles,
scheduled publication, comments, real-time collaboration, plugin marketplace,
or visual layout builder. Applications register their types and themes in PHP.

| Content limit | Value |
| --- | --- |
| Page, history, or media list | At most 50 items per page |
| Image bytes | 5 MiB |
| Image pixels | 16 megapixels |
| Markdown body | 200,000 bytes |
| Combined named-fields JSON | 200,000 bytes |
| Portable archive | 128 MiB uncompressed |

Image uploads support JPEG, PNG, and WebP. External images are blocked by the
default content security policy. Fields also have their own configured
character limits.

## Back up and restore content

A portable export contains content, drafts, archives, revisions, settings,
and images. It excludes owner credentials, sessions, login attempts, and
agent tokens. Treat the archive as private even though it excludes credentials.
Restore requires a fresh data directory with no pages or images.

A complete instance backup needs stopped web and CLI writers and a consistent
copy of the private data directory, including SQLite state and media.
That backup includes credentials. Revision history is not a replacement
for a tested backup.

## Check compatibility before an upgrade

Version 0.5.3 uses database schema 3 and export format `stage-cms/3`.
Version 0.5 migrates older schemas on startup. Back up before the first request
after an upgrade. Version 0.4 cannot open schema 3. A downgrade requires stopped
writers, old code, and the corresponding old data, with any later edits reconciled.

The repository benchmark uses test data in isolation. It does not measure
network transfer, concurrent traffic, or production capacity. This release
does not claim support for writes across multiple servers or an independent
security audit.

## Sources

- [Storage, deployment, and recovery](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/operations.md)
- [Supported features and size limits](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md)
- [Environment configuration](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Infrastructure/Config.php)
