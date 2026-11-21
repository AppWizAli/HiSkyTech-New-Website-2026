<?php
// Fetch service_id if available
$serviceId = $_GET['service_id'] ?? '';
$svcParam = $serviceId ? '&service_id=' . $serviceId : '';
?>

<aside class="sidebar" id="sidebar">
  <script>
    (function () {
      try {
        if (window.innerWidth > 992 && localStorage.getItem('sidebarCollapsed') === '1') {
          document.getElementById('sidebar').classList.add('collapsed');
        }
      } catch (e) {}
    })();
  </script>

  <div class="brand">
    <a href="index.php" class="brand-link">
      <span class="brand-logo">
        <img src="images/black-logo.png" alt="Logo">
      </span>
      <span class="brand-text">
        <strong class="brand-name">HiSkyTech</strong>
        <small class="brand-tagline">Admin Panel</small>
      </span>
    </a>
  </div>

  <div class="sidebar-menu">
    <nav class="nav flex-column">

      <span class="nav-section-label">Overview</span>
      <a class="nav-link" href="index.php" title="Dashboard">
        <i class="bi bi-speedometer2 nav-icon"></i><span class="link-text">Dashboard</span>
      </a>

      <span class="nav-section-label">Website Content</span>

      <a class="nav-link" data-bs-toggle="collapse" href="#trustedBrandSubmenu" title="Trusted Brands">
        <i class="bi bi-award nav-icon"></i><span class="link-text">Trusted Brands</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="trustedBrandSubmenu">
        <a class="nav-link" href="show.php?table=trusted_brand"><i class="bi bi-eye"></i><span class="link-text">Show Brands</span></a>
        <a class="nav-link" href="add.php?table=trusted_brand"><i class="bi bi-plus-circle"></i><span class="link-text">Add Brand</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#industriesServeSubmenu" title="Industries Serve">
        <i class="bi bi-building nav-icon"></i><span class="link-text">Industries Serve</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="industriesServeSubmenu">
        <a class="nav-link" href="show.php?table=industries_serve"><i class="bi bi-eye"></i><span class="link-text">Show Industries</span></a>
        <a class="nav-link" href="add.php?table=industries_serve"><i class="bi bi-plus-circle"></i><span class="link-text">Add Industry</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#heroSectionSubmenu" title="Hero Section">
        <i class="bi bi-film nav-icon"></i><span class="link-text">Hero Section</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="heroSectionSubmenu">
        <a class="nav-link" href="show.php?table=hero_section"><i class="bi bi-eye"></i><span class="link-text">Show Hero</span></a>
        <a class="nav-link" href="add.php?table=hero_section"><i class="bi bi-plus-circle"></i><span class="link-text">Add Hero</span></a>
      </div>

      <span class="nav-section-label">Services</span>

      <a class="nav-link" data-bs-toggle="collapse" href="#servicesSubmenu" title="Services">
        <i class="bi bi-gear nav-icon"></i><span class="link-text">Services</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="servicesSubmenu">
        <a class="nav-link" href="show.php?table=services"><i class="bi bi-eye"></i><span class="link-text">Show Services</span></a>
        <a class="nav-link" href="add.php?table=services"><i class="bi bi-plus-circle"></i><span class="link-text">Add Service</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#mobileDevelopSubmenu" title="Mobile Develop">
        <i class="bi bi-phone nav-icon"></i><span class="link-text">Mobile Develop</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="mobileDevelopSubmenu">
        <a class="nav-link" href="show.php?table=mobile_develop<?= $svcParam ?>"><i class="bi bi-eye"></i><span class="link-text">Show Mobile Dev</span></a>
        <a class="nav-link" href="add.php?table=mobile_develop<?= $svcParam ?>"><i class="bi bi-plus-circle"></i><span class="link-text">Add Mobile Dev</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#appExpertiesSubmenu" title="App Experties">
        <i class="bi bi-cpu nav-icon"></i><span class="link-text">App Experties</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="appExpertiesSubmenu">
        <a class="nav-link" href="show.php?table=app_experties<?= $svcParam ?>"><i class="bi bi-eye"></i><span class="link-text">Show App Experties</span></a>
        <a class="nav-link" href="add.php?table=app_experties<?= $svcParam ?>"><i class="bi bi-plus-circle"></i><span class="link-text">Add App Experties</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#ourFeatureSubmenu" title="Our Feature">
        <i class="bi bi-star nav-icon"></i><span class="link-text">Our Feature</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="ourFeatureSubmenu">
        <a class="nav-link" href="show.php?table=our_feature<?= $svcParam ?>"><i class="bi bi-eye"></i><span class="link-text">Show Features</span></a>
        <a class="nav-link" href="add.php?table=our_feature<?= $svcParam ?>"><i class="bi bi-plus-circle"></i><span class="link-text">Add Feature</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#ourStackSubmenu" title="Our Stack">
        <i class="bi bi-stack nav-icon"></i><span class="link-text">Our Stack</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="ourStackSubmenu">
        <a class="nav-link" href="show.php?table=our_stack"><i class="bi bi-eye"></i><span class="link-text">Show Stack</span></a>
        <a class="nav-link" href="add.php?table=our_stack"><i class="bi bi-plus-circle"></i><span class="link-text">Add Stack</span></a>
      </div>

      <span class="nav-section-label">Content &amp; Work</span>

      <a class="nav-link" data-bs-toggle="collapse" href="#blogsSubmenu" title="Blogs">
        <i class="bi bi-journal-text nav-icon"></i><span class="link-text">Blogs</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="blogsSubmenu">
        <a class="nav-link" href="show.php?table=blogs_content"><i class="bi bi-eye"></i><span class="link-text">Show Blogs</span></a>
        <a class="nav-link" href="add.php?table=blogs_content"><i class="bi bi-plus-circle"></i><span class="link-text">Add Blog</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#caseStudiesSubmenu" title="Case Studies">
        <i class="bi bi-briefcase nav-icon"></i><span class="link-text">Case Studies</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="caseStudiesSubmenu">
        <a class="nav-link" href="show.php?table=case_studies"><i class="bi bi-eye"></i><span class="link-text">Show Case Studies</span></a>
        <a class="nav-link" href="add.php?table=case_studies"><i class="bi bi-plus-circle"></i><span class="link-text">Add Case Study</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#portfolioSubmenu" title="Portfolio">
        <i class="bi bi-kanban nav-icon"></i><span class="link-text">Portfolio</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="portfolioSubmenu">
        <a class="nav-link" href="show.php?table=portfolio"><i class="bi bi-eye"></i><span class="link-text">Show Portfolio</span></a>
        <a class="nav-link" href="add.php?table=portfolio"><i class="bi bi-plus-circle"></i><span class="link-text">Add Portfolio</span></a>
      </div>

      <a class="nav-link" data-bs-toggle="collapse" href="#teamsSubmenu" title="Teams">
        <i class="bi bi-people nav-icon"></i><span class="link-text">Teams</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="teamsSubmenu">
        <a class="nav-link" href="show.php?table=teams"><i class="bi bi-eye"></i><span class="link-text">Show Teams</span></a>
        <a class="nav-link" href="add.php?table=teams"><i class="bi bi-plus-circle"></i><span class="link-text">Add Team</span></a>
      </div>

      <span class="nav-section-label">Inbox</span>
      <a class="nav-link" href="show.php?table=contact_messages" title="Contact">
        <i class="bi bi-envelope nav-icon"></i><span class="link-text">Contact</span>
      </a>

      <span class="nav-section-label">Account</span>

      <a class="nav-link" data-bs-toggle="collapse" href="#adminSubmenu" title="Admin">
        <i class="bi bi-person-circle nav-icon"></i><span class="link-text">Admin</span><i class="bi bi-chevron-down chev"></i>
      </a>
      <div class="collapse ps-2" id="adminSubmenu">
        <a class="nav-link" href="signup.php"><i class="bi bi-person-plus"></i><span class="link-text">Signup</span></a>
        <a class="nav-link" href="show.php?table=admin"><i class="bi bi-eye"></i><span class="link-text">Show Admins</span></a>
      </div>

      <a href="logout.php" class="nav-link logout-btn" title="Logout">
        <i class="bi bi-box-arrow-right nav-icon"></i><span class="link-text">Logout</span>
      </a>

    </nav>
  </div>
</aside>
