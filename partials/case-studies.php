
<?php
include "Admin/config/db.php";

/* ================= CASE STUDIES ================= */
$caseRes = mysqli_query($conn, "SELECT * FROM case_studies ORDER BY id DESC LIMIT 5");
$caseStudies = [];

while ($row = mysqli_fetch_assoc($caseRes)) {

    // Image handling (same logic)
    if (!empty($row['case_study_image'])) {
        $images = json_decode($row['case_study_image'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($images)) {
            $row['case_study_image'] = $images[0] ?? '';
        }
    }

    $caseStudies[] = $row;
}

/* ================= BLOGS ================= */
$stmt = $conn->prepare("SELECT * FROM blogs_content ORDER BY id DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$blogs = [];

while ($row = $result->fetch_assoc()) {

    // Image handling (same logic)
    if (!empty($row['blogs_image'])) {
        $images = json_decode($row['blogs_image'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($images)) {
            $row['blogs_image'] = $images[0] ?? '';
        }
    }

    $blogs[] = $row;
}
$stmt->close();
?>

<section class="insights-section py-4 py-md-5 mt-5 service-section">
  <div class="container-xl">
    <div class="row align-items-start gy-4 gy-lg-0">

      <!-- LEFT CONTENT -->
      <div class="col-lg-6 d-flex flex-column align-items-start text-start mt-3 mt-md-4 mt-lg-5 mt-xl-5 mt-xxl-4">
        <span class="section-tag wow fadeInUp mb-2 mb-md-3" data-wow-delay="0.1s">Project Related</span>

        <h2 class="section-title wow fadeInUp mb-3 mb-lg-4" data-wow-delay="0.2s">
          Best Case <span>Studies</span>
        </h2>

        <p class="section-subtitle1 wow fadeInUp mb-3 mb-md-4" data-wow-delay="0.3s">
          From Concept to Completion, our projects reflect creativity, precision, and a commitment to delivering results that exceed expectations.
        </p>

        <p class="section-subtitle1 extra wow fadeInUp mb-4 mb-lg-5" data-wow-delay="0.4s">
          Each case study showcases not just our technical expertise but also our deep understanding of client needs, strategic problem-solving, and the transformative impact our solutions have on businesses and communities alike.
        </p>

        <div class="main-button-updated wow fadeInUp mt-2 mt-md-3 mt-lg-4 text-lowercase" data-wow-delay="0.5s">
          <a href="news-grid"><span class="theme-btn-updated">Explore More</span></a>
        </div>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="col-lg-6">
        <div class="insight-grid">

          <!-- CASE STUDY COLUMN -->
          <div class="insight-column">
            <?php foreach ($caseStudies as $case): ?>

              <?php
              $caseImage = $case['case_study_image'] ?: 'assets/img/placeholder.jpg';
              ?>

              <div class="insight-card card-lg wow fadeInUp"
                   data-wow-delay="0.1s"
                   data-link="case-study/<?= htmlspecialchars($case['slug']) ?>"
                   style="background-image:url('Admin/uploads/<?= htmlspecialchars($caseImage) ?>')">

                <span class="card-badge">Case Study</span>
                <h6><?= htmlspecialchars($case['case_study_title']) ?></h6>

              </div>

            <?php endforeach; ?>
          </div>

          <!-- BLOGS COLUMN -->
          <div class="insight-column">
            <?php for ($i = 0; $i <= 3; $i++): ?>
              <?php if (isset($blogs[$i])): ?>

                <div class="insight-card card-md wow fadeInUp"
                     data-wow-delay="<?= 0.2 + $i * 0.1 ?>s"
                     data-link="news-details/<?= htmlspecialchars($blogs[$i]['slug']) ?>"
                     style="background-image:url('Admin/uploads/<?= htmlspecialchars($blogs[$i]['blogs_image']) ?>')">

                  <span class="card-badge">Blog</span>
                  <h6><?= htmlspecialchars($blogs[$i]['blogs_title']) ?></h6>

                </div>

              <?php endif; ?>
            <?php endfor; ?>
          </div>

        </div>
      </div>

    </div>
  </div>
  <section id="team"></section>
</section>