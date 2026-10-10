---
id: "stage-cms-themes"
entity: "stage"
title: "CMS page types and themes"
source: "https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/themes.md"
retrieved_at: "2026-10-09"
review_status: reviewed
source_version: "skyyware/stage-cms v0.5.3"
public_path: "/resources/cms-themes"
topic_terms: ["themes", "types", "fields", "templates"]
keywords: ["themes", "types", "fields", "templates"]
links:
  -
    label: 'CMS page types and themes — Stage guide'
    url: 'https://stage.dev/resources/cms-themes'
  -
    label: 'CMS page types and themes source'
    url: 'https://github.com/skyyware/stage-cms/blob/7b7d9845e33059bbb490ca3b54c230a008062b6d/docs/themes.md'
based_on: []
---

# CMS page types and themes

In Stage CMS 0.5.3, a page type defines the content an editor enters.
A theme is PHP rendering code supplied by the application. Changing content
does not install a template or execute PHP.

## Define a page type

Register `StageCms\Content\PageType` objects in `PageTypes` when constructing
`StageCms\Cms`. Each type has a stable ID and may define named `Field` objects.
A field has a key, label, group, character limit, and optional required or
multiline setting.

`PageType(markdown: false)` disables the page's Markdown body. Named fields
remain plain text. `Field(multiline: true)` gives the editor a textarea;
it does not make that field Markdown. `required: true` permits incomplete
drafts but requires nonblank text before publication.

For an unbound page, choose **Page type**, then **Apply type** in the editor.
Applying a type changes the form before saving. Move or clear incompatible
values before saving. A route binding fixes its page's type and language.
Keep definitions compatible with saved revisions you may need to restore.

## Supply and select a theme

Implement `StageCms\Presentation\Theme`. Its methods are
`index(int $page): Response` and
`page(Page $page, bool $preview = false): Response`.
Register each working renderer with `ThemeOption` and `Themes`, then pass the
registry to `StageCms\Http\Kernel`.

An editor selects an installed option in **Settings → Theme**. That setting
changes the public site and previews immediately. It has no separate draft
or publication step. Register only renderers that exist. If a stored theme
is unavailable, reinstall it or select an available option.

## Render the correct revision

Use `publication()`, `publishedById()`, `publishedBinding()`, or
`publishedPage()` for public reads. For an authenticated preview, render the
supplied draft. An editorial list filtered to published status can still
contain private draft edits.

Escape plain fields. Use `StageCms\Presentation\Markdown` for rich text.
The renderer strips raw HTML and unsafe links and supports Markdown tables.
Keep page storage and uploads outside the public document root and releases.

Each translation has its own publication and history. Bindings join related
translations and keep fixed routes stable when an editor changes a slug.
The application supplies these bindings during trusted setup.
