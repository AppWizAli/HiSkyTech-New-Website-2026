document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const overlay = document.getElementById("overlay");
  const searchBar = document.getElementById("searchBar");

  // Only proceed if sidebar exists
  if (sidebar) {
    const links = sidebar.querySelectorAll(".nav-link");
    const collapses = sidebar.querySelectorAll(".collapse");

    /* ==============================
       Sidebar Toggle (Desktop & Mobile)
    ============================== */
    if (sidebarToggle) {
      sidebarToggle.addEventListener("click", () => {
        if (window.innerWidth <= 992) {
          sidebar.classList.toggle("open");
          overlay?.classList.toggle("active");
        } else {
          const isCollapsed = sidebar.classList.toggle("collapsed");
          try { localStorage.setItem("sidebarCollapsed", isCollapsed ? "1" : "0"); } catch (e) {}
        }
      });
    }

    // Overlay click closes sidebar
    if (overlay) {
      overlay.addEventListener("click", () => {
        sidebar.classList.remove("open");
        overlay.classList.remove("active");
      });
    }

    // Keep sidebar state consistent when crossing the mobile/desktop breakpoint
    // (e.g. rotating a device, or resizing a browser window) so a leftover
    // "open" or "collapsed" class from one mode never blocks the other.
    let wasMobile = window.innerWidth <= 992;
    window.addEventListener("resize", () => {
      const isMobile = window.innerWidth <= 992;
      if (isMobile !== wasMobile) {
        sidebar.classList.remove("open", "collapsed");
        overlay?.classList.remove("active");
        wasMobile = isMobile;
      }
    });

    // Optional: Show search bar animation
    if (searchBar) setTimeout(() => searchBar.classList.add("show"), 200);

    /* ==============================
       Sidebar Navigation Logic
    ============================== */
    function clearActiveLinks() {
      links.forEach(link => link.classList.remove("active"));
    }

    links.forEach(link => {
      link.addEventListener("click", () => {
        clearActiveLinks();
        link.classList.add("active");

        const parentCollapse = link.closest(".collapse");
        if (parentCollapse) {
          const parentLink = sidebar.querySelector(`.nav-link[href="#${parentCollapse.id}"]`);
          if (parentLink) parentLink.classList.add("active");
        }
      });
    });

    /* ==============================
       Collapse Events
    ============================== */
    collapses.forEach(collapseEl => {
      collapseEl.addEventListener("hidden.bs.collapse", () => {
        const parentLink = sidebar.querySelector(`.nav-link[href="#${collapseEl.id}"]`);
        if (parentLink) parentLink.classList.remove("active");

        if (!sidebar.querySelector(".nav-link.active")) {
          const dashboard = sidebar.querySelector('.nav-link[href="index.php"]');
          if (dashboard) dashboard.classList.add("active");
        }
      });

      collapseEl.addEventListener("show.bs.collapse", () => {
        setTimeout(() => {
          const sidebarRect = sidebar.getBoundingClientRect();
          const submenuRect = collapseEl.getBoundingClientRect();

          if (submenuRect.bottom > sidebarRect.bottom) {
            sidebar.scrollBy({ top: submenuRect.bottom - sidebarRect.bottom + 20, behavior: "smooth" });
          } else if (submenuRect.top < sidebarRect.top) {
            sidebar.scrollBy({ top: submenuRect.top - sidebarRect.top - 20, behavior: "smooth" });
          }
        }, 300);
      });
    });

    /* ==============================
       Set Dashboard Active by Default
    ============================== */
    if (!sidebar.querySelector(".nav-link.active")) {
      const dashboard = sidebar.querySelector('.nav-link[href="index.php"]');
      if (dashboard) dashboard.classList.add("active");
    }
  }

  /* ==============================
     Table Search Functionality
  ============================== */
  const searchInput = document.getElementById("tableSearch");
  const searchBtn = document.getElementById("searchBtn");
  const rows = document.querySelectorAll("tbody tr");

  if (searchInput && searchBtn && rows.length) {
    const filterTable = () => {
      const query = searchInput.value.toLowerCase().trim();
      rows.forEach(row => {
        const match = Array.from(row.querySelectorAll("td"))
          .some(cell => cell.innerText.toLowerCase().includes(query));
        row.style.display = match ? "" : "none";
      });
    };

    searchBtn.addEventListener("click", filterTable);
    searchInput.addEventListener("keyup", e => {
      if (e.key === "Enter") filterTable();
    });
  }
});
