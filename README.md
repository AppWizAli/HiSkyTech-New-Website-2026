# HiSkyTech website

Next.js static export for [hiskytechs.com](https://hiskytechs.com). Canonical host is the apex (`https://hiskytechs.com`). `www` is redirected to it by `public/.htaccess`.

## Develop

```bash
npm install
npm run dev
```

## Build

```bash
npm run build
```

`output: 'export'` and `trailingSlash: true` write the site to `out/`. Routes are directories with `index.html` (`out/contact/index.html`), which is what Apache on Hostinger needs. A root `contact.html` next to an empty `contact/` directory is what currently 403s on the live server.

## Publish to Hostinger

There is no GitHub Action or Hostinger deploy hook in this repo. The live site is a manual upload of a previous static export into `~/domains/hiskytechs.com/public_html`.

Upload the **contents** of `out/` into that `public_html` (not the `out` folder itself).

Replace:

- `index.html`, `index.txt`, `404.html`
- the whole `_next/` directory
- `contact/` (it must contain `index.html`)
- `_not-found/` if the build emits it
- `robots.txt`, `sitemap.xml`, `og.png`, `.htaccess`
- updated files under the site root (`logo.webp`, `projects/`, `team/`, icons)

Delete after the new files are in place, so Apache cannot prefer a stale directory:

- root `contact.html` and `contact.txt` (the new route is `contact/index.html`)
- old backup leftovers such as `contact.3342`, `_next.5427`, `_next.8899`, `_not-found.1425`

Leave these folders alone:

- `Admin`
- `blogger_master`
- `convertly`
- `f`
- `ggg`

If `public_html` already has an `.htaccess`, merge `out/.htaccess` into it instead of wiping Hostinger rules. The shipped file turns off directory indexes, sets `DirectoryIndex index.html`, redirects `www` to the apex, and falls back to `route.html` when a directory has no index.

## Owner inputs

In `lib/site.ts`:

- `CALENDLY_URL` — empty until a real scheduling link is pasted. Book a call emails `hiskytechs@gmail.com` in the meantime.
- `FORM_ENDPOINT` — empty on purpose. The inquiry form opens WhatsApp (`wa.me/923186362759`) and, without JavaScript, uses `mailto:`. Paste a Formspree/Getform URL here only if you want the form to POST somewhere else. Do not point it at a Next.js API route; this hosting is static.
