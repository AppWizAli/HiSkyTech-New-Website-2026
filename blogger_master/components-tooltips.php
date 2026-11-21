<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-login.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li> 

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="fas fa-tachometer-alt"></i> <!-- Dashboard icon -->
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <!-- Graphic Design/Blogs -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#latest-news-nav" data-bs-toggle="collapse" href="#">
        <i class="fas fa-newspaper"></i> <!-- Latest News icon -->
        <span>Graphic/Blogs</span><i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul id="latest-news-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="components-tabs.php">
            <i class="fas fa-eye"></i><span>Show Blogs</span> <!-- Show Blogs icon -->
          </a>
        </li>
        <li>
          <a href="components-tooltips.php">
            <i class="fas fa-pencil-alt"></i><span>Add Blogs</span> <!-- Add Blogs icon -->
          </a>
        </li>
      </ul>
    </li><!-- End Graphic/Blogs Nav -->

    <!-- Android Blogs -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#travel-section-nav" data-bs-toggle="collapse" href="#">
        <i class="fas fa-mobile-alt"></i> <!-- Android/Blogs icon -->
        <span>Android/Blogs</span><i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul id="travel-section-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="forms-editors.php">
            <i class="fas fa-eye"></i><span>Show Blogs</span> <!-- Show Blogs icon -->
          </a>
        </li>
        <li>
          <a href="forms-validation.php">
            <i class="fas fa-pencil-alt"></i><span>Add Blogs</span> <!-- Add Blogs icon -->
          </a>
        </li>
        <!-- <li>
          <a href="components-update1.php">
            <i class="fas fa-pencil-alt"></i><span>Update Blog</span> 
          </a>
        </li> -->
      </ul>
    </li><!-- End Android Blogs Nav -->

    <!-- Web Blogs -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#fashion-news-nav" data-bs-toggle="collapse" href="#">
        <i class="fas fa-laptop-code"></i> <!-- Web Development/Blogs icon -->
        <span>Web/Blogs</span><i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul id="fashion-news-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="tables-general.php">
            <i class="fas fa-eye"></i><span>Show Blogs</span> <!-- Show Blogs icon -->
          </a>
        </li>
        <li>
          <a href="tables-data.php">
            <i class="fas fa-pencil-alt"></i><span>Add Blogs</span> <!-- Add Blogs icon -->
          </a>
        </li>
        <!-- <li>
          <a href="components-update2.php">
            <i class="fas fa-pencil-alt"></i><span>Update Blog</span> 
          </a>
        </li> -->
      </ul>
    </li><!-- End Web Blogs Nav -->

    <!-- Blogs Teams -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#blogs-teams-nav" data-bs-toggle="collapse" href="#">
        <i class="fas fa-users"></i> <!-- Blogs Teams icon -->
        <span>Blogs Teams</span><i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul id="blogs-teams-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="charts-chartjs.php">
            <i class="fas fa-eye"></i><span>Show Blogs</span> <!-- Show Blogs icon -->
          </a>
        </li>
        <li>
          <a href="charts-apexcharts.php">
            <i class="fas fa-plus-circle"></i><span>Add Blogs</span> <!-- Add Blogs icon -->
          </a>
        </li>
        <!-- <li>
          <a href="charts-echarts.php">
            <i class="fas fa-edit"></i><span>Update Blogs</span> 
          </a>
        </li> -->
      </ul>
    </li><!-- End Blogs Teams Nav -->

    <!-- Register -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-register.php">
        <i class="fas fa-user-plus"></i> <!-- Register icon -->
        <span>Register</span>
      </a>
    </li><!-- End Register Page Nav -->

    <!-- Login -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.php">
        <i class="fas fa-sign-in-alt"></i> <!-- Login icon -->
        <span>Login</span>
      </a>
    </li><!-- End Login Page Nav -->

  </ul>
</aside><!-- End Sidebar -->

  <main id="main" class="main">

    <div class="pagetitle">
    <h1>Graphic/Blogs-Insert</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Blog Post</title>
    <!-- CKEditor 4 CDN -->
    <script src="https://cdn.ckeditor.com/4.20.0/full-all/ckeditor.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create a Blog Post</h2>
    <form action="news-submitform.php" method="post" enctype="multipart/form-data">
        <label for="title">Blog Title</label>
        <input type="text" name="title" id="title" required>

        <label for="image1">Upload Image 1</label>
        <input type="file" name="image1" required>

        <label for="image2">Upload Image 2</label>
        <input type="file" name="image2">

        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>

        <label for="blog_content">Blog Content</label>
        <textarea name="blog_content" id="blog_content" required></textarea>

        <button type="submit" name="submit">Submit Blog</button>
        
    </form>
</div>

<script>
    // Initialize CKEditor for blog content
    CKEDITOR.replace('blog_content', {
        extraPlugins: 'image2',
        height: 300
    });
</script>

</body>
</html>

          

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>