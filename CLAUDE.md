# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A self-hosted WordPress 4.9.1 site — ColoredCow's "The Coffee Club" (originally "Chemex Club"). Composer fetches WordPress core into `public/wp/`; the single custom theme lives at `public/wp-content/themes/chemex-club/`. There is no DB, plugin code, or wp-config in the repo — those are created locally by the operator.

Branding was renamed Chemex → Coffee Club (see commit `786dd37`) but the theme folder, CSS classes, PHP function prefixes (`chemexclub_*`), and text domain (`chemex-theme`) still use the original name. Don't rename them unless asked — it would break the theme path referenced by the WP database.

## Setup & build

```bash
composer install                                        # fetches WP core into public/wp/
cd public/wp-content/themes/chemex-club && npm install  # theme toolchain
grunt                                                   # one-shot build: SCSS → style.css, JS → main.js
grunt watch                                             # rebuild on change
```

Then copy `public/wp-config-sample.php` → `public/wp-config.php`, fill DB creds + fresh salts, and do the WP 5-minute install. README has the full checklist.

## Theme architecture

Everything interesting is under `public/wp-content/themes/chemex-club/`.

**Build pipeline (Gruntfile.js):**
- `src/scss/style.scss` (imports `colors`, `masonary`, `chemex-brew`) → `style.css` at theme root
- `src/js/*.js` (concat+uglify) → `main.js` at theme root
- Both outputs are git-ignored; `grunt` must run after every SCSS/JS edit for changes to appear

**Enqueueing (functions.php):**
`chemexclub_enqueue_style` / `chemexclub_enqueue_script` load Bootstrap + jQuery from `dist/lib/` (vendored, committed) plus the Grunt-built `style.css` / `main.js`. Fonts (EB Garamond, Roboto) and Font Awesome 5.1 are pulled from CDNs in `header.php`.

**Templates:** Standard WP hierarchy — `header.php`, `footer.php`, `home.php` (blog listing with post thumbnails), `single.php`, `404.php`, `index.php`.

**Chemex brew widget:** A guided pour-over wizard. `chemex-brew.php` holds markup for the floating trigger button + 3-stage modal (setup → brewing → done). Behavior in `src/js/chemex-brew.js`, styles in `src/scss/chemex-brew.scss`. Loaded site-wide via `get_template_part('chemex-brew')` in `footer.php`. Any change to the markup/JS/SCSS requires a `grunt` rebuild.

## Conventions

- Shared date formats live in `constants.php` (`DATE_FORMAT`, `DB_DATE_FORMAT`), included from `functions.php`.
- All theme PHP functions are prefixed `chemexclub_` and wrapped in `function_exists()` checks for child-theme overrideability — preserve both when adding functions.
- `dist/lib/` is vendored third-party assets (Bootstrap, jQuery 1.11.3) — not a build output. Don't delete or try to regenerate it.
