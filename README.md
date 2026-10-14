# Stage chat

The public source of [chat.stage.dev](https://chat.stage.dev), a working
Starchat installation that helps people build with [Stage](https://stage.dev).
Its reviewed guides link to the regular Stage website and public package
sources. This repository contains the installation, not the private Starchat
engine. Installing that Composer dependency requires authorized repository access.

## Run your own installation

```bash
git clone https://github.com/skyyware/starchat-demo.git my-chat
cd my-chat
composer install
composer check
vendor/bin/starchat index
```

Supply your existing Composer/GitHub authentication outside the repository.
Change `installation.json` to your own identity, allowed hosts and purpose.
Replace the knowledge and legal information with material reviewed for your
service. Configure your approved model connection and serve only `public/`
through HTTPS. See [installation](docs/installation.md).

## One website and chat design

The regular website at stage.dev owns `/branding/stage.css`, its fonts and
favicon. Both website and chat load that same published stylesheet. This chat
sets `brand.asset_origin` to `https://stage.dev`; no copied theme or background
synchronization job is needed. Website theme changes reach both on page reload.
See the [design contract](docs/design.md) before changing either surface.

## Follow the application

- [Configuration](installation.json): identity, trusted scope, branding and copy
- [Entrypoint](public/index.php): the application bootstrap
- [Knowledge](knowledge/): reviewed snapshots of public documentation
- [Source manifest](knowledge/sources.json): original public pages and hashes
- [Checks](bin/check): source integrity, retrieval, routes and isolation
- [Knowledge maintenance](docs/knowledge.md): review and update the snapshot
- [Operations](docs/operations.md): private runtime and deliberate delivery

The website owns editorial source content. The chat owns its reviewed snapshot
and disposable search index. It does not crawl the website at request time,
read CMS drafts, execute examples or perform actions for the visitor.

Repository automation is disabled. Keep credentials, production configuration,
private source history, dependencies and runtime outside Git. The MIT license
covers this demo's source; access to the private engine is a separate requirement.
