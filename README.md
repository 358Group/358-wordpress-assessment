# 358 Group — Updated refs (WordPress)

**Branch:** `updated-refs-cachedrop-diwatop`  
**`main` is unchanged** (previous DM Win / ALL DIWA GAME delivery).

## Built with WordPress (not another stack)

Both sites are **real WordPress 6.x block themes** (PHP + `theme.json` + HTML templates + `functions.php`), same CMS approach as the references:

| Role | Reference (also WordPress) | WP theme folder | Local WordPress |
|------|----------------------------|-----------------|-----------------|
| **Brand page** | [cachedrop.net](https://cachedrop.net/) | `brand/theme/harbor-play` | http://localhost:8080 |
| **Directory** | [diwatop.co.in](https://diwatop.co.in/) | `directory/theme/app-lane` | http://localhost:8081 |

Each theme includes:
- `style.css` (Theme Name header — required by WordPress)
- `functions.php` (`wp_enqueue_style` / `wp_enqueue_script`)
- `theme.json` (block theme settings)
- `templates/*.html` + `parts/*.html` (Full Site Editing)
- `index.php` (theme bootstrap)

Stack locally: **WordPress 6.7 + PHP 8.2 + MySQL** via `docker-compose.yml`.

> GitHub Pages links below are **static layout previews only** (for manager feedback).  
> The product you deploy to hosting is the **WordPress theme zip**, activated in WP Admin → Appearance → Themes.

### Layout preview (feedback)

| Role | Live preview |
|------|--------------|
| Brand | https://358group.github.io/diwa-top-brand/ |
| Directory | https://358group.github.io/diwatop-directory/ |

Layout/style matched to the references. **Final content comes next.**

WordPress go-live targets (passwords not stored in git):
- Brand → helplinehrconsulting.com
- Directory → sheelakrishnaswamy.com

## Local WordPress

```bash
git checkout updated-refs-cachedrop-diwatop
cd 358-Group && docker-compose up -d
```

Then activate themes in each WP admin (or run seed scripts in `scripts/`).

## Deploy to live WordPress

```bash
cd brand/theme && zip -r ../../diwa-top-brand-theme.zip harbor-play
cd ../../directory/theme && zip -r ../../diwatop-directory-theme.zip app-lane
```

Upload in **WP Admin → Appearance → Themes → Add New → Upload Theme** → Activate.

**18+** · Informational layout demos — not live gambling operators.
