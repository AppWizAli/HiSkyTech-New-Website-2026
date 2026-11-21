    
    <?php
include("config.php"); // Make sure your database connection is included

// Fetch blogs from the blogs_travel table for $result1
$sql1 = "SELECT * FROM blogs_travel"; // Updated table name
$result1 = $conn->query($sql1);

if ($result1 === false) {
    die("SQL query failed: " . $conn->error);
}

// Fetch blogs from the blogs_travel table for $result4
$sql2 = "SELECT * FROM blogs_travel"; // Updated table name
$result4 = $conn->query($sql2);

if ($result4 === false) {
    die("SQL query failed: " . $conn->error);
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
                            <ul class="navbar-nav scrollable-menu">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#news">Graphic</a></li>
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

            <!-- Start top-section Area -->
            <section class="top-section-area section-gap">
                <div class="container">
                    <div class="row justify-content-between align-items-center d-flex">
                        <div class="col-lg-8 top-left">
                            <h1 class="text-white mb-20">Android/category</h1>
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
        <!-- Start post Area -->
        <section class="post-area">
            <div class="container">
                <div class="row justify-content-center d-flex">
                    <div class="col-lg-8">
                        <div class="top-posts">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <!-- <div class="single-posts col-lg-6 col-sm-6">
                                        <img class="img-fluid" src="img/asset/p1.jpg" alt="">
                                        <div class="date mt-20 mb-20">10 Jan 2018</div>
                                        <a href="single-blog.php"><h4 class="text-uppercase">It S Hurricane Season Visiting </h4></a>
                                    </div>
                                    <div class="single-posts col-lg-6 col-sm-6">
                                        <img class="img-fluid" src="img/asset/p2.jpg" alt="">
                                        <div class="date mt-20 mb-20">10 Jan 2018</div>
                                        <a href="single-blog.php"><h4 class="text-uppercase">What Makes A Hotel Boutique</h4></a>
                                    </div>                                     -->
                                </div> 
                            </div>
                        </div>                     
                        <!-- <div class="post-lists">
                            <div class="single-list flex-row d-flex">
                                <div class="thumb">
                                   
                                    <img src="img/asset/l1.jpg" alt="">
                                </div>
                                <div class="detail">
                                    <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                    Becomes A Problem</h4></a>
                                    <p>
                                        inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                    </p>
                                   
                                </div>
                            </div>
                            <div class="single-list flex-row d-flex">
                                <div class="thumb">
                                    
                                    <img src="img/asset/l2.jpg" alt="">
                                </div>
                                <div class="detail">
                                    <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                    Becomes A Problem</h4></a>
                                    <p>
                                        inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="single-list flex-row d-flex">
                                <div class="thumb">
                                   
                                    <img src="img/asset/l3.jpg" alt="">
                                </div>
                                <div class="detail">
                                    <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                    Becomes A Problem</h4></a>
                                    <p>
                                        inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                    </p>
                                   
                                </div>
                            </div>
                            <div class="single-list flex-row d-flex">
                                <div class="thumb">
                                   
                                    <img src="img/asset/l4.jpg" alt="">
                                </div>
                                <div class="detail">
                                    <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                    Becomes A Problem</h4></a>
                                    <p>
                                        inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                    </p>
                                  
                                </div>
                            </div> 
                            <div class="justify-content-center d-flex">
                                <a class="text-uppercase primary-btn loadmore-btn mt-40 mb-60" href="#"> Load More Post</a>
                            </div>                                                                     
                        </div> -->
                        <div class="row mt-5">
    <div class="col-lg-12 travel-left" id="blog-container">
    <?php
    $counter = 0; // Initialize counter
    $totalDisplayed = 4; // Limit to display only 4 posts initially

    while ($row = $result1->fetch_assoc()):
        if ($counter < $totalDisplayed): // Display the first 4 blogs
    ?>
        <!-- Visible blogs initially -->
        <div class="single-travel media pb-70 blog-post">
            <!-- Blog image -->
            <img class="img-fluid d-flex mr-3" src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="">

            <!-- Blog content -->
            <div class="media-body align-self-center">
                <h4 class="mt-0">
                    <!-- Use slug for redirection -->
                    <a href="single-blogs.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </h4>

                <!-- Description -->
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            </div>
        </div>
    <?php else: ?>
        <!-- Hidden blog posts initially -->
        <div class="single-travel media pb-70 blog-post" style="display: none;">
            <img class="img-fluid d-flex mr-3" src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="">
            <div class="media-body align-self-center">
                <h4 class="mt-0">
                    <!-- Use slug for redirection -->
                    <a href="single-blogs.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
                        <?php echo htmlspecialchars($row['title']); ?>
                    </a>
                </h4>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            </div>
        </div>
    <?php endif;
    $counter++;
    endwhile; ?>
    </div>

    <!-- Read More Button -->
    <div class="row mt-4">
        <div class="col-lg-12 text-center">
            <a id="read-more-btn" href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-5 mt-60">Load More</a>
        </div>
    </div>
</div>

     


                        <div class="top-posts pt-50">
                            <!-- <div class="container">
                                <div class="row justify-content-center">
                                    <div class="single-posts col-lg-6 col-sm-6">
                                        <img class="img-fluid" src="img/asset/p1.jpg" alt="">
                                        <div class="date mt-20 mb-20">10 Jan 2018</div>
                                        <div class="detail">
                                            <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                            Becomes A Problem</h4></a>
                                            <p>
                                                inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                            </p>
                                            <p class="footer pt-20">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            <a href="#">06 Likes</a>     <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a href="#">02 Comments</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="single-posts col-lg-6 col-sm-6">
                                        <img class="img-fluid" src="img/asset/p2.jpg" alt="">
                                        <div class="date mt-20 mb-20">10 Jan 2018</div>
                                        <div class="detail">
                                            <a href="single-blog.php"><h4 class="pb-20">Addiction When Gambling <br>
                                            Becomes A Problem</h4></a>
                                            <p>
                                                inappropriate behavior Lorem ipsum dolor sit amet, consecteturinapprop riate behavior Lorem ipsum dolor sit amet, consectetur.
                                            </p>
                                            <p class="footer pt-20">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            <a href="#">06 Likes</a>     <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a href="#">02 Comments</a>
                                            </p>
                                        </div>
                                    </div>  
                                    <div class="justify-content-center d-flex">
                                        <a class="text-uppercase primary-btn loadmore-btn mt-70 mb-60" href="#"> Load More Post</a>
                                    </div>                                                                       
                                </div> 
                            </div>  -->
                            
                        </div>                            
                    </div>
                    <div class="col-lg-4 sidebar-area">
                        <div class="single_widget search_widget">
                            <div id="imaginary_container"> 
                                <div class="input-group stylish-input-group">
                                    <input type="text" class="form-control"  placeholder="Search" >
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <span class="lnr lnr-magnifier"></span>
                                        </button>  
                                    </span>
                                </div>
                            </div> 
                        </div>

                        <div class="single_widget about_widget">
                            <img src="image/121.png" alt="" >
                            <h2 class="text-uppercase">Ali Hamza</h2>
                            <p>
                                MCSE boot camps have its supporters and
                                its detractors. Some people do not understand why you should have to spend money
                            </p>
                            <div class="social-link">
                                <a href="https://www.facebook.com/profile.php?id=100092395756725&mibextid=ZbWKwL"><button class="btn"><i class="fa fa-facebook" aria-hidden="true"></i> Like</button></a>
                                <a href="https://www.instagram.com/alihamx_a?igsh=YmUwZjBwanUyZjFk"><button class="btn"><i class="fa fa-instagram" aria-hidden="true"></i> Follow</button></a>
                            </div>
                            
                        </div>
                        <!-- <div class="single_widget cat_widget">
                            <h4 class="text-uppercase pb-20">post categories</h4>
                            <ul>
                                <li>
                                    <a href="#">Technology <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Lifestyle <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Fashion <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Art <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Food <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Architecture <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Adventure <span>37</span></a>
                                </li>                                
                            </ul>
                        </div> -->

                        <div class="single_widget recent_widget">
    <h4 class="text-uppercase pb-20">Recent Posts</h4>
    <div class="active-recent-carusel">
        <?php
        
        // Check if the query was successful
       

        // Check if there are results
        if ($result4->num_rows > 0) {
            while ($row = $result4->fetch_assoc()): ?>
                <div class="item">
                    <img src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="">
                    <p class="mt-20 title text-uppercase"><?php echo htmlspecialchars($row['title']); ?></p>
                    <p><?php echo date('d M Y', strtotime($row['created_at'])); ?> <span> 
                        
                    </p>    
                </div>
            <?php endwhile;
        } else {
            echo '<p>No recent posts available.</p>';
        }
        ?>
    </div>
</div>



                        <!-- <div class="single_widget cat_widget">
                            <h4 class="text-uppercase pb-20">post archive</h4>
                            <ul>
                                <li>
                                    <a href="#">Dec'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Nov'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Oct'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Sept'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Aug'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Jul'17 <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Jun'17 <span>37</span></a>
                                </li>                                
                            </ul>
                        </div>  -->
                        <!-- <div class="single_widget tag_widget">
                            <h4 class="text-uppercase pb-20">Tag Clouds</h4>
                            <ul>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                            </ul>
                        </div>                                                 
                    </div>
                </div>
            </div>     -->
        </section>
        <!-- End post Area -->  
    </div>
    <!-- End post Area -->
    
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
			<!-- End footer Area -->	
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
            <script>
    document.getElementById('read-more-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    
    // Get all hidden blog posts
    const hiddenPosts = document.querySelectorAll('.blog-post[style*="display: none;"]');
    
    // Show the next 4 hidden posts
    for (let i = 0; i < 4 && i < hiddenPosts.length; i++) {
        hiddenPosts[i].style.display = 'block';
    }
    
    // If no more hidden posts, hide the "Load More" button
    if (document.querySelectorAll('.blog-post[style*="display: none;"]').length === 0) {
        this.style.display = 'none';
    }
});

</script>

        </body>
    </html>