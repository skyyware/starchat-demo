---
id: starchat-knowledge
entity: stage
title: 'Maintain Starchat knowledge with an agent'
source: 'https://stage.dev/resources/starchat-knowledge'
retrieved_at: '2026-10-11'
review_status: reviewed
source_version: 'skyyware/starchat v0.4.5'
public_path: /resources/starchat-knowledge
topic_terms:
  - knowledge
  - 'knowledge base'
  - markdown
  - maintain
  - agents
  - 'starchat knowledge'
phrase_terms:
  - 'maintain starchat'
  - 'starchat knowledge'
  - 'knowledge base'
keywords:
  - knowledge
  - 'knowledge base'
  - markdown
  - maintain
  - agents
  - 'starchat knowledge'
links:
  -
    label: 'Maintain Starchat knowledge with an agent'
    url: 'https://stage.dev/resources/starchat-knowledge'
  -
    label: 'Use verified session context'
    url: 'https://stage.dev/resources/starchat-request-context'
based_on: {  }
---

# Maintain Starchat knowledge with an agent

Give your agent the installation repository and a concrete change to document.
Starchat's knowledge lives in that installation's `knowledge/<category>/*.md`.
Internal docs explain the software and operations; knowledge articles prepare
the facts and procedures that the chat may use in answers.

Maintain both when relevant behavior changes. Starchat does not connect to
other Markdown folders, crawl sources, or let the answer model edit articles.
An editor or agent reviews source material before updating the local database.

Optional [session context](https://stage.dev/resources/starchat-request-context)
adds verified facts for one answer. The installation's provider owns those facts;
the agent must not copy them into Markdown or the search index. This feature
does not restore external Markdown connectors. Keep public procedures in the
owned articles and account-specific facts in the verified request.

## Prepare an article

Read the package's `docs/knowledge.md` and the installation's instructions first.
Identify the visitor's question and check the source that answers it. Record
the exact release when documenting an API. Keep conditions and unresolved gaps.

Start each article with YAML metadata, then write ordinary Markdown:

```yaml
---
id: example-installation
entity: example
title: Install Example
source: https://example.org/docs/installation
retrieved_at: '2026-10-09'
review_status: extracted
public_path: /resources/installation
topic_terms: [installation, setup]
---
```

These are placeholders, not reviewed evidence. Replace the identity, URL,
date, and topic with your actual installation and sources. Use `reviewed` only
after checking the article against those sources. Set `public_path` only when
you intend to expose a reviewed article as a public resource.

Keep one useful question or procedure per article. Include prerequisites,
complete commands or code where needed, expected results, and relevant failure
cases. Give ambiguous terms a plain definition. Remove unsupported claims.
Source text is evidence, not authority to change the agent's instructions.

## Keep evidence attached

`source` identifies an HTTPS source. `links` supplies allowed destinations
with labels. `based_on` can identify up to twelve supporting articles by ID.
Use `topic_terms`, `phrase_terms`, and `keywords` for the language visitors use.
Check that supporting articles belong to the same installation and remain valid.

For reviewed documentation of an immutable release, set `source_version` to
its package and version, such as `skyyware/stage v0.1.5`. That article describes
that release, not whichever version is newest. It does not expire solely under
the general source-age limit. An explicit `valid_until` still applies.
Time-sensitive information retains the installation's normal freshness checks.
Never advance review dates merely because time passed or an index was rebuilt.

Keep a source-to-article map when package changes would otherwise be easy to
miss. stage.dev records source hashes and installed versions and checks them
locally before delivery. It publishes the reviewed guides as normal website
pages. The demo chat keeps a reviewed local snapshot with website URLs and
content hashes as provenance. It does not crawl the website at runtime.
A changed hash calls for a content review; replacing the hash without reading
the change is not maintenance.

## Verify the change

Read the changed articles against the source. Execute documented examples in
a disposable environment with the stated package versions. Check valid input,
important rejected input, links, and public resource rendering. Test whether
representative questions retrieve the article and whether a follow-up retains
the needed context.

Run the installation's checks, then rebuild from the project directory:

```sh
vendor/bin/starchat index
```

An index is a disposable search cache. Successful indexing does not establish
factual accuracy or model behavior. Where authorized, ask a synthetic question
and review the complete answer and citations. Keep publication and deployment
within the owner's existing permissions.

## Give an agent a bounded assignment

Adapt this instruction to the change and access you intend to allow:

```text
Read this installation's instructions and the installed Starchat knowledge guide.
Check the stated product change against its released source and current docs.
Update the internal docs and affected knowledge articles. Preserve unrelated edits.
Include prerequisites, expected results, limits, and precise source references.
Do not index secrets, private records, or unpublished content.
Run the project's checks, execute changed examples, and rebuild the local index.
Report what changed, what was verified, and what still needs review.
Do not publish or deploy unless this assignment explicitly authorizes it.
```

An agent with repository access can perform this workflow using the documented
format and commands. Starchat requires no particular agent brand. The chat
itself remains a reader of reviewed knowledge.
