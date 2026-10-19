---
id: starchat-agent-handoff
entity: stage
title: 'Continue a downloaded project with an agent'
source: 'https://stage.dev/resources/starchat-agent-handoff'
retrieved_at: '2026-10-14'
review_status: reviewed
source_version: 'skyyware/starchat v0.10.2'
public_path: /resources/starchat-agent-handoff
topic_terms:
  - 'agent handoff'
  - 'coding agent'
  - AGENTS.md
  - CLAUDE.md
  - 'Claude Code'
  - 'Grok Build'
  - Codex
  - Superpowers
  - pstack
  - 'plugin installation'
  - 'downloaded project'
  - 'projekt weiterbauen'
phrase_terms:
  - 'continue my project'
  - 'open the project in codex'
  - 'project zip with claude'
  - 'optional plugins'
keywords:
  - 'agent handoff'
  - 'coding agent'
  - AGENTS.md
  - CLAUDE.md
  - 'Claude Code'
  - 'Grok Build'
  - Codex
  - Superpowers
  - pstack
  - 'plugin installation'
  - 'downloaded project'
  - 'projekt weiterbauen'
  - 'local changes'
links:
  -
    label: 'Continue a downloaded project with an agent'
    url: 'https://stage.dev/resources/starchat-agent-handoff'
  -
    label: 'Build and download a project'
    url: 'https://stage.dev/resources/starchat-building'
  -
    label: Superpowers
    url: 'https://github.com/obra/superpowers'
  -
    label: 'pstack upstream'
    url: 'https://github.com/cursor/plugins/tree/main/pstack'
based_on: {  }
follow_ups: {  }
---

# Continue a downloaded project with an agent

Extract your project ZIP and open its folder in Codex, Claude Code, Grok Build,
or another coding agent with project access. Start in the project root. The
archive includes instructions for people and agents; no plugin is required.

## Read the project before changing it

`README.md` describes the application, prerequisites, setup, and checks.
`PROJECT.md` records confirmed requirements, the implemented first version,
provisional choices, and open questions. These files separate what you asked
for from assumptions that still need a decision.

`AGENTS.md` directs the next agent to those files and the affected source.
It keeps setup commands in README and decisions in PROJECT instead of copying
them into another document. `CLAUDE.md` contains `@AGENTS.md` for Claude Code's
instruction loading. Existing project-specific instructions remain intact
when Starchat adds missing handoff files.

The README provides a continuation prompt. You can also ask:

> Read AGENTS.md, README.md, and PROJECT.md. Inspect the source and run the
> documented checks. Help me implement the next useful change, preserve my
> confirmed requirements, and identify any decision that blocks the work.

File access and automatic instruction loading depend on the coding product,
version, and settings. In a chat without local file access, attach the relevant
files and ask the agent to read them. Keep secrets out of those attachments.

## Verify the first version locally

Starchat reviews generated files but does not execute them. Ask your agent to
run the README checks and exercise the first useful behavior. Keep the commands
and results distinct from work that remains untested. Fix a broken instruction
alongside the code it describes.

A later download from the website does not contain local changes made by you
or your agent. Continue in the extracted project. Compare a later download in
a separate directory before merging files.

## Choose tools for the actual task

`docs/agent-tools.md` names optional tools after download:

- [Superpowers](https://github.com/obra/superpowers) supplies workflows for
  clarifying requirements, planning, debugging, and verification.
- [pstack](https://github.com/cursor/plugins/tree/main/pstack) supplies principles
  and skills for implementation and clear documentation. The upstream package
  targets Cursor; other products may offer an adaptation.

Ask the next agent to inspect the plugins its current host supports. If it can
search and suggest a fitting package in the agent chat, use that supported flow
to make an installation choice. Otherwise, the agent can explain the benefit
and link to the upstream instructions for your product. An absent plugin does
not block ordinary project work.

The ZIP installs no plugins. Review the publisher, compatibility, required
access, and hooks before choosing one. A plugin does not authorize additional
workers, publication, deployment, spending, or changes outside your project.
