# Build and take your project with you

The Stage chat helps visitors define a project and download a first implementation
as a ZIP. The first introductory answer offers a prepared minimal Stage
application, even before a visitor names a specific feature. It includes one JSON
endpoint, local run instructions and checks. The reviewed source lives in
`starters/minimal.json`, selected by `building.starter`.

The installer packages the starter in advance. After an answer, the visitor
clicks **Create project ZIP** below the questions. The click appears as a
request in the conversation, followed by the same three animated dots and short
status line used for answers. Preparation says **Creating project**.
A reviewed package follows when ready.
Loading, restored history and answers alone never start a build.
A starter needs no project generation; custom behavior uses the current
conversation and previous files. The final download starts no further model
request. The composer returns when preparation finishes.
The ready card uses a code-folder icon and a description of the current function
in at most four words. It enters with a short slide and fade, disabled by
reduced-motion preferences. Project details stay in README.md and PROJECT.md inside
the ZIP; there is no contents disclosure on the card. Older saved archives remain
usable, with a short project-name caption until their next revision.

Starter requests receive a brief confirmation of the agreed behavior. The export
contains the full files; explicit code questions can still receive examples.
Permitted general programming undergoes independent review without needing matching
Stage documentation. Entity facts and Stage-specific APIs still need evidence.

Stage is a natural starting point for suitable web applications. A chosen language
or another platform is respected: a Python tool, Java application or PSP homebrew
does not need an artificial PHP backend. The installation's `scope` and `building`
settings define that purpose. Other Starchat installations can enable the same
core capability with their own constraints; it is disabled by default.

Each ready ZIP contains source files, README setup/build/run instructions,
PROJECT.md decisions and remaining work, ignore rules and a fresh Git repository
on `main` with no commits or remote. Dependencies and SDKs are installed locally.
The maintainer checks the prepared starter before delivery. The service generates
and reviews custom files but does not execute them. Visitors
run the documented checks in their own environment. Changes made outside this
chat are not uploaded or synchronized back.

A ready card hides its creation action for the current answer.
Completed packages remain beside the answers they describe. A later creation
click uses the latest conversation, including concrete features discussed while
optional choices remain open. Provisional choices are documented. The previous
project remains revision input until a completed replacement succeeds.
Unchanged files are preserved; the assembled project receives independent review.
If an older
client removed a previously offered starter, the conversation can restore that
configured starter before preparing a revision. This does not recover lost custom
files or replace a saved custom project. New conversation clears the project.
Files already downloaded onto the visitor's device remain theirs. The open page
keeps at most twelve package responses; browser storage retains only the latest
project archive. Even a cached archive needs a creation click before display.
A storage failure leaves the current download in memory. Preparation failures
offer a manual retry. Reset, changed locale and a new answer in another tab cancel
pending preparation and prevent late responses from restoring old results.

Custom generation aims for a compact first slice with native controls and short
project documents. A temporarily unavailable independent reviewer can retry once
with the same candidate and remaining request deadline. Generation, timeouts,
invalid responses and rejected projects are not automatically retried.

At the start, four concrete app ideas are drawn from the installation's reviewed
English/German pool. Both familiar and unexpected ideas appear; the long-run
ratio is approximately 1 to the golden ratio. Choices stay stable across reloads
and language changes until a new conversation starts. Contextual follow-ups
replace them after an answer. Short labels submit the complete app request.

Ready ZIPs include AGENTS.md, CLAUDE.md, and docs/agent-tools.md when absent.
Existing project instructions survive revisions. README explains how to continue
with a coding agent. Optional tools are suggestions for the visitor's own agent;
the service installs no plugins, hooks, accounts or additional workers.

Exports are bounded to 40 text files and 32 KiB of serialized project, with
24 KiB of conversation input. Oversized conversations are rejected visibly.
The existing connector identity, model settings and aggregate request capacity
remain in use. No new account, remote repository or deployment is created.
