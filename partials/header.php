<?php
require_once "Admin/config/db.php";

/* ===== SERVICES ===== */
$services = [];
$res = $conn->query("
    SELECT service_title2, slug 
    FROM services 
    ORDER BY id ASC
");
while ($row = $res->fetch_assoc()) {
    $services[] = $row;
}

/* ===== CASE STUDIES ===== */
$cases = [];
$res = $conn->query("
    SELECT case_study_title, slug 
    FROM case_studies 
    ORDER BY id DESC 
    LIMIT 6
");
while ($row = $res->fetch_assoc()) {
    $cases[] = $row;
}

/* ===== BLOGS ===== */
$blogs = [];
$res = $conn->query("
    SELECT blogs_title, slug 
    FROM blogs_content 
    ORDER BY id DESC 
    LIMIT 6
");
while ($row = $res->fetch_assoc()) {
    $blogs[] = $row;
}
?>


<?php
require_once "Admin/config/db.php";

$industries = [];
$res = $conn->query("SELECT id, serve_title FROM industries_serve ORDER BY id ASC");
while ($row = $res->fetch_assoc()) {
    $industries[] = $row;
}
?>

<header id="header-sticky" class="header-1">
  <div class="container-fluid">
    <div class="mega-menu-wrapper">
      <div class="header-main">
        
        <!-- Logo -->
        <div class="logo">
          <a href="index" class="header-logo">
            <img src="assets/img/Untitled-1.png" alt="logo-img">
          </a>
          <a href="index" class="header-logo-2">
            <img src="assets/img/logo/logo-hiskytech.png" alt="logo-img">
          </a>
        </div>

        <!-- Menu -->
        <div class="mean__menu-wrapper">
          <div class="main-menu">
            <nav id="mobile-menu">
              <ul>
                
         <li class="has-dropdown">
  <a href="javascript:void(0)">What We Do <i class="fa-solid fa-chevron-down"></i></a>

  <ul class="submenu has-homemenu">
    <li class="mega-wrapper">
      <div class="mega-grid">

        <!-- ===== LEFT: SERVICES ===== -->
        <div class="mega-section">
          <h4>Our Services</h4>
          <ul>
            <?php foreach ($services as $service): ?>
              <li>
                <a href="service/<?= htmlspecialchars($service['slug']) ?>">
                  <?= htmlspecialchars($service['service_title2']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- ===== CASE STUDIES ===== -->
        <div class="mega-section">
          <h4>Case Studies</h4>
          <ul>
            <?php foreach ($cases as $case): ?>
              <li>
                <a href="case-study/<?= htmlspecialchars($case['slug']) ?>">
                  <?= htmlspecialchars($case['case_study_title']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- ===== BLOGS ===== -->
        <div class="mega-section">
          <h4>Insights & Blogs</h4>
          <ul>
            <?php foreach ($blogs as $blog): ?>
              <li>
                <a href="news-details/<?= htmlspecialchars($blog['slug']) ?>">
                  <?= htmlspecialchars($blog['blogs_title']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>
    </li>
  </ul>
</li>
   <li class="has-dropdown">
                  <a href="news.php">Who We Are <i class="fa-solid fa-chevron-down"></i></a>
                  <ul class="submenu has-homemenu">
                    <li class="mega-wrapper">
             
                      <div class="mega-grid">
                        <div class="mega-section">
                     
                         <ul>

  <li><a href="#services" class="scroll-link">Service</a></li>
  <li><a href="#industries" class="scroll-link">Industries</a></li>
  <li><a href="#contact" class="scroll-link">Contact</a></li>
  <li><a href="#case-studies" class="scroll-link">Case Studies</a></li>
  <li><a href="#team" class="scroll-link">Our Team</a></li>
  <li><a href="#achievements" class="scroll-link">Our Achievements</a></li>
</ul>

                        </div>
                   
                   
                      </div>
                    </li>
                  </ul>
                </li>



<li class="has-dropdown">
  <a href="javascript:void(0)">Who We Help <i class="fa-solid fa-chevron-down"></i></a>

  <ul class="submenu has-homemenu">
    <li class="mega-wrapper">
      <div class="mega-grid">

        <div class="mega-section">
          <h4>Industries</h4>
          <ul>
            <?php foreach ($industries as $industry): ?>
              <li>
                <a href="#industries"
                   class="industry-link"
                   data-id="<?= $industry['id'] ?>">
                  <?= htmlspecialchars($industry['serve_title']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>
    </li>
  </ul>
</li>


                <!-- Other main menu items -->
             <!-- Who We Help -->
             
                  <!-- Who We Help -->
                <li class="has-dropdown">
                  <a href="news.php">Who We Deliver <i class="fa-solid fa-chevron-down"></i></a>
                  <ul class="submenu has-homemenu">
                    <li class="mega-wrapper">
             
                      <div class="mega-grid">
                        <div class="mega-section">
                  
                          <ul>
                            <li><a href="portfolios">Blog</a></li>
                   <li><a href="#case-studies" class="scroll-link">Case Studies</a></li>
                            <li><a href="portfolios">News</a></li>
                     
                          </ul>
                        </div>
                   
                   
                      </div>
                    </li>
                  </ul>
                </li>
              <!-- Who We Help -->
                <li class="has-dropdown">
                  <a href="contact">Join HiSkyTech </a>
               
                </li>

              </ul>
            </nav>
          </div>
        </div>

     <!-- Right side buttons + hamburger -->
<div class="header-right d-flex justify-content-center align-items-center gap-3">
<!-- Explore Careers: visible only lg and up -->
<div class="single-btn d-none d-lg-block" data-wow-delay=".3s">
  <a href="" class="explore-careers d-flex align-items-center gap-2 px-3 py-2 text-decoration-none">
    <span class="theme-btn">Explore Careers</span>
  </a>
</div>

<!-- Let's Talk Business: visible only lg and up -->
<div class="single-btn d-none d-lg-block" data-wow-delay=".3s">
  <a href="contact" class="lets-talk d-flex align-items-center gap-2 px-3 py-2 text-decoration-none">
    <span class="theme-btn">Let's Talk Business</span>
  </a>
</div>





  <!-- Hamburger -->
  <div class="header__hamburger d-xl-none my-auto">
    <div class="sidebar__toggle">
      <i class="fas fa-bars"></i>
    </div>
  </div>

</div>


      </div>
    </div>
  </div>
</header>
<style>


</style>


