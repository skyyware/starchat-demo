# Working on the Stage chat demo

This is the public functional installation at chat.stage.dev. The private
skyyware/starchat engine arrives through Composer. Keep this repository's fresh
public history free of engine source, private website history, credentials,
account metadata, CMS dumps and operational host files. Stage's regular website
lives separately at stage.dev; its public guides are the chat's source material.

stage.dev and chat.stage.dev have one design owner: the regular website's
/branding/stage.css, /branding/stage-star.svg and public fonts. The chat loads
these directly through brand.asset_origin=https://stage.dev after engine CSS.
Change shared design at that owner, then test both website and chat, desktop and
mobile. Do not add a duplicate theme here, a copy job or an automatic pipeline.
Keep the website's Chat menu link next to GitHub, opening in the same tab.

The active installations are Esslingen, Stage chat and Sonnenzeit. Sonnenzeit
remains actively developed by its owner and currently runs locally. Do not revive
the retired Starchat self-demo or SKYYWARE chat. No worker, task or scheduler may
be created as part of ordinary maintenance. GitHub Actions stays disabled.

The knowledge snapshot owns only reviewed, public material. Use docs/knowledge.md
when a relevant source changes. Do not connect private repositories, CMS drafts
or arbitrary Markdown to the running chat. Preserve full browser history, the
Stage identity/key and the origin-bound read-only migration from stage.dev.
Never import the old Starchat self-demo's conversation key.

Run composer check, inspect the affected real answers and use the native browser
before delivery. Commit explicit reviewed paths and push the configured upstream.
Runtime and deployment receipts stay outside Git. Host activation preserves
rollback, account settings and unrelated applications. New repository visibility
or provider access is not implied by an ordinary dependency update.
