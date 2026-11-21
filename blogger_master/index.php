<?php
	include("config.php");
	
	$sql = "SELECT * FROM blogs";
	$result = $conn->query($sql);

	
	?>
	<?php
include("config.php"); // Make sure your database connection is included

// Fetch blogs from the blogs_travel table
$sql = "SELECT * FROM blogs_travel"; // Updated table name
$result1 = $conn->query($sql);

if ($result1 === false) {
    die("SQL query failed: " . $conn->error);
}

?>
	<?php
include("config.php"); // Include your database connection file

// Fetch blog posts from the database
$sql = "SELECT * FROM fashion_blogs"; // Fetch all fields from fashion_blogs
$result2 = $conn->query($sql);

// Check if the query was successful
if ($result2 === false) {
    die("Error in query: " . $conn->error);
}
	
	?>
	
	
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Blogger</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
			<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
               
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
 <style>
	
.single-fashion img{
    width: 100% ;
    height: 140px;
 }
 .single-travel img{
	width: 54% ;
    height: 140px;
 }
 .single-cat img{
	width: 54% ;
    height: 140px;
 }
 
 .navbar-brand img{
	width: 80%;
	
	margin-top: -40px;
	
 }
 .navbar-brand {
	height: 50px;
 }
  .navbar-expand-lg{
	height: auto;
  }

  @media only screen and (max-width: 360px) {
    .navbar-brand img{
        width: 200%;
        margin-top: -40px;
    }

	.single-travel img{
	width: 100% ;
    height: 200px;
 }
}
 </style>
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
								<li><a href="#team">team</a></li>
								<!-- Dropdown -->
							    <li class="dropdown">
							      <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
							        Pages
							      </a>
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

			<!-- start banner Area -->
			<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="img/header-bg.jpg">
				<div class="overlay-bg overlay"></div>
				<div class="container">
					<div class="row fullscreen">
					<div class="banner-content d-flex align-items-center col-lg-12 col-md-12 wow animate__animated animate__slideInDown" data-wow-duration="" data-wow-delay="">
    <h1>
        Mastering Code <br>
        Is More Important Than Ever.
    </h1>
</div>

						<div class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12">
							<!-- <div class="col-lg-6 flex-row d-flex meta-left no-padding">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div> -->
							<div class="col-lg-6 flex-row d-flex meta-right no-padding justify-content-end">
								<!-- <div class="user-meta">
									<h4 class="text-white">Mark wiens</h4>
									<p>12 Dec, 2017 11:21 am</p>
								</div> -->
								<!-- <img class="img-fluid user-img" src="img/user.jpg" alt=""> -->
							</div>
						</div>												
					</div>
				</div>
			</section>
			<!-- End banner Area -->	


			<!-- Start category Area -->
			<section class="category-area section-gap" id="news">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
						<div class="title text-center wow animate__animated animate__slideInDown" data-wow-duration="1s" data-wow-delay="">
  <h1 class="mb-10">Latest Blogs from Graphic Design</h1>
  <p>Stay updated with the newest trends, tools, and techniques in the world of graphic design. From typography and branding to digital illustrations and UI/UX design, explore everything a modern graphic designer needs to thrive in a creative industry.</p>
</div>

						</div>
					</div>		
					<div class="active-cat-carusel">
					<?php     
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <div class="item single-cat">
                <img src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">

                <p class="date"><?php echo date('d M Y', strtotime($row['created_at'])); ?></p>
                <h4>
                    <a href="single-blog.php?slug=<?php echo htmlspecialchars($row['slug']); ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                </h4>
            </div>
        <?php }
    } else {
        echo "<p>No blog posts available.</p>";
    } ?>
</div>

					</div>
												
				</div>	
			</section>
			<!-- End category Area -->
			
			<!-- Start travel Area -->
			<section class="travel-area section-gap" id="travel">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
						<div class="title text-center wow animate__animated animate__slideInDown" data-wow-duration="1s" data-wow-delay="">
  <h1 class="mb-10">Hot Topics from Android Section</h1>
  <p>Explore the latest trends in Android development, from cutting-edge app design techniques to updates in mobile OS features, helping you stay ahead in the fast-paced world of mobile technology.</p>
