(function () {
  var header = document.querySelector(".dt-header");
  var toggle = document.querySelector(".dt-menu-toggle");
  if (!header || !toggle) return;
  function setOpen(open) {
    header.classList.toggle("is-open", open);
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.textContent = open ? "Close" : "Menu";
  }
  toggle.addEventListener("click", function () {
    setOpen(!header.classList.contains("is-open"));
  });
  header.querySelectorAll("a").forEach(function (a) {
    a.addEventListener("click", function () {
      if (window.matchMedia("(max-width: 900px)").matches) setOpen(false);
    });
  });
  var path = window.location.pathname.replace(/\/$/, "") || "/";
  header.querySelectorAll(".dt-nav a[href]").forEach(function (a) {
    var href = a.getAttribute("href").replace(/\/$/, "") || "/";
    if (href === path) a.setAttribute("aria-current", "page");
  });
})();
