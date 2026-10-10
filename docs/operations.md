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
