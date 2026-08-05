# 358 Group — WordPress websites

| Site | Live URL | Code repo |
|------|----------|-----------|
| **Brand — DM Win** | https://358group.github.io/dm-win/ | https://github.com/358Group/dm-win |
| **Directory — ALL DIWA GAME** | https://358group.github.io/all-diwa-game/ | https://github.com/358Group/all-diwa-game |
| Themes + Docker | — | https://github.com/358Group/358-wordpress-website |

| Role | Reference | Theme folder | Local Docker |
|------|-----------|--------------|--------------|
| **Brand** | [dmwin77.com](https://dmwin77.com/) | `brand/theme/harbor-play` → **DM Win** | http://localhost:8080 |
| **Directory** | [alldiwagame.com](https://www.alldiwagame.com/) | `directory/theme/app-lane` → **ALL DIWA GAME** | http://localhost:8081 |

## What to review

- Brand theme: `brand/theme/harbor-play/`
- Directory theme: `directory/theme/app-lane/`
- Docker: `docker-compose.yml` (Brand `:8080`, Directory `:8081`)
- Seed scripts: `scripts/`

## Local run

```bash
cd 358-Group
# needs Docker + Colima (or Docker Desktop)
docker-compose up -d
```

Then open the two localhost URLs above. Seed pages if needed:

```bash
docker cp scripts/setup-brand.php 358-group-brand-wp-1:/var/www/html/
docker-compose exec brand-wp php setup-brand.php
docker cp scripts/setup-directory.php 358-group-directory-wp-1:/var/www/html/
docker-compose exec directory-wp php setup-directory.php
docker cp scripts/enrich-content.php 358-group-brand-wp-1:/var/www/html/
docker-compose exec -e SITE=brand brand-wp php enrich-content.php
docker cp scripts/seed-blogs.php 358-group-brand-wp-1:/var/www/html/
docker-compose exec brand-wp php seed-blogs.php
docker cp scripts/enrich-content.php 358-group-directory-wp-1:/var/www/html/
docker-compose exec -e SITE=directory directory-wp php enrich-content.php
```

## Go live (optional)

Zip and upload each theme in WP Admin → Appearance → Themes:

```bash
cd brand/theme && zip -r ../../dm-win-theme.zip harbor-play
cd ../../directory/theme && zip -r ../../all-diwa-theme.zip app-lane
```

**18+** · Informational demos — not live gambling operators.
