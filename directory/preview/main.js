(function () {
  const header = document.querySelector(".al-header");
  const toggle = document.querySelector(".al-menu-toggle");
  if (!header || !toggle) return;

  toggle.addEventListener("click", function () {
    const open = header.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.textContent = open ? "Close" : "Menu";
  });
})();