</div>

						</div>
					</div>						
					 <!-- <div class="row">
						<div class="col-lg-6 travel-left">
							<div class="single-travel media pb-70">
							  <img class="img-fluid d-flex  mr-3" src="img/t1.jpg" alt="">
							 
							  <div class="media-body align-self-center">
							    <h4 class="mt-0"><a href="single-blog.php">Addiction When Gambling
							    Becomes A Problem</a></h4>
							    <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
													 
							  </div>
							</div>
							<div class="single-travel media">
							  <img class="img-fluid d-flex  mr-3" src="img/t3.jpg" alt="">
							  						  
							  <div class="media-body align-self-center">
							    <h4 class="mt-0"><a href="single-blog.php">Addiction When Gambling
							    Becomes A Problem</a></h4>
							    <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
													 
							  </div>
							</div>														
						</div>
						<div class="col-lg-6 travel-right">
							<div class="single-travel media pb-70">
							  <img class="img-fluid d-flex  mr-3" src="img/t2.jpg" alt="">
							 
							  <div class="media-body align-self-center">
							    <h4 class="mt-0"><a href="single-blog.php">Addiction When Gambling
							    Becomes A Problem</a></h4>
							    <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
														 
							  </div>
							</div>
							<div class="single-travel media">
							  <img class="img-fluid d-flex  mr-3" src="img/t4.jpg" alt="">
							 						  
							  <div class="media-body align-self-center">
							    <h4 class="mt-0"><a href="single-blog.php">Addiction When Gambling
							    Becomes A Problem</a></h4>
							    <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
														 
							  </div>
							</div>								
						</div>
						<a href="single-blog.php" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>		
					</div>  -->
					<!-- Android Blog Section -->
<div id="android-blog-section" class="row blog-section">
<?php
    // Initialize the counter
    $counter = 0;
    $totalDisplayed = 4; // Limit to display only 4 posts initially
    while ($row = $result1->fetch_assoc()):
        // Calculate delay based on counter (e.g., 0.2s increments)
        $delay = ($counter * 0.2) . 's';

        // Choose the animation direction
        $animationClass = ($counter % 2 == 0) ? 'animate__slideInLeft' : 'animate__slideInRight';
        
        if ($counter < $totalDisplayed): ?>
            <!-- Visible posts -->
            <div class="col-lg-6 col-md-12 blog-post wow animate__animated <?php echo $animationClass; ?>" data-wow-delay="<?php echo $delay; ?>" style="display: block;">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex mr-3" src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="">
                    <div class="media-body align-self-center">
                        <h4 class="mt-0">
                            <a href="single-blogs.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </a>
                        </h4>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Hidden posts initially -->
            <div class="col-lg-6 col-md-12 blog-post wow animate__animated <?php echo $animationClass; ?>" data-wow-delay="<?php echo $delay; ?>" style="display: none;">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex mr-3" src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="">
                    <div class="media-body align-self-center">
                        <h4 class="mt-0">
                            <a href="single-blogs.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </a>
                        </h4>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif;
        $counter++;
    endwhile; ?>
</div>

<!-- Read More Button for Android Section -->
<div class="row mt-4">
    <div class="col-lg-12 text-center">
        <a id="read-more-android" href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More</a>
    </div>
</div>





				</div>					
			</section>
			<!-- End travel Area -->
			
			<!-- Start fashion Area -->
			<section class="fashion-area section-gap" id="fashion">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
						<div class="title text-center wow animate__animated animate__slideInDown" data-wow-duration="1s" data-wow-delay="">
    <h1 class="mb-10">Web Development News This Week</h1>
    <p>Web development blogs serve as invaluable resources for developers, enthusiasts, and anyone looking to enhance their understanding of web technologies. These blogs cover a wide range of topics, including tutorials on the latest programming languages.</p>
