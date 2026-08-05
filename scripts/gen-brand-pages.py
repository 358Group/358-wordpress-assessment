#!/usr/bin/env python3
"""Generate remaining Harbor Play static preview pages."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "brand" / "preview"

HEAD = """<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{title} — Harbor Play</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<header class="hp-header">
  <div class="hp-header__inner">
    <a class="hp-brand" href="index.html">
      <span class="hp-brand__mark">HP</span>
      <span class="hp-brand__text">
        <span class="hp-brand__name">Harbor Play</span>
        <span class="hp-brand__tag">calm lobby · honest notes</span>
      </span>
    </a>
    <button class="hp-menu-toggle" type="button" aria-expanded="false">Menu</button>
    <nav class="hp-nav" aria-label="Primary">
      <a href="index.html">Home</a>
      <a href="games.html">Games</a>
      <a href="app.html">App</a>
      <a href="about.html">About</a>
      <a href="faq.html">FAQ</a>
      <a href="contact.html">Contact</a>
      <a class="hp-nav__cta" href="login.html">Log in</a>
    </nav>
  </div>
</header>
"""

FOOT = """
<footer class="hp-footer">
  <div class="hp-footer__inner">
    <div>
      <a class="hp-brand" href="index.html"><span class="hp-brand__mark">HP</span>
        <span class="hp-brand__text"><span class="hp-brand__name" style="color:#f4efe6">Harbor Play</span>
        <span class="hp-brand__tag">Demo preview</span></span></a>
    </div>
    <div><h3>Explore</h3><ul>
      <li><a href="games.html">Games</a></li>
      <li><a href="app.html">App</a></li>
      <li><a href="login.html">Login</a></li>
      <li><a href="faq.html">FAQ</a></li>
    </ul></div>
    <div><h3>Reach us</h3><ul>
      <li><a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a></li>
      <li><a href="https://t.me/lomasdollars" target="_blank" rel="noopener">@lomasdollars</a></li>
      <li><a href="disclaimer.html">Disclaimer</a></li>
    </ul></div>
  </div>
  <div class="hp-footer__legal"><p style="margin:0">18+ · Demo · © Harbor Play</p></div>
</footer>
<script src="main.js"></script>
</body>
</html>
"""

pages = {
    "games.html": (
        "Games",
        """
<main>
  <div class="hp-page-hero">
    <h1>Games library</h1>
    <p>A short shelf, not a warehouse. We’d rather describe six games well than drown you in fifty thumbnails.</p>
  </div>
  <div class="hp-content hp-content--wide">
    <div class="hp-games">
      <article class="hp-game" id="river-lanterns"><span class="hp-game__badge">Slots</span><h3>River Lanterns</h3><p>Five reels, gentle soundtrack. RTP sits on the info panel.</p><a href="login.html">Play after login</a></article>
      <article class="hp-game" id="harbor-blackjack"><span class="hp-game__badge">Table</span><h3>Harbor Blackjack</h3><p>Standard soft-17 table. Side bets optional.</p><a href="login.html">Play after login</a></article>
      <article class="hp-game" id="dockside-roulette"><span class="hp-game__badge">Live</span><h3>Dockside Roulette</h3><p>European wheel, limits shown before you join.</p><a href="login.html">Play after login</a></article>
      <article class="hp-game"><span class="hp-game__badge">Slots</span><h3>Midnight Quays</h3><p>Darker palette, slower spins for late evenings.</p><a href="login.html">Play after login</a></article>
      <article class="hp-game"><span class="hp-game__badge">Crash</span><h3>Ferry Climb</h3><p>Cash out when you like. Risk copy above the fold.</p><a href="login.html">Play after login</a></article>
      <article class="hp-game"><span class="hp-game__badge">Table</span><h3>Lantern Baccarat</h3><p>Player / Banker, history strip readable on phones.</p><a href="login.html">Play after login</a></article>
    </div>
  </div>
</main>
""",
    ),
    "login.html": (
        "Login",
        """
