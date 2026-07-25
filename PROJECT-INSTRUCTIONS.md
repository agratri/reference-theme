# Claude Desktop — Project setup

How to wire this repo into a Claude Desktop project so that a fresh chat converts an HTML
template into a WordPress theme without you re-explaining anything.

---

## 1. Folder layout on your PC

Connect **`wp-content`** as the folder. Theme and plugin both get written in one session, and
the reference + template sit right next to them.

```
D:\laragon\www\<site>\wp-content\      ← connect THIS folder
├── _reference-theme\                  ← clone of this repo
├── _html-templates\
│   └── example-template\              ← unzipped HTML template
├── themes\
│   └── <slug>\                        ← Claude writes the theme here
└── plugins\
    └── <slug>-core\                   ← Claude writes the plugin here
```

Rules for this layout:

- The reference and the templates go in `wp-content/`, **never inside `themes/`** — WordPress
  scans `themes/` and would list them as broken themes.
- The leading `_` keeps them at the top of the directory listing and marks them as not-a-plugin.
- `wp-content/plugins/` must be writable in the same session, which is why you connect
  `wp-content` and not `wp-content/themes`.

Clone once, pull when you update the reference:

```bash
cd D:\laragon\www\<site>\wp-content
git clone https://github.com/agratri/reference-theme.git _reference-theme

# later
cd _reference-theme && git pull
```

---

## 2. Project instructions

Projects → New project → name it "WordPress Theme" → paste this into **Instructions**:

```
You convert HTML templates into ThemeForest-standard WordPress themes.

## Reference — read before writing any code

The connected folder contains a reference implementation in a folder holding CLAUDE.md and
docs/ (normally _reference-theme/). Read its CLAUDE.md first, every time. It defines the
architecture, naming conventions, file structure and workflow you must follow.

Then read the docs/ file for the step you are on:
architecture.md, header-footer.md, widgets.md, customizer.md, metabox.md,
elementor-widgets.md, templates.md, html-to-wp-workflow.md, rename-checklist.md,
known-issues.md

Read the file. Do not work from memory of it.

If the reference folder is not present in the connected folder, fetch it from
https://raw.githubusercontent.com/agratri/reference-theme/main/CLAUDE.md
and the matching docs/ URLs, then tell me the local copy is missing.

## Environment

- Local WordPress via Laragon. The connected folder is wp-content.
- Theme  → themes/<slug>/
- Plugin → plugins/<slug>-core/
- Never write outside the connected folder. Never modify _reference-theme/ or the source
  HTML template.

## Rules

1. Follow the reference conventions exactly. Do not invent a different architecture, naming
   scheme or file layout.
2. Two packages always. Presentation in the theme, functionality in the plugin. Elementor
   widgets, custom post types and WP_Widget classes go in the plugin, never the theme.
3. Work through docs/html-to-wp-workflow.md one step at a time. Report what was done and what
   is missing at the end of each step, then wait for my confirmation. Never attempt the whole
   conversion in one pass.
4. Ask before assuming: theme slug and prefix; whether a section is a Customizer option, an
   Elementor widget or a custom post type; whether WooCommerce / Charitable / Eventin are
   needed.
5. If the HTML needs a pattern that does not exist in the reference, stop and say so. Propose
   an approach; do not silently invent a new convention.
6. Read docs/known-issues.md and do not reproduce the bugs listed there.
7. Every string translatable, every output escaped, every optional region guarded.
8. After each step, run a PHP syntax check on the files you wrote before reporting done.

## First response in a new conversion chat

Do not start coding. Produce the Step 0 inventory from docs/html-to-wp-workflow.md: pages,
header variants, footer variants, sections with their wrapper classes, assets and load order,
JS libraries, and a Customizer / widget / CPT classification for every section. Then ask the
open questions.
```

---

## 3. Per conversion chat

- New chat inside that project
- Connect `D:\laragon\www\<site>\wp-content`
- Prompt:

```
_html-templates\example-template folder ta WordPress theme e convert koro.
Reference: _reference-theme
Slug: example    Prefix: example_    Text domain: example
```

Giving the slug/prefix up front skips a round of questions. Leave it out and Claude will ask.

---

## 4. Why a local copy, not GitHub

Fetching eleven markdown files over the network at the start of every chat is slow and fails if
GitHub is unreachable. A connected folder is read instantly and is always available. The GitHub
URL stays in the instructions only as a fallback.

Note that `CLAUDE.md` inside a connected folder is picked up automatically — that is why the
rules in it apply without you pasting them.

---

## 5. The HTML template must be local

The reference works fine over HTTP because it is plain markdown. **The HTML template does not.**
A conversion needs the template's real files:

- CSS and JS, in their original load order
- fonts (`.woff2`, `.ttf`)
- the whole `img/` tree

Fetching a page over HTTP gives only markup, not assets. So download or `git clone` the template
into `_html-templates/` before starting.

A live URL (GitHub Pages etc.) is still useful for Claude to *look at* a specific page's design
and markup — just not as the source of the asset files.

---

## 6. Keeping the reference updated

When a conversion teaches you something — a pattern the reference was missing, a bug you hit —
put it back into this repo, not into the project instructions. The instructions should stay
short; the reference is where the knowledge lives.

```bash
cd D:\wp-theme\reference-theme
git add . && git commit -m "docs: <what you learned>" && git push
```

Then `git pull` in each `_reference-theme/` clone.