</div>
						</div>
					</div>					
					<!-- <div class="row">
						<div class="col-lg-3 col-md-6 single-fashion">
							<img class="img-fluid" src="img/f1.jpg" alt="">
							<p class="date">10 Jan 2018</p>
							<h4><a href="single-fashionblogs.php">Addiction When Gambling
							Becomes A Problem</a></h4>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-fashion">
							<img class="img-fluid" src="img/f2.jpg" alt="">
							<p class="date">10 Jan 2018</p>
							<h4><a href="single-fashionblogs.php">Addiction When Gambling
							Becomes A Problem</a></h4>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-fashion">
							<img class="img-fluid" src="img/f3.jpg" alt="">
							<p class="date">10 Jan 2018</p>
							<h4><a href="single-fashionblogs.php">Addiction When Gambling
							Becomes A Problem</a></h4>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>
						<div class="col-lg-3 col-md-6 single-fashion">
							<img class="img-fluid" src="img/f4.jpg" alt="">
							<p class="date">10 Jan 2018</p>
							<h4><a href="single-fashionblogs.php">Addiction When Gambling
							Becomes A Problem</a></h4>
							<p>
								inappropriate behavior ipsum dolor sit amet, consectetur.
							</p>
							<div class="meta-bottom d-flex justify-content-between">
								<p><span class="lnr lnr-heart"></span> 15 Likes</p>
								<p><span class="lnr lnr-bubble"></span> 02 Comments</p>
							</div>									
						</div>	
						<a href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>						
					</div> -->
					<?php
if ($result2->num_rows > 0) {
    // Fashion Blogs
    echo '<div class="row" id="fashion-blog-container">'; // Added id for Fashion blogs
    
    $counter = 0;
    $totalDisplayed = 4; // Show only 4 posts initially

    // Loop through each blog post
    while ($row = $result2->fetch_assoc()) {
        $blog_id = $row['id']; 
        $title = $row['title']; 
        $date = $row['date']; 
        $description = $row['description']; 
        $image = $row['image1'];
        $slug = isset($row['slug']) ? $row['slug'] : ''; // Check if slug exists

        // Calculate delay based on counter (e.g., 0.2s increments)
        $delay = ($counter * 0.2) . 's';

        // Show the first $totalDisplayed posts, hide the rest initially
        if ($counter < $totalDisplayed) {
            echo '
            <div class="col-lg-3 col-md-6 single-fashion blog-post wow animate__animated animate__slideInUp" data-wow-delay="' . $delay . '" style="display: block;">
                <img class="img-fluid" src="' . htmlspecialchars($image) . '" alt="">
                <p class="date">' . date("d M Y", strtotime($date)) . '</p>
                <h4><a href="single-fashionblogs.php?slug=' . htmlspecialchars($slug) . '">' . htmlspecialchars($title) . '</a></h4>
                <p>' . htmlspecialchars($description) . '</p>
            </div>';
        } else {
            echo '
            <div class="col-lg-3 col-md-6 single-fashion blog-post wow animate__animated animate__slideInUp" data-wow-delay="' . $delay . '" style="display: none;">
                <img class="img-fluid" src="' . htmlspecialchars($image) . '" alt="">
                <p class="date">' . date("d M Y", strtotime($date)) . '</p>
                <h4><a href="single-fashionblogs.php?slug=' . htmlspecialchars($slug) . '">' . htmlspecialchars($title) . '</a></h4>
                <p>' . htmlspecialchars($description) . '</p>
            </div>';
        }
        
        $counter++;
    }

    echo '</div>'; // Close row

    // Add the "Load More" button for Fashion Blogs
    echo '
    <div class="row mt-4">
        <div class="col-lg-12 text-center">
          	<a id="load-more-fashion" href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More</a>
        </div>
    </div>';
}
?>



				</div>	
			</section>
			<!-- End fashion Area -->
			
			<!-- Start team Area -->
<!--			<section class="team-area section-gap" id="team">-->
<!--				<div class="container">-->
<!--					<div class="row d-flex justify-content-center">-->
<!--						<div class="menu-content pb-70 col-lg-8">-->
<!--						<div class="title text-center animate__animated animate__slideInDown animate__delay-1s animate__duration-">-->
<!--    <h1 class="mb-10">About Blogger Team</h1>-->
<!--    <p>Who are in extremely love with eco friendly system.</p>-->
<!--</div>-->
<!--					</div>						-->
<!--					<div class="row justify-content-center d-flex align-items-center">-->
<!--					<div class="col-lg-6 team-left animate__animated animate__slideInLeft">-->
<!--    <p>-->
<!--        Inappropriate behavior is often dismissed as "boys will be boys," but women frequently encounter higher conduct standards, especially in professional environments. This disparity highlights the importance of maintaining exemplary behavior in the workplace. As women, it is crucial to recognize that our actions can have a lasting impact on our careers and the perceptions of our capabilities.-->
<!--    </p>-->
<!--    <p>-->
<!--        In the rapidly evolving tech industry, roles such as Android Developer and Senior Android Developer play a significant part in shaping the future of mobile applications. An Android Developer focuses on designing, building, and maintaining applications for the Android platform, requiring a strong grasp of Java, Kotlin, and the Android SDK. In contrast, a Senior Android Developer not only possesses advanced technical skills but also leads projects, mentors junior developers, and makes critical decisions that affect the overall architecture and functionality of applications. Both positions demand a commitment to excellence and a proactive approach to professional development, underscoring the need for women in tech to advocate for themselves and elevate industry standards.-->
<!--    </p>-->
<!--</div>-->

