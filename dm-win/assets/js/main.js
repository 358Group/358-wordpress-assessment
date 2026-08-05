(function () {
  /* ——— Mobile nav ——— */
  var header = document.querySelector(".dm-header");
  var toggle = document.querySelector(".dm-menu-toggle");
  if (header && toggle) {
    function setOpen(open) {
      header.classList.toggle("is-open", open);
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
      toggle.textContent = open ? "Close" : "Menu";
    }

    toggle.addEventListener("click", function () {
      setOpen(!header.classList.contains("is-open"));
    });

    header.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        if (window.matchMedia("(max-width: 980px)").matches) setOpen(false);
      });
    });

    var path = window.location.pathname.replace(/\/$/, "") || "/";
    header.querySelectorAll("a[href]").forEach(function (a) {
      var href = a.getAttribute("href").replace(/\/$/, "") || "/";
      if (href === path || (href !== "/" && path.indexOf(href) === 0)) {
        a.setAttribute("aria-current", "page");
      }
    });
  }

  /* ——— Scroll counter animation ——— */
  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
  }

  function animateValue(el, duration) {
    var target = parseFloat(el.getAttribute("data-target") || "0", 10);
    var suffix = el.getAttribute("data-suffix") || "";
    var decimals = parseInt(el.getAttribute("data-decimals") || "0", 10);
    var start = performance.now();

    if (reduceMotion) {
      el.textContent = target.toFixed(decimals) + suffix;
      return;
    }

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var value = target * easeOutCubic(progress);
      el.textContent = value.toFixed(decimals) + suffix;
      if (progress < 1) {
        requestAnimationFrame(frame);
      } else {
        el.textContent = target.toFixed(decimals) + suffix;
      }
    }

    requestAnimationFrame(frame);
  }

  function runCounters(root) {
    if (!root || root.getAttribute("data-counted") === "1") return;
    root.setAttribute("data-counted", "1");
    root.classList.add("is-visible");

    var items = root.querySelectorAll(".dm-stat__value[data-target]");
    items.forEach(function (el, i) {
      // Slight stagger so the row feels alive
      setTimeout(function () {
        el.parentElement.classList.add("is-animated");
        animateValue(el, 1400 + i * 120);
      }, i * 90);
    });
  }

  var counterBlocks = document.querySelectorAll("[data-dm-counters]");
  if (!counterBlocks.length) return;

  if (!("IntersectionObserver" in window)) {
    counterBlocks.forEach(runCounters);
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          runCounters(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.35, rootMargin: "0px 0px -8% 0px" }
  );

  counterBlocks.forEach(function (block) {
    observer.observe(block);
  });
})();
