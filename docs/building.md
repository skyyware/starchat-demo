# Build and take your project with you

The Stage chat helps visitors define a project and download a first implementation
as a ZIP. After each completed answer, the current snapshot is prepared in the
background. A download appears only when the complete, reviewed archive is ready.
The download itself starts no model request. The latest snapshot is saved in the browser.

Starter requests receive a brief confirmation of the agreed behavior. The export
contains the full files; explicit code questions can still receive examples.
Permitted general programming passes independent review without needing matching
Stage documentation. Entity facts and Stage-specific APIs still need evidence.

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

A repeated download reuses the prepared snapshot. New decisions hide the old
download while a replacement is prepared from the previous files and conversation.
The replacement overwrites the older browser archive and releases its download
URL. Missing essential decisions or an unrelated goal remove the saved archive;
the conversation can clarify the goal before a download becomes available. New
conversation also clears the project. Files already downloaded onto the visitor’s
device remain theirs. A storage failure is shown while the current download stays
available in memory. Preparation failures offer a manual retry.

Exports are bounded to 40 text files and 32 KiB of serialized project, with
24 KiB of conversation input. Oversized conversations are rejected visibly.
The existing connector identity, model settings and aggregate request capacity
remain in use. No new account, remote repository or deployment is created.
