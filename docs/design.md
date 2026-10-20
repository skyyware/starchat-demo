# Shared Stage design

The regular website is the design owner. Both surfaces load the same
[stylesheet](https://stage.dev/branding/stage.css) after their structural CSS.
It owns colors, typography, focus treatment and the chat's brand adaptation.
The chat retains the engine's layout and behavior. The shared stylesheet wins
over installation fallback tokens, so changing a color or font there changes
both surfaces on their next load.

Chat navigation, suggestions and download actions share one font size and the
bright text color. The legal footer uses smaller 13px text.
Language and reset controls, the composer, retry controls,
asset cards and download buttons retain their fine contours. Follow-up questions
have an accent rule; source links are underlined. Keyboard focus changes the fill
or underlines the text, and the language selector has an inset accent.
Download actions sit vertically
centered beside the project description. Answers and requested assets use one
loader with three animated dots and a short localized status line, such as
**Creating project**. It aligns with the chat's left edge and uses the Stage muted
text color. Questions and actions have separate limits of four controls.
Actions use filled, borderless buttons below the questions, without a visible
heading. Their width fits the label, with a minimum 44px touch target and wrapping
on narrow screens. Labeled buttons use regular-weight text without decorative
icons. The area keeps a localized name for screen readers.
Neither area fills or displaces the other.
Four questions use two rows where space allows. Labels keep their own width.
Labels and submitted suggested replies omit trailing full stops, including
restored suggestions. Questions and internal punctuation stay intact.
Extra formats use action-only pages with three formats and **More actions**.
Requests and results remain in the same conversation. Core action layout uses
the canonical Stage palette and fonts; questions retain their text-link styling.
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
