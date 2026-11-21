<?php
require_once __DIR__ . '/../Admin/config/db.php';
require_once __DIR__ . '/../config.php';

/* ==============================
   GET SLUG & TYPE
================================ */
$slug = $_GET['slug'] ?? '';
$type = $_GET['type'] ?? '';

/* ==============================
   DEFAULT HERO
================================ */
$hero = [
    'title'       => 'Default Title',
    'description' => 'Short description goes here...',
    'image'       => BASE_URL . 'assets/img/about/placeholder.jpg',
    'link'        => '#'
];

/* ==============================
   TABLE MAP (UPDATED)
================================ */
$map = [

    'service' => [
        'table' => 'services',
        'slug'  => 'slug',
        'title' => 'service_title2',
        'desc'  => 'service_description_2',
        'image' => 'service_image',
        'path'  => 'Admin/uploads/services/',
        'page'  => 'mobile-development'
    ],

    'blog' => [
        'table' => 'blogs_content',
        'slug'  => 'slug',
        'title' => 'blogs_title',
        'desc'  => 'blogs_description',
        'image' => 'blogs_image',
        'path'  => 'Admin/uploads/',
        'page'  => 'news-details'
    ],

    'case' => [
        'table' => 'case_studies',
        'slug'  => 'slug',
        'title' => 'case_study_title',
        'desc'  => 'case_study_description',
        'image' => 'case_study_image',
        'path'  => 'Admin/uploads/',
        'page'  => 'case-study'
    ],

    // ✅ NEW PORTFOLIO SUPPORT
    'portfolio' => [
        'table' => 'portfolio',
        'slug'  => 'slug',
        'title' => 'portfolio_title',
        'desc'  => 'portfolio_description',
        'image' => 'portfolio_image',
        'path'  => 'Admin/uploads/',
        'page'  => 'portfolio'
    ]
];

/* ==============================
   AUTO TYPE DETECT (SEO SAFE)
================================ */
if (!$type) {
    $uri = $_SERVER['REQUEST_URI'];

    if (str_contains($uri, 'service')) {
        $type = 'service';

    } elseif (str_contains($uri, 'case-study')) {
        $type = 'case';

    } elseif (str_contains($uri, 'portfolio')) {   // ✅ ADDED
        $type = 'portfolio';

    } else {
        $type = 'blog';
    }
}

if (!isset($map[$type]) || !$slug) {
    return;
}

$t = $map[$type];

/* ==============================
   FETCH BY SLUG
================================ */
$stmt = $conn->prepare(
    "SELECT * FROM {$t['table']} WHERE {$t['slug']} = ? LIMIT 1"
);

$stmt->bind_param("s", $slug);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();

/* ==============================
   PROCESS DATA
================================ */
if ($row) {

    // IMAGE HANDLING
    if ($type === 'service') {
        $file = trim($row['service_image']);
    } else {
        $img  = json_decode($row[$t['image']], true);
        $file = is_array($img) ? ($img[0] ?? '') : $row[$t['image']];
    }

    if (!empty($file)) {
        $hero['image'] = BASE_URL . $t['path'] . $file;
    }

    // TITLE & DESCRIPTION
    $hero['title'] = $row[$t['title']];
    $hero['description'] = substr(strip_tags($row[$t['desc']]), 0, 50) . '...';

    // LINK
    $hero['link'] = BASE_URL . $t['page'] . '/' . $slug;
}
?>

<!-- Hero Section -->
<section class="hero-section hero-2 position-relative overflow-hidden">
  <img src="<?= htmlspecialchars($hero['image']) ?>" 
       alt="<?= htmlspecialchars($hero['title']) ?>" 
       class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">

  <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

  <div class="container-fluid position-relative d-flex flex-column justify-content-between" style="min-height: 70vh; z-index: 2;">
    <div class="row flex-grow-1"></div>

    <div class="row">
      <div class="col-12 d-flex justify-content-start">
        <div class="hero-bottom-content animate-on-scroll">
          <h3 class="text-white mb-2"><?= htmlspecialchars($hero['title']) ?></h3>
          <h2 class="text-white fw-bold mb-3"><?= htmlspecialchars($hero['description']) ?></h2>
        </div>
      </div>
    </div>
  </div>
</section>



<script>

document.addEventListener("DOMContentLoaded", function() {
  const elements = document.querySelectorAll('.animate-on-scroll');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active'); // trigger animation
        observer.unobserve(entry.target); // optional: only animate once
      }
    });
  }, {
    threshold: 0.3 // triggers when 30% of element is visible
  });

  elements.forEach(el => observer.observe(el));
});
</script>

<style>
/* Hero Section */
.hero-section {
  position: relative;
  overflow: hidden;
  min-height: 70vh;
}
/* Initial state before scroll */
.animate-on-scroll {
  opacity: 0;
  transform: translateY(50px) scale(0.95);
  transition: all 0.8s ease-out;
}

/* Active state when in viewport */
.animate-on-scroll.active {
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* Background Image */
.hero-section img {
  object-fit: cover;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}

/* Overlay */
.hero-overlay {
  background: rgba(0,0,0,0.4);
  z-index: 1;
}

/* Top content headings */
.hero-category {
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 16px;
}

.hero-section h1 {
  color: #fff;
  font-size: clamp(32px, 5vw, 60px);
  line-height: 1.2;
}

.hero-section p {
  color: #fff;
  font-size: 16px;
  line-height: 1.6;
}

/* Buttons */
.hero-btn {
  color: #fff;
  background: #274d90;
  border: 2px solid #274d90;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.hero-btn:hover {
  background: #fff;
  color: #274d90;
}
/* Bottom content full width with frosted glass blur */
.hero-bottom-content {
  width: 100%; /* full width of parent/container */
  background: rgba(0, 0, 0, 0.2); /* transparent black */
  backdrop-filter: blur(7px); /* strong blur effect */

  padding: 4.5rem 2rem; /* spacing around content */
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  border-radius: 0; /* full-width, no rounded corners */
  box-sizing: border-box;
  color: #fff; /* text color */
}



.hero-bottom-content h3 {
  font-size: 20px;
  margin-bottom: 0.5rem;
}

.hero-bottom-content h2 {
  font-size: 35px;
  margin-bottom: 1rem;
}

.hero-bottom-content .theme-btn {
  background: #fff;
  color: #274d90;
  border: 2px solid #274d90;
}

.hero-bottom-content .theme-btn:hover {
  background: #274d90;
  color: #fff;
}

/* Responsive */
@media (max-width: 991px) {
  .hero-bottom-content h2 {
    font-size: 28px;
  }
  .hero-bottom-content h3 {
    font-size: 18px;
  }
}

@media (max-width: 575px) {
  .hero-section {
    min-height: 60vh;
  }
  .hero-section h1 {
    font-size: 28px;
  }
  .hero-bottom-content h2 {
    font-size: 22px;
  }
  .hero-bottom-content h3 {
    font-size: 16px;
  }
}
</style>
