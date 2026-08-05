(function () {
  const header = document.querySelector(".hp-header");
  const toggle = document.querySelector(".hp-menu-toggle");
  if (!header || !toggle) return;

  toggle.addEventListener("click", function () {
    const open = header.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.textContent = open ? "Close" : "Menu";
  });
})();
