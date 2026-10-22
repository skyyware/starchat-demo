# Build and take your project with you

The Stage chat helps visitors turn an everyday difficulty into a useful first
application and download its implementation as a ZIP. Visitors need neither a
finished idea nor programming knowledge. The conversation starts with the person,
the problem and one useful workflow, with at most one material question at a time.
Confirmed needs, provisional choices and later extensions remain distinct.

An explicit framework or starter request can offer a prepared minimal Stage application.
This optional framework example is not a substitute for the visitor's chosen
application. It includes one JSON endpoint, local run instructions and checks.
Pure idea discovery first helps the visitor find a useful purpose, without
describing or offering this starter. A later useful offer uses plain language.
The reviewed source lives in
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
The ready card uses a package icon and a description of the current function
in at most four words. It enters with a short slide and fade, disabled by
reduced-motion preferences. Project details stay in README.md and PROJECT.md inside
the ZIP; there is no contents disclosure on the card. A saved archive can be reused only when its conversation and export-policy version
match. Older files remain revision input; a failed replacement does not erase them.

Starter requests receive a brief confirmation of the agreed behavior. The export
contains the full files; explicit code questions can still receive examples.
Permitted general programming undergoes independent review without needing matching
Stage documentation. Entity facts and Stage-specific APIs still need evidence.

Every exported project from chat.stage.dev uses Stage 0.2 on PHP 8.4, including
custom applications and revisions. The actual web entry point runs the Stage
application; an unused dependency or import is insufficient. An explicit request
for an incompatible platform receives an honest explanation and no misleading ZIP.
Other Starchat installations can use the same optional core capability with their
own technology constraints.

`building.policy=stage-web-v1` selects the trusted installation checker in
`config/project-policy.php`. It validates Composer requirements, the canonical
`public/index.php` and the direct Stage application return in `app.php`. It only
parses text and never executes generated files. Both prepared starter and assembled
revisions must pass. Independent review then checks that Stage routes implement
the requested function. Maintainer probes separately run representative exports
locally; the structural checker alone does not prove behavior.

Increment the policy identifier when this contract changes. Existing browser files
remain available as input to the next explicit creation click and are replaced
only after successful validation and review. There is no automatic migration build.

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
