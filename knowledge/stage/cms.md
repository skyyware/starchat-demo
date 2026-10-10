---
id: stage-cms
entity: stage
title: 'Build a site with Stage CMS'
source: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage-cms v0.5.3"
public_path: /resources/cms
topic_terms:
  - cms
  - theme
  - 'page type'
  - publication
  - preview
  - translation
  - fields
phrase_terms: []
keywords:
  - cms
  - theme
  - 'page type'
  - publication
  - preview
  - translation
  - fields
links:
  -
    label: 'CMS installation and editing'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md'
  -
    label: 'Page types, bindings, languages, and themes'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/themes.md'
  -
    label: 'Publication rules'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/publication.md'
  -
    label: 'Markdown implementation'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Presentation/Markdown.php'
based_on: []
---

# Build a site with Stage CMS

Applies to Stage CMS 0.5.3. Sources checked on 9 October 2026.

Stage CMS manages one site, called a publication, with one owner. You can write Markdown,
fill named fields, preview drafts, publish pages, and restore earlier revisions.
It also supports images, translations, and agent access with limited permissions.
Structured data lives in SQLite. Image files live in a private directory.

## Create a standalone site

Install PHP 8.4 or 8.5, Composer 2, and the extensions listed in the package's
`composer.json`. Then run:

```sh
composer create-project skyyware/stage-cms my-site "^0.5.3" --no-plugins
cd my-site
php bin/cms setup --name="Your name" --email="you@example.com"
composer serve
```

Setup asks for a password without displaying it. There are no default
credentials. Open `http://127.0.0.1:8088/admin` and sign in. The publication
is at `http://127.0.0.1:8088`.

Create a page, save a draft, and preview it. Publish when ready. Later edits
remain private until published. History restores an earlier revision as a
new private draft. Publish that restored draft to replace the public revision.

## Add the CMS to an existing application

Run `composer require skyyware/stage-cms:^0.5.3` in the application.
Keep the lockfile. Register the application's page types in PHP and implement
`StageCms\Presentation\Theme` to render its design. The interface has
`index(int $page): Response` and `page(Page $page, bool $preview = false): Response`.

A page type defines named text fields and whether the page body accepts Markdown.
`PageType(markdown: false)` disables the body. Named `Field` values are plain
text. `Field(multiline: true)` changes the editor to a textarea; it does not
enable Markdown for that field. The theme chooses how to render named values.
`Field(required: true)` requires nonblank text before publication, while
allowing incomplete drafts. Application types and templates cannot be installed
through page content.

Register the themes your application can render with `ThemeOption` and `Themes`.
An editor can then choose an installed theme in **Settings**. Selecting a theme
changes the public site and previews immediately, without a draft or publish step.

## Keep drafts out of public pages

For public output, use `publication()`, `publishedById()`, `publishedBinding()`,
or `publishedPage()`. Render the supplied draft for an authenticated preview.
An editorial list filtered by `status=published` can still contain private edits.

Bindings connect a permanent page ID to a fixed route, so changing the content
key does not break the address. Each translation has its own publication and
history. The application checks its `PublicationRule` inside the publication
transaction. If the rule rejects publication, the CMS creates no revision and
leaves the public version unchanged.

Escape plain text in the theme and use the CMS Markdown renderer for rich text.
It strips raw HTML and blocks unsafe links. It supports Markdown tables.

## Sources

- [CMS installation and editing](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/README.md)
- [Page types, bindings, languages, and themes](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/themes.md)
- [Publication rules](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/publication.md)
- [Markdown implementation](https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/src/Presentation/Markdown.php)
