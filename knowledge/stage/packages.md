---
id: stage-packages
entity: stage
title: 'Stage packages and versions'
source: 'https://stage.dev/packages.json'
retrieved_at: '2026-10-11'
review_status: reviewed
public_path: /resources/packages
topic_terms:
  - versions
  - version
  - requirements
  - packagist
  - dependencies
  - license
  - php
  - pakete
phrase_terms: {  }
keywords:
  - versions
  - version
  - requirements
  - packagist
  - dependencies
  - license
  - php
  - pakete
links:
  -
    label: 'Stage packages and versions'
    url: 'https://stage.dev/resources/packages'
  -
    label: 'Stage requirements and license'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/composer.json'
  -
    label: 'Stage CMS requirements and license'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/composer.json'
  -
    label: 'Stage CMS overview and limits'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md'
  -
    label: 'Stage Chat requirements'
    url: 'https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/composer.json'
  -
    label: 'Codex connector requirements'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/composer.json'
  -
    label: 'Codex connector prerequisites'
    url: 'https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/README.md'
  -
    label: 'Public example installation'
    url: 'https://github.com/skyyware/starchat-demo'
based_on: {  }
follow_ups: {  }
---

# Stage packages and versions

Starchat 0.3.0 was checked on 11 October 2026 against its released source and
Composer metadata. The other package checks remain dated 10 October 2026.
These are the versions covered by the guides. Your application's
`composer.lock` records the versions it installs.

| Package | Verified release | Purpose |
| --- | --- | --- |
| `skyyware/stage` | 0.1.5 | HTTP routing, requests, responses, file transfers, and caller permissions |
| `skyyware/stage-cms` | 0.5.3 | Page editing, drafts, publication, media, and revision history |
| `skyyware/stage-chat` | 0.1.1 | A PHP interface for stateless chat providers |
| `skyyware/stage-chat-codex` | 0.2.3 | A Codex CLI implementation of the chat interface |
| `skyyware/starchat` | 0.3.0 | A chat application with owned knowledge, answer review, and optional project ZIPs |

Stage, Stage CMS, Stage Chat, and Stage Chat Codex are public and MIT licensed.
The Starchat core repository is private; its reviewed 0.3.0 release retains
the MIT license. The public example installation is
[starchat-demo](https://github.com/skyyware/starchat-demo), whose private core
dependency requires authorized access. Their Composer PHP requirement
is `^8.4`, which permits PHP 8.4 and later PHP 8 releases, not PHP 9.
The version constraint allows installation. It does not prove that the package
was tested on every permitted PHP version.
The CMS documentation names PHP 8.4 and 8.5. The Codex connector documents
macOS and Linux.

Stage and Stage Chat require the JSON extension and no other production
Composer packages. Stage CMS also requires Fileinfo, GD, Mbstring, PDO,
PDO SQLite, and Zip. Its image support needs JPEG, PNG, and WebP in GD.
It depends on Stage and League CommonMark. The Codex connector depends on
Stage Chat and requires a separately installed, supported Codex executable
for real completions.

Starchat combines these packages with Symfony YAML and League CommonMark.
It needs Mbstring, PDO SQLite with FTS5, and the extensions required by its
dependencies. Configure its private GitHub VCS repository and authorized access before Composer
installation; it is not distributed through Packagist. See
[Install Starchat](https://stage.dev/resources/starchat-installation).

The packages have separate versions. Installing Stage does not install a CMS,
chat provider, credentials, or development tools. Composer installs the chosen
package's runtime dependencies. Commit the application's lockfile and review
the package changelog before updates. These are pre-1.0 packages with interfaces
that may change between minor versions.

Each Starchat installation owns its prepared Markdown knowledge. Maintain the
internal docs and affected articles when code, requirements, or useful facts
change. Rebuild the derived index after review. External source-folder
connectors were removed in Starchat 0.2.0.

The CMS's D-DIN fonts retain their separate SIL Open Font License.
The MIT license does not replace third-party asset licenses.

## Sources

- [Stage requirements and license](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/composer.json)
- [Stage CMS requirements and license](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/composer.json)
- [Stage CMS overview and limits](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md)
- [Stage Chat requirements](https://github.com/skyyware/stage-chat/blob/7fef0ddb693625f41760bf24074463d7c9d9bf3f/composer.json)
- [Codex connector requirements](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/composer.json)
- [Codex connector prerequisites](https://github.com/skyyware/stage-chat-codex/blob/488b26c68a4358ea08c62290dd8c159b395783b6/README.md)
