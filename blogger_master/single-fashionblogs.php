<?php
include("config.php");

$post = null; // Initialize the $post variable to null

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $stmt = $conn->prepare("SELECT * FROM fashion_blogs WHERE slug = ?");

    // Check if the statement prepared successfully
    if ($stmt) {
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $post = $result->fetch_assoc(); // Fetch the post if it exists
        } 
        // No need for else block; $post will remain null if no post is found

        $stmt->close();
    } else {
        echo "<p>Error preparing statement.</p>";
        exit; // Exit if the statement preparation fails
    }
} else {
    echo "<p>No slug provided.</p>";
    exit; // Exit if no slug is provided
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="UTF-8">
    <title><?php echo $post ? htmlspecialchars($post['title']) : "Blogger"; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="blog.css">
     
		</head>
		<body>

			<!-- Start Header Area -->
			<header class="default-header">
				<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						  <a class="navbar-brand w-25" href="index.html">
						  	<img src="img/HiSkyTech Png_LOGO-Horizantal-02.png" alt="">
						  </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#news">Graphics</a></li>
                        <li><a href="#travel">Android</a></li>
                        <li><a href="#fashion">Web</a></li>
                        <li><a href="#team">Team</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="category.php">Android/Blogs</a>
                                <a class="dropdown-item" href="archive.php">Graphic/Blogs</a>
                                <a class="dropdown-item" href="generic.php">Web/Blogs</a>
                            </div>
                        </li>								
                    </ul>
                </div>						
            </div>
        </nav>
    </header>
    <!-- End Header Area -->

    <!-- Start top-section Area -->
    <section class="top-section-area section-gap">
        <div class="container">
            <div class="row justify-content-between align-items-center d-flex">
                <div class="col-lg-8 top-left">
                    <h1 class="text-white mb-20">Post Details</h1>
                    <ul>
                        <li><a href="index.html">Home</a><span class="lnr lnr-arrow-right"></span></li>
                        <li><a href="category.html">Category</a><span class="lnr lnr-arrow-right"></span></li>
                        <li><a href="single.html">Fashion</a></li>
                    </ul>
                </div>
            </div>
        </div>  
    </section>
    <!-- End top-section Area -->

    <!-- Start post Area -->
    <div class="post-wrapper pt-100">
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="single-page-post">
                        <?php if ($post): ?>
                            <img class="img-fluid" src="<?php echo htmlspecialchars($post['image2']); ?>" alt="Blog Image">

                            <div class="top-wrapper">
                                <div class="row d-flex justify-content-between">
                                    <h2 class="col-lg-8 col-md-12 text-uppercase">
                                        <a href="?slug=<?php echo urlencode($post['slug']); ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h2>
                                    <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                        <!-- Optional additional info can be placed here -->
                                    </div>
                                </div>
                            </div>
                            <div class="single-post-content">
                                <p><?php echo htmlspecialchars_decode($post['blog_content']); ?></p>
                            </div>
                        <?php else: ?>
                            <p>No post available to display.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    <!-- End post Area -->

    <!-- Start Footer Area -->      
    <footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-3  col-md-12">
							<div class="single-footer-widget">
								<h6>Top Blogs </h6>
								<ul class="footer-nav">
									<li><a href="#">Grapic Designer</a></li>
									<li><a href="#">Android Developer</a></li>
									<li><a href="#">Web development</a></li>
									<li><a href="#">Blogs Pages</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6  col-md-12">
							<div class="single-footer-widget newsletter">
								<h6>Newsletter</h6>
								<p>You can trust us. we only send promo offers, not a single spam.</p>
								<div id="mc_embed_signup">
								<form action="submit.php" method="POST">
        <div class="form-group row" style="width: 100%;">
            <div class="col-lg-8 col-md-12">
                <input id="email" name="email" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required type="email">
                <div style="position: absolute; left: -5000px;">
                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                </div>
            </div> 
            
            <div class="col-lg-4 col-md-12">
                <button class="nw-btn primary-btn" type="submit">Subscribe<span class="lnr lnr-arrow-right"></span></button>
            </div>  
        </div>
    </form>
								</div>		
							</div>
						</div>
						<!-- <div class="col-lg-3  col-md-12">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">Instragram Feed</h6>
								<ul class="instafeed d-flex flex-wrap">
									<li><img src="img/i1.jpg" alt=""></li>
									<li><img src="img/i2.jpg" alt=""></li>
									<li><img src="img/i3.jpg" alt=""></li>
									<li><img src="img/i4.jpg" alt=""></li>
									<li><img src="img/i5.jpg" alt=""></li>
									<li><img src="img/i6.jpg" alt=""></li>
									<li><img src="img/i7.jpg" alt=""></li>
									<li><img src="img/i8.jpg" alt=""></li>
								</ul>
							</div>
						</div>						
					</div> -->

					<div class="row footer-bottom d-flex justify-content-between">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<p class="col-lg-8 col-sm-12 footer-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Blogging Website is made by <a href="https://colorlib.com" target="_blank">Raheel</a></p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<div class="col-lg-4 col-sm-12 footer-social">
							<a href="https://www.facebook.com/profile.php?id=100092395756725&mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>
							<a href="https://github.com/AppWizAli" target="_blank" aria-label="GitHub"><i class="fa fa-github"></i></a>
                            <a href="https://www.instagram.com/alihamx_a?igsh=YmUwZjBwanUyZjFk" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/ali-hamza-7b3762252?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- End footer Area -->		
    <!-- End Footer Area -->
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/parallax.min.js"></script>			
			<script src="js/owl.carousel.min.js"></script>		
			<script src="js/jquery.magnific-popup.min.js"></script>				
			<script src="js/jquery.sticky.js"></script>
			<script src="js/main.js"></script>
			<script type="text/javascript" src="slick/slick.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> 
</body>
</html>
