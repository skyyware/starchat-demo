# Shared Stage design

The regular website is the design owner. Both surfaces load the same
[stylesheet](https://stage.dev/branding/stage.css) after their structural CSS.
It owns colors, typography, focus treatment and the chat's brand adaptation.
The chat retains the engine's layout and behavior. The shared stylesheet wins
over installation fallback tokens, so changing a color or font there changes
both surfaces on their next load.

Chat navigation, suggestions and download actions share one font size and the
bright text color. Controls and cards have no borders or outlines. Keyboard
focus changes the fill or underlines the text. Download actions sit vertically
centered beside the project description. Answers and requested assets use one
loader with three animated dots and a short status line, restored from Starchat
0.8.1. It aligns with the chat's left edge and uses the Stage muted text color.
At most four choices appear, including asset actions; four use two rows where space allows.
Each keeps its own text width. Additional actions stay under **More options**.
Initial, reset and topic-entry focus waits for a ready composer and respects
typing or a visitor-selected focus.

`installation.json` uses `brand.asset_origin=https://stage.dev`,
`brand.stylesheet=/branding/stage.css` and
`brand.favicon=/branding/stage-star.svg`. The shared star is black in light mode
and white in dark mode. Public fonts are loaded relative to
the shared stylesheet and allow cross-origin reads. No font or brand asset is
copied into this repository. Shared URLs revalidate; do not add immutable caching
or a pinned integrity hash that would prevent the two surfaces updating together.

For local joint work use the Stage website's local HTTPS origin, dev.stage.dev,
and set the local installation's asset origin accordingly. Keep production
configuration on stage.dev. Verify computed colors, fonts, focus states, mobile
layout and the website's Start building action opening the chat in the same tab.

The allowed external origin grants stylesheet, image and font access only.
Scripts and chat requests remain same-origin. Visitors cannot choose the theme
origin. Shared design never grants access to the website's CMS or private data.
