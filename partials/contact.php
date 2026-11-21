
<!-- Contact Section Start -->
<section class="contact-section-33 fix section-padding pt-0 mt-5 service-section">
  <div class="container">
    <div class="contact-wrapper-2">
      <div class="row g-4 align-items-center">

        <!-- LEFT SIDE (FORM – NO CHANGES INSIDE) -->
        <div class="col-lg-6">
          <div class="contact-content">
            <div class="d-flex justify-content-center pe-3">
              <h2 style="color: #1b4797;">Get In Touch</h2>
            </div>
<form id="contact-form-main" action="Admin/contact-submit.php" method="POST" class="contact-form-items mt-5 ajax-contact-form">
  <div class="row g-3">
    <input type="hidden" name="redirect_to" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
    <!-- Name -->
    <div class="col-12">
      <div class="form-clt">
        <span>Your Name*</span>
        <input type="text" name="name" placeholder="Your Name" required minlength="3">
      </div>
    </div>

    <!-- Email -->
    <div class="col-12">
      <div class="form-clt">
        <span>Your Email*</span>
        <input type="email" name="email" placeholder="Your Email" required>
      </div>
    </div>

    <!-- Company Name -->
    <div class="col-12">
      <div class="form-clt">
        <span>Company Name*</span>
        <input type="text" name="company_name" placeholder="Company Name" required>
      </div>
    </div>

    <!-- Company URL -->
    <div class="col-12">
      <div class="form-clt">
        <span>Company URL</span>
        <input type="url" name="company_url" placeholder="https://example.com">
      </div>
    </div>

    <!-- PHONE (FIXED GRID ISSUE) -->
    <div class="col-12">
      <div class="custom-phone-dropdown">
        <div class="selected"></div>

        <ul class="dropdown-options">
          <li data-code="+92">Pakistan +92</li>
          <li data-code="+1">USA +1</li>
          <li data-code="+44">UK +44</li>
          <li data-code="+91">India +91</li>
        </ul>

        <input type="tel" name="phone" placeholder="3001234567" required>
      </div>
    </div>

    <!-- Region -->
    <div class="col-12">
      <div class="custom-select-wrapper">
        <span>Region*</span>
        <div class="custom-select">
          <div class="selected-option">Select Region</div>
          <ul class="options">
            <li data-value="north_america">North America</li>
            <li data-value="europe">Europe</li>
            <li data-value="asia">Asia</li>
            <li data-value="middle_east">Middle East</li>
            <li data-value="africa">Africa</li>
            <li data-value="other">Other</li>
          </ul>
          <input type="hidden" name="region" required>
        </div>
      </div>
    </div>

 <!-- Services checkboxes -->
<div class="col-12">
  <div class="form-clt">
    <span>Services you are looking for*</span>
    <div class="d-flex flex-column" id="services-wrapper">
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Remote IT Resources" required>
        <span class="checkmark"></span>
        <span class="label-text">Remote IT Resources</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Custom Software Development">
        <span class="checkmark"></span>
        <span class="label-text">Other IT Services</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Web Development">
        <span class="checkmark"></span>
        <span class="label-text">Web Development</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Mobile App Development">
        <span class="checkmark"></span>
        <span class="label-text">App Development</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="AR/VR">
        <span class="checkmark"></span>
        <span class="label-text">AR/VR</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Gaming">
        <span class="checkmark"></span>
        <span class="label-text">Gaming</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Cyber Security">
        <span class="checkmark"></span>
        <span class="label-text">Cyber Security</span>
      </label>
      <label class="custom-checkbox">
        <input type="checkbox" name="services[]" value="Other IT Services">
        <span class="checkmark"></span>
        <span class="label-text">Software Development</span>
      </label>
    </div>
  </div>
</div>



    <!-- Project Details -->
    <div class="col-12">
      <div class="form-clt">
        <span>Project Details*</span>
        <textarea name="project_details" placeholder="Write your project details" required minlength="10"></textarea>
      </div>
    </div>

    <!-- Job -->
    <div class="col-12">
      <div class="job-dropdown-wrapper">
        <span>Are you looking for a job?</span>
        <div class="job-dropdown">
          <div class="job-selected">Select</div>
          <ul class="job-options">
            <li data-value="Yes">Yes</li>
            <li data-value="No">No</li>
          </ul>
          <input type="hidden" name="looking_job" required>
        </div>
      </div>
    </div>
 <div id="form-messages"></div>
    <!-- Submit (FIXED) -->
    <div class="col-12">
     <button type="submit"
  style="
    background:#274d90;
    color:#fff;
    border:none;
    padding:12px 28px;
    font-weight:600;
    border-radius:6px;
    cursor:pointer;
    transition:all .3s ease;"
  onmouseover="this.style.background='#3b6fd1'"
  onmouseout="this.style.background='#274d90'">
  Submit
</button>

    </div>

  </div>
</form>


          
          </div>
        </div>

<!-- RIGHT SIDE (INFO BOXES) -->
<div class="col-lg-4 ms-auto">
  <div class="contact-details">

    <!-- Item 1 -->
    <div class="contact-detail-box wow fadeInUp" data-wow-delay="0s">
      <div class="contact-detail-icon">
        <i class="fa-solid fa-globe"></i>
      </div>
      <div class="contact-detail-text">
        <h5>Global Reach</h5>
        <p>
          We collaborate with clients worldwide, delivering solutions that scale across regions and industries.
        </p>
        <a href="Maintenance" class="contact-learn-btn">
          Learn More <i class="fa-solid fa-arrow-right-long"></i>
        </a>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="contact-detail-box wow fadeInUp" data-wow-delay="0.2s">
      <div class="contact-detail-icon">
        <i class="fa-solid fa-network-wired"></i>
      </div>
      <div class="contact-detail-text">
        <h5>Global Presence</h5>
        <p>
          Our team operates in multiple countries, ensuring local expertise with international standards.
        </p>
        <a href="Maintenance" class="contact-learn-btn">
          Learn More <i class="fa-solid fa-arrow-right-long"></i>
        </a>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="contact-detail-box wow fadeInUp" data-wow-delay="0.4s">
      <div class="contact-detail-icon">
        <i class="fa-solid fa-handshake-angle"></i>
      </div>
      <div class="contact-detail-text">
        <h5>Trusted Partnerships</h5>
        <p>
          We build long-term relationships, helping businesses grow with reliable technology solutions.
        </p>
        <a href="Maintenance" class="contact-learn-btn">
          Learn More <i class="fa-solid fa-arrow-right-long"></i>
        </a>
      </div>
    </div>

  </div>
</div>





      </div>
    </div>
  </div>
</section>

