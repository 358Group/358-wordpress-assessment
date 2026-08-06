(function () {
  // Sticky close fallback (primary logic is inline in footer).
  var sticky = document.getElementById("cd-sticky-aff");
  var stickyClose = document.getElementById("cd-sticky-aff-close");
  var stickyKey = "cdStickyAffDismissed_v3";
  if (!sticky || !stickyClose || sticky.dataset.bound === "1") return;
  sticky.dataset.bound = "1";
  stickyClose.addEventListener("click", function () {
    sticky.style.display = "none";
    document.body.classList.remove("has-cd-sticky-aff");
    try { window.localStorage.setItem(stickyKey, "1"); } catch (e) {}
  });
})();

(function () {
  var header = document.querySelector(".cd-header");
  var toggle = document.querySelector(".cd-menu-toggle");
  if (!header || !toggle) return;

  function setOpen(open) {
    header.classList.toggle("is-open", open);
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    if (!open) {
      header.querySelectorAll(".cd-nav__item.is-open").forEach(function (el) {
        el.classList.remove("is-open");
      });
    }
  }

  toggle.addEventListener("click", function () {
    setOpen(!header.classList.contains("is-open"));
  });

  header.querySelectorAll(".cd-nav__item").forEach(function (item) {
    var link = item.querySelector(".cd-nav__link");
    if (!link) return;
    link.addEventListener("click", function (e) {
      if (!window.matchMedia("(max-width: 900px)").matches) return;
      if (!item.querySelector(".cd-nav__drop")) return;
      e.preventDefault();
      var open = item.classList.toggle("is-open");
      header.querySelectorAll(".cd-nav__item.is-open").forEach(function (other) {
        if (other !== item) other.classList.remove("is-open");
      });
      if (!open) item.classList.remove("is-open");
    });
  });

  header.querySelectorAll(".cd-nav__drop a").forEach(function (a) {
    a.addEventListener("click", function () {
      if (window.matchMedia("(max-width: 900px)").matches) setOpen(false);
    });
  });

  var path = window.location.pathname.replace(/\/$/, "") || "/";
  header.querySelectorAll(".cd-nav a[href]").forEach(function (a) {
    var href = a.getAttribute("href").replace(/\/$/, "") || "/";
    if (href === path) a.setAttribute("aria-current", "page");
  });
})();
