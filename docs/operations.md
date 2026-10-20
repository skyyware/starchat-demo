# Operate an installation

Build from the exact reviewed commit and Composer lock with existing authorized
private dependency access. Keep credentials out of the artifact. Prepare the
knowledge index separately, check its entity and article count, and deploy the
application and matching index together. Preserve the previous release and index
for rollback. Run syntax/configuration checks before changing a live pointer.

Only public/ belongs behind the web server. Knowledge source files, manifests,
vendor/, runtime, .env and Git data must not be directly served. Protect the
provider account and keep its working directory separate from source material.
See the public [operating guide](https://stage.dev/resources/starchat-operations).

After activation check /health against the exact commit, build, engine version
and expected knowledge count. Also test a real answer and browser behavior.
Health alone does not establish provider availability. Do not change the model,
account or access settings as a side effect of a website deployment.

The Stage chat moved from stage.dev to chat.stage.dev. Its identity remains
stage and its history key remains starchat:stage:conversation. A strictly paired,
read-only browser bridge may import that old conversation if the new key is
absent. It retains the old copy and never imports the former Starchat self-demo
key. The regular website's old /chat POST endpoint is retired; prepared-question
links at stage.dev/?q=... continue to the new chat.

GitHub Actions and dependency automation are disabled. Deployment is deliberate,
not a side effect of a push. Operator-specific commands, rollback receipts and
host configuration belong outside this public repository.

## Verified release on 20 October 2026

Build 46 serves commit `1cc9cf4427df563d0befbf544e0baa22f6c47b55` with
Starchat 0.10.4 and 29 reviewed guides. Build 45 remains the rollback release.
The snapshot is bound to website source
`a44d7cad3120f0a2b04c71587b8f63b18ae5b329` in `knowledge/sources.json`.
It includes the [answer API guide](https://stage.dev/resources/starchat-answer-api).

Public checks confirm the build, guide count, served core files and shared theme.
Native browser checks at 1,280 and 390 pixels confirm single-line opening labels,
regular control text, the smaller legal footer and no page overflow or console
errors. The existing empty conversation remains unchanged. These release checks
send no message and create no asset; they do not establish fresh model availability.
Action, retry and download behavior was checked locally with a controlled connector
before delivery. This documentation update does not change the deployed commit.