<!--						<div class="col-lg-6 team-right d-flex justify-content-center">-->
<!--							<div class="row active-team-carusel">-->
<!--								<div class="single-team">-->
<!--								    <div class="thumb">-->
<!--								        <img class="img-fluid" src="image/WhatsApp Image 2024-09-24 at 12.08.03_9e8720f5.jpg" alt="">-->
<!--										<div class="align-items-center justify-content-center d-flex">-->
<!--											<a href="https://www.facebook.com/profile.php?id=100092395756725&mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>-->
<!--											<a href="https://www.instagram.com/alihamx_a?igsh=YmUwZjBwanUyZjFk"><i class="fa fa-instagram"></i></a>-->
<!--											<a href="https://www.linkedin.com/in/ali-hamza-7b3762252?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fa fa-linkedin"></i></a>-->
<!--								        </div>-->
<!--								    </div>-->
<!--								    <div class="meta-text mt-30 text-center">-->
<!--									    <h4>Ali Hamza</h4>-->
<!--									    <p>Android Developer</p>									    	-->
<!--								    </div>-->
<!--								</div>-->
<!--								<div class="single-team">-->
<!--								    <div class="thumb">-->
<!--								        <img class="img-fluid" src="image/WhatsApp Image 2024-09-24 at 12.08.03_adee6914.jpg" alt="">-->
<!--								        <div class="align-items-center justify-content-center d-flex">-->
<!--											<a href="https://www.facebook.com/profile.php?id=100092395756725&mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>-->
<!--											<a href="https://www.instagram.com/alihamx_a?igsh=YmUwZjBwanUyZjFk"><i class="fa fa-instagram"></i></a>-->
<!--											<a href="https://www.linkedin.com/in/ali-hamza-7b3762252?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fa fa-linkedin"></i></a>-->
<!--								        </div>-->
<!--								    </div>-->
<!--								    <div class="meta-text mt-30 text-center">-->
<!--									    <h4>Ali Hamza</h4>-->
<!--									    <p>Founder of HySkyTech</p>			    	-->
<!--								    </div>-->
<!--								</div>													-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>	-->
<!--			</section>-->
			<!-- End team Area -->
			
			<!-- start footer Area -->		
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
			<script>
 new WOW().init(); // Initialize WOW.js


				$(document).ready(function() {
    // Initialize slick slider after DOM is fully loaded
    $('.active-cat-carusel').slick({
        slidesToShow: 3, // Example: adjust based on your layout
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});
document.getElementById('read-more-android').addEventListener('click', function(event) {
    event.preventDefault();
    // Select hidden blog posts in the Android section
    const hiddenPosts = document.querySelectorAll('#android-blog-section .blog-post[style*="display: none;"]');
    
    // Show the next 4 hidden posts in the Android section
    for (let i = 0; i < 4 && i < hiddenPosts.length; i++) {
        hiddenPosts[i].style.display = 'block';
    }
    
    // If no more hidden posts in the Android section, hide the "Read More" button
    if (document.querySelectorAll('#android-blog-section .blog-post[style*="display: none;"]').length === 0) {
        this.style.display = 'none';
    }
});



	document.addEventListener('DOMContentLoaded', function() {
    // Load more Fashion Blogs
    document.getElementById('load-more-fashion').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior

        // Select all hidden Fashion blog posts
        const hiddenPosts = document.querySelectorAll('#fashion-blog-container .blog-post[style*="display: none;"]');

        // Show the next 4 hidden posts
        for (let i = 0; i < 4 && i < hiddenPosts.length; i++) {
            hiddenPosts[i].style.display = 'block';
        }

        // If no more hidden posts, hide the "Load More" button
        if (document.querySelectorAll('#fashion-blog-container .blog-post[style*="display: none;"]').length === 0) {
            this.style.display = 'none';
        }
    });
});

			</script>	
		</body>
	</html> 