<main>
  <div class="hp-page-hero">
    <h1>Log in or register</h1>
    <p>Same form language we’d use on a sticky note. No countdown timers.</p>
  </div>
  <div class="hp-content hp-content--wide">
    <div class="hp-login-grid">
      <form class="hp-form" onsubmit="return false;">
        <h2 style="margin:0;font-size:1.35rem">Welcome back</h2>
        <label>Email<input type="email" placeholder="you@example.com" required></label>
        <label>Password<input type="password" required></label>
        <button class="hp-btn hp-btn--primary" type="submit">Log in</button>
      </form>
      <form class="hp-form" onsubmit="return false;">
        <h2 style="margin:0;font-size:1.35rem">Create an account</h2>
        <label>Display name<input type="text" placeholder="How should we greet you?"></label>
        <label>Email<input type="email" required></label>
        <label>Password<input type="password" required></label>
        <label style="font-weight:500;display:flex;gap:0.5rem;align-items:flex-start">
          <input type="checkbox" required style="margin-top:0.25rem"><span>I am 18+ and I’ve read the disclaimer.</span>
        </label>
        <button class="hp-btn hp-btn--primary" type="submit">Register</button>
      </form>
    </div>
    <div class="hp-notice">Demo forms only. Help: <a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a> · <a href="https://t.me/lomasdollars">@lomasdollars</a></div>
  </div>
</main>
""",
    ),
    "app.html": (
        "App",
        """
<main>
  <div class="hp-page-hero">
    <h1>Harbor Play on your phone</h1>
    <p>Install when you’re ready. Until then, the site works in any modern browser.</p>
  </div>
  <div class="hp-content">
    <ul class="hp-feature-list">
      <li><strong>Android APK (demo)</strong><span>Shows the intended download path and warning copy.</span></li>
      <li><strong>Before you install</strong><span>Only use files from this site or our official Telegram.</span></li>
      <li><strong>iOS</strong><span>Use Safari “Add to Home Screen”. Native iOS isn’t part of this demo.</span></li>
    </ul>
    <div class="hp-hero__actions" style="margin:1.5rem 0">
      <a class="hp-btn hp-btn--primary" href="#">Download Android APK (demo)</a>
      <a class="hp-btn hp-btn--ghost" href="login.html">Log in on web first</a>
    </div>
  </div>
</main>
""",
    ),
    "faq.html": (
        "FAQ",
        """
<main>
  <div class="hp-page-hero"><h1>FAQ</h1><p>Answers written once, revised when people actually ask them.</p></div>
  <div class="hp-content"><div class="hp-faq">
    <details open><summary>What is Harbor Play?</summary><p>A sample brand site for a WordPress demo — warm colours, human copy, calm lobby.</p></details>
    <details><summary>Is there a real money wallet here?</summary><p>No. Forms are front-end demos. Don’t enter real payment details.</p></details>
    <details><summary>How do I reset a password?</summary><p>Write to gajendra.loma@gmail.com and we’ll explain the intended flow.</p></details>
    <details><summary>Can I set deposit limits?</summary><p>In production, yes — before first deposit, next to the cash button.</p></details>
  </div></div>
</main>
""",
    ),
    "about.html": (
        "About",
        """
<main>
  <div class="hp-page-hero">
    <h1>About Harbor Play</h1>
    <p>We built this brand surface to feel like a warm night desk — ink, cream, a little terracotta.</p>
  </div>
  <div class="hp-content">
    <p>Harbor Play is the brand half of the 358 Group WordPress websites: informative like a real lobby site, but written in a human voice instead of stock casino slogans.</p>
    <p>Reference structure nodded to MQM BET–style clarity; the palette and tone are our own. Paired directory site: App Lane.</p>
    <p>Contact: <a href="mailto:gajendra.loma@gmail.com">gajendra.loma@gmail.com</a> · Telegram <a href="https://t.me/lomasdollars">@lomasdollars</a></p>
  </div>
</main>
""",
    ),
    "contact.html": (
        "Contact",
        """
<main>
  <div class="hp-page-hero"><h1>Contact</h1><p>Send a note. We read them.</p></div>
  <div class="hp-content">
    <form class="hp-form" onsubmit="alert('Demo only — please email gajendra.loma@gmail.com'); return false;">
      <label>Name<input type="text" required></label>
      <label>Email<input type="email" required></label>
      <label>Message<textarea rows="5" required></textarea></label>
      <button class="hp-btn hp-btn--primary" type="submit">Send message</button>
    </form>
    <div class="hp-notice">Prefer chat? Telegram <a href="https://t.me/lomasdollars">@lomasdollars</a></div>
  </div>
</main>
""",
    ),
    "disclaimer.html": (
        "Disclaimer",
        """
<main>
  <div class="hp-page-hero"><h1>Disclaimer</h1><p>18+ · informational demo · play responsibly</p></div>
  <div class="hp-content">
    <p>Harbor Play is a WordPress theme demo as a demo. It does not process real money or offer gambling services.</p>
    <p>Any game names, stats, or download buttons are sample content. If you struggle with gambling, seek local support and stop playing.</p>
  </div>
</main>
""",
    ),
}

for name, (title, body) in pages.items():
    (ROOT / name).write_text(HEAD.format(title=title) + body + FOOT, encoding="utf-8")
    print("wrote", name)
