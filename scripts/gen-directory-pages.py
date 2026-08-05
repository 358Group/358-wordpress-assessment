#!/usr/bin/env python3
"""Generate App Lane static preview pages."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "directory" / "preview"

HEAD = """<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{title} — App Lane</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Literata:opsz,wght@7..72,500;7..72,600;7..72,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<header class="al-header">
  <div class="al-header__inner">
    <a class="al-logo" href="index.html"><strong>App Lane</strong><span>a quiet app catalogue</span></a>
    <button class="al-menu-toggle" type="button" aria-expanded="false">Menu</button>
    <nav class="al-nav" aria-label="Primary">
      <a href="index.html">Catalogue</a>
      <a href="about.html">About</a>
      <a href="contact.html">Contact</a>
      <a href="disclaimer.html">Disclaimer</a>
      <a href="sitemap.html">Sitemap</a>
    </nav>
  </div>
</header>
"""

FOOT = """
<footer class="al-footer">
  <div class="al-footer__inner">
    <div><a class="al-logo" href="index.html"><strong>App Lane</strong></a>
      <p style="margin:0.75rem 0 0;color:#6f6a63;max-width:36ch;font-size:0.95rem">Notebook-style directory. Listings are editorial notes.</p></div>
    <div><h3>Pages</h3><ul>
      <li><a href="index.html">Catalogue</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="sitemap.html">Sitemap</a></li>
    </ul></div>
    <div><h3>Contact</h3><ul>
      <li><a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a></li>
      <li><a href="https://t.me/lomasdollars" target="_blank" rel="noopener">@lomasdollars</a></li>
      <li><a href="privacy.html">Privacy</a></li>
      <li><a href="terms.html">Terms</a></li>
    </ul></div>
  </div>
  <div class="al-footer__legal"><p style="margin:0">Demo directory · © App Lane · theme in <code>../theme/app-lane</code></p></div>
</footer>
<script src="main.js"></script>
</body>
</html>
"""

index_body = """
<main>
  <section class="al-hero">
    <p class="al-section__label" style="margin-bottom:0.5rem">App Lane</p>
    <h1>Apps written down like notes in a margin.</h1>
    <p>No fireworks grid. Just a catalogue of titles we’ve opened, with honest blurbs and a path to the detail page.</p>
  </section>
  <div class="al-search">
    <form onsubmit="return false;" role="search">
      <input type="search" placeholder="Search by name… (demo)">
      <button type="submit">Search</button>
    </form>
  </div>
  <section class="al-section">
    <p class="al-section__label">This week’s shelf</p>
    <div class="al-grid">
      <article class="al-app"><div class="al-app__meta"><span>Entertainment</span><span>Updated Jul 2026</span></div>
        <h3><a href="app-harbor-play.html">Harbor Play</a></h3>
        <p>Calm lobby brand with a soft night-desk feel. Good example of login + games pages that don’t shout.</p>
        <a class="al-app__link" href="app-harbor-play.html">Open notes →</a></article>
      <article class="al-app"><div class="al-app__meta"><span>Utility</span><span>Updated Jul 2026</span></div>
        <h3><a href="app-ledger-lite.html">Ledger Lite</a></h3>
        <p>A pocket expense pad. Empty states that sound like a person.</p>
        <a class="al-app__link" href="app-ledger-lite.html">Open notes →</a></article>
      <article class="al-app"><div class="al-app__meta"><span>Games</span><span>Updated Jun 2026</span></div>
        <h3><a href="app-dock-dice.html">Dock Dice</a></h3>
        <p>Casual dice nights with friends. Listing kept short on purpose.</p>
        <a class="al-app__link" href="app-dock-dice.html">Open notes →</a></article>
      <article class="al-app"><div class="al-app__meta"><span>Reading</span><span>Updated Jun 2026</span></div>
        <h3><a href="app-margin-reader.html">Margin Reader</a></h3>
        <p>EPUBs with wide margins for scribbling.</p>
        <a class="al-app__link" href="app-margin-reader.html">Open notes →</a></article>
      <article class="al-app"><div class="al-app__meta"><span>Music</span><span>Updated May 2026</span></div>
        <h3><a href="app-porch-radio.html">Porch Radio</a></h3>
        <p>Slow stations and a “quiet hours” toggle.</p>
        <a class="al-app__link" href="app-porch-radio.html">Open notes →</a></article>
      <article class="al-app"><div class="al-app__meta"><span>Tools</span><span>Updated May 2026</span></div>
        <h3><a href="app-stitch-notes.html">Stitch Notes</a></h3>
        <p>Voice memos that stitch into one timeline.</p>
        <a class="al-app__link" href="app-stitch-notes.html">Open notes →</a></article>
    </div>
  </section>
  <div class="al-section" style="padding-top:0">
    <div class="al-note">
      <h2>How we pick listings</h2>
      <p>Someone opens the app, uses it for a day, then writes a paragraph. Suggest one via the contact page.</p>
    </div>
  </div>
