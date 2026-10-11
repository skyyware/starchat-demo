# Build and take your project with you

The Stage chat helps visitors define a project and download a first implementation
as a ZIP. Visitors can export during the discussion and request a new snapshot
after changing a requirement. The latest export is saved in their browser.

Stage is a natural starting point for suitable web applications. A chosen language
or another platform is respected: a Python tool, Java application or PSP homebrew
does not need an artificial PHP backend. The installation's `scope` and `building`
settings define that purpose. Other Starchat installations can enable the same
core capability with their own constraints; it is disabled by default.

Each ready ZIP contains source files, README setup/build/run instructions,
PROJECT.md decisions and remaining work, ignore rules and a fresh Git repository
on `main` with no commits or remote. Dependencies and SDKs are installed locally.
The service generates and reviews the files but does not execute them. Visitors
run the documented checks in their own environment. Changes made outside this
chat are not uploaded or synchronized back.

A repeated download without conversation changes reuses the saved snapshot.
After new decisions, Update project ZIP builds on the previous files. New
conversation clears that project from browser storage. A storage failure is
shown, while the current download remains available in memory. The interface
shows a focused question when an essential decision is missing and a retry when
generation or review fails.

Exports are bounded to 40 text files and 32 KiB of serialized project, with
24 KiB of conversation input. Oversized conversations are rejected visibly.
The existing connector identity, model settings and aggregate request capacity
remain in use. No new account, remote repository or deployment is created.
