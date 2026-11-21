<div class="topbar d-flex justify-content-between align-items-center flex-wrap">
  <div class="topbar-left d-flex align-items-center gap-2">
    <button id="sidebarToggle" class="btn btn-sm" type="button" aria-label="Toggle sidebar">
      <i class="bi bi-list"></i>
    </button>
    <h5 class="mb-0">Dashboard</h5>
  </div>

  <div class="d-flex align-items-center gap-3">
    <!-- Search bar only visible on lg+ -->
    <div class="search-input d-none d-lg-flex" id="searchBar">
      <i class="bi bi-search"></i>
      <input type="text" placeholder="Search...">
    </div>

    <!-- Profile Dropdown -->
    <div class="dropdown profile-dropdown">
      <a href="#" class="d-flex align-items-center text-decoration-none" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="avatar-btn">
          <img src="images/images.jpg" alt="Admin avatar">
        </span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end mt-2 animate-dropdown" aria-labelledby="profileMenu">
        <li><h6 class="dropdown-header">Ali-hamza</h6></li>
        <li><span class="dropdown-role">Administrator</span></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</div>