</main>
"""

apps = [
    ("app-harbor-play.html", "Harbor Play", "Entertainment", "Calm lobby brand with cream-and-ink palette. Login keeps register and sign-in side by side."),
    ("app-ledger-lite.html", "Ledger Lite", "Utility", "Pocket expense pad with empty states that sound human, not like an empty database."),
    ("app-dock-dice.html", "Dock Dice", "Games", "Casual dice for friends. Short listing because the app itself is short — in a good way."),
    ("app-margin-reader.html", "Margin Reader", "Reading", "EPUBs with wide margins. Dark mode that doesn’t go pure black."),
    ("app-porch-radio.html", "Porch Radio", "Music", "Slow stations, fewer ads in free tier, quiet-hours toggle."),
    ("app-stitch-notes.html", "Stitch Notes", "Tools", "Voice memos stitched into one timeline after long walks."),
]

def app_page(title, category, blurb):
    return f"""
<main>
  <div class="al-page-hero">
    <p class="al-section__label">App notes</p>
    <h1>{title}</h1>
    <p>{category} · editorial sample</p>
  </div>
  <div class="al-content al-content--wide">
    <div class="al-detail">
      <div>
        <p>{blurb}</p>
        <p><strong>Watch-outs:</strong> verify downloads from official sources. Listings are notes, not guarantees.</p>
        <p style="margin-top:1.5rem">
          <a class="al-btn" href="#">Visit official site (demo)</a>
          <a class="al-btn al-btn--ghost" href="index.html">Back to catalogue</a>
        </p>
      </div>
      <aside class="al-side">
        <dl>
          <dt>Category</dt><dd>{category}</dd>
          <dt>Platforms</dt><dd>Web · Mobile</dd>
          <dt>Contact</dt><dd><a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a></dd>
          <dt>Telegram</dt><dd><a href="https://t.me/lomasdollars">@lomasdollars</a></dd>
        </dl>
      </aside>
    </div>
  </div>
</main>
"""

pages = {
    "index.html": ("Catalogue", index_body),
    "about.html": (
        "About",
        """
<main>
  <div class="al-page-hero"><h1>About App Lane</h1><p>A directory that feels like a notebook, not an app store ad wall.</p></div>
  <div class="al-content">
    <p>App Lane is the directory half of the 358 Group WordPress websites. Structure nods to All Diwa Game–style catalogues; the paper texture, leaf accents, and margin-note voice are ours.</p>
    <p>We list fewer apps on purpose. If we can’t write a specific sentence, it doesn’t ship.</p>
  </div>
</main>
""",
    ),
    "contact.html": (
        "Contact",
        """
<main>
  <div class="al-page-hero"><h1>Contact</h1><p>Suggest an app or ask about a listing.</p></div>
  <div class="al-content">
    <form class="al-form" onsubmit="alert('Demo only — email gajendra.loma@gmail.com'); return false;">
      <label>Name<input required></label>
      <label>Email<input type="email" required></label>
      <label>Message<textarea rows="5" required></textarea></label>
      <button class="al-btn" type="submit">Send</button>
    </form>
  </div>
</main>
""",
    ),
    "disclaimer.html": (
        "Disclaimer",
        """
<main>
  <div class="al-page-hero"><h1>Disclaimer</h1><p>Informational demo directory.</p></div>
  <div class="al-content">
    <p>App Lane does not operate the apps we write about. Listings are editorial samples.</p>
    <p>Real-money apps: legal age only (often 18+). Verify licences and downloads yourself.</p>
  </div>
</main>
""",
    ),
    "privacy.html": (
        "Privacy",
        """
<main>
  <div class="al-page-hero"><h1>Privacy</h1><p>What we’d collect on a live site — kept short.</p></div>
  <div class="al-content">
    <p>This static/WordPress demo does not collect personal data. On a live install, contact forms would store what you submit and email it to the site owner.</p>
    <p>Questions: gajendra.loma@gmail.com</p>
  </div>
</main>
""",
    ),
    "terms.html": (
        "Terms",
        """
<main>
  <div class="al-page-hero"><h1>Terms</h1><p>Lightweight terms for a demo catalogue.</p></div>
  <div class="al-content">
    <p>Content is provided as-is for demonstration. Don’t rely on listings for financial or legal decisions.</p>
    <p>We may update sample pages anytime as needed.</p>
  </div>
</main>
""",
    ),
    "sitemap.html": (
        "Sitemap",
        """
<main>
  <div class="al-page-hero"><h1>Sitemap</h1><p>Every page in this preview.</p></div>
  <div class="al-content">
    <ul>
      <li><a href="index.html">Catalogue (home)</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="disclaimer.html">Disclaimer</a></li>
      <li><a href="privacy.html">Privacy</a></li>
      <li><a href="terms.html">Terms</a></li>
      <li>Apps:
        <ul>
          <li><a href="app-harbor-play.html">Harbor Play</a></li>
          <li><a href="app-ledger-lite.html">Ledger Lite</a></li>
          <li><a href="app-dock-dice.html">Dock Dice</a></li>
          <li><a href="app-margin-reader.html">Margin Reader</a></li>
          <li><a href="app-porch-radio.html">Porch Radio</a></li>
          <li><a href="app-stitch-notes.html">Stitch Notes</a></li>
        </ul>
      </li>
    </ul>
  </div>
</main>
""",
    ),
}

for fname, title, cat, blurb in apps:
    pages[fname] = (title, app_page(title, cat, blurb))

for name, (title, body) in pages.items():
    (ROOT / name).write_text(HEAD.format(title=title) + body + FOOT, encoding="utf-8")
    print("wrote", name)
