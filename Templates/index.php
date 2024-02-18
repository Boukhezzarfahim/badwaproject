<?php
require_once('..\database.php');
require_once('../admin/scripts/Section02.php');
require_once('../admin/scripts/SectionManager.php');
$sectionManager = new SectionManager($conn);
$sections = $sectionManager->get();
$section = new section($conn);

// Assuming $section->get() returns an array of objects
$sectiones = $section->get();

// Convert objects to associative arrays
$sectionData = [];
foreach ($sectiones as $section) {
    $sectionData[] = (array)$section;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Badwa product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../Templates/images/azul.ico" sizes="32x32 azul.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/> 

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/styles.css">
 
</head>
<body class="goto-here">
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+213 659 60 20 19</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">Badwa.product@gmail.com</span>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="index.php">
    <img src="../Templates/images/badwa.jpg" alt="Logo Badwa" style="width: 55px; height: 65px; border-radius: 5px;  box-shadow: 3px 3px 5px rgba(0, 128, 0.5, 0.5), -3px -3px 5px rgba(0, 128, 0.5, 0.5);">
</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">accueil</a></li>
                <li class="nav-item active"><a href="javascript:void(0);" onclick="scrollToSection('about')" class="nav-link">À propos</a></li>
                <li class="nav-item active"><a href="javascript:void(0);" onclick="scrollToSection('featured-products')" class="nav-link">Nos produits</a></li>
                <li class="nav-item active"><a href="javascript:void(0);" onclick="scrollToSection('google-maps')" class="nav-link">Adresse</a></li>
                <li class="nav-item active"><a href="javascript:void(0);" onclick="scrollToSection('contact')" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

</head>
<body class="goto-here">
    <section id="home-section">
        <div id="home-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($sections as $index => $section) : ?>
                    <div class="carousel-item <?= ($index == 0) ? 'active' : ''; ?>" style="background-image: url(../admin/public/images/section01/<?= $section['image']; ?>); ">
                        <div class="carousel-content">
                            <div class="row carousel-text justify-content-center align-items-center" data-scrollax-parent="true">
                                <div class="col-md-12 ftco-animate text-center">
                                    <h1 class="mb-2"><?= $section['texte']; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a class="carousel-control-prev" href="#home-carousel" role="button" data-slide="prev">
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#home-carousel" role="button" data-slide="next">
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</body>




    <section class="ftco-section">
			<div class="container">
				<div class="row no-gutters ftco-services justify-content-center">
       
      
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate ">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Qualité supérieur</h3>
               
              </div>
            </div>      
          </div>
		</section>

    <section class="ftco-section ftco-category ftco-no-pt">
		<div class="container">
			<div class="row">
	
	
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6 order-md-last align-items-stretch d-flex">
							<div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: white">
								<div class="text text-center">
									<h2>Badwa</h2>
									<p>Protège la santé de chaque maison</p>
								</div>
							</div>
					
						</div>
						<div class="col-md-6">
						<?php 
							$section = $sectionData[0] ?? null; // Accessing the first element

							if ($section !== null) {
								// Accessing properties from the first element
								$id = $section['id'] ?? null;
								$profileImage = $section['profileImage'] ?? null;
								$firstName = $section['firstName'] ?? null;
							
								if ($id !== null && $profileImage !== null && $firstName !== null) {
									
								
							?>
							<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(../admin/public/images/section02/<?php 	echo  $profileImage;
								
							?>);">
								<div class="text px-3 py-1">
									<h2 class="mb-0"><a href="#"><?php  echo $firstName; }} ?></a></h2>
								</div>
							</div>
							<?php 
							$section = $sectionData[1] ?? null; // Accessing the first element

							if ($section !== null) {
								// Accessing properties from the first element
								$id = $section['id'] ?? null;
								$profileImage = $section['profileImage'] ?? null;
								$firstName = $section['firstName'] ?? null;
							
								if ($id !== null && $profileImage !== null && $firstName !== null) {
									
								
							?>
							<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(../admin/public/images/section02/<?php 	echo  $profileImage;
								
							?>);">
								<div class="text px-3 py-1">
									<h2 class="mb-0"><a href="#"><?php  echo $firstName; }} ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
				<?php 
							$section = $sectionData[2] ?? null; // Accessing the first element

							if ($section !== null) {
								// Accessing properties from the first element
								$id = $section['id'] ?? null;
								$profileImage = $section['profileImage'] ?? null;
								$firstName = $section['firstName'] ?? null;
							
								if ($id !== null && $profileImage !== null && $firstName !== null) {
									
								
							?>
					<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(../admin/public/images/section02/<?php 	echo  $profileImage;
								
							?>);">
						<div class="text px-3 py-1">
							<h2 class="mb-0"><a href="#"><?php  echo $firstName; }} ?></a></h2>
						</div>
					</div>
					<?php 
							$section = $sectionData[3] ?? null; // Accessing the first element

							if ($section !== null) {
								// Accessing properties from the first element
								$id = $section['id'] ?? null;
								$profileImage = $section['profileImage'] ?? null;
								$firstName = $section['firstName'] ?? null;
							
								if ($id !== null && $profileImage !== null && $firstName !== null) {	
								
							?>
					<div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(../admin/public/images/section02/<?php 	echo  $profileImage;
								
							?>);">
						<div class="text px-3 py-1">
							<h2 class="mb-0"><a href="#"><?php  echo $firstName; }} ?></a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


    <section id="about" class="ftco-section img " style="background-image: url(../Templates/images/png.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate text-center">
                <h2 class="mb-4 subheading bold">Badwa</h2>
                <h2 class="mb-4 subheading text-white bold">C'est qui Badwa ?</h2>
                <h3 class="mb-4 subheading text-white bold">Badwa est une startup algérienne qui s'engage à vous offrir la meilleure gamme de produits faits maison à base de dattes et de leurs dérivés. Parmi ses produits, on trouve la farine de datte, le cake et les cookies.</h3>
                <div>
                    <h3 class="mb-4 subheading text-white bold" >Elle vous propose des produits 100% naturels, sans conservateurs, sans arômes artificiels, sans colorants ! Et très riches en nutriments. Découvrez toutes les saveurs de ce fruit avec Badwa.</h3>
                </div>
            </div>
        </div>
    </div>
</section>


    <section id="featured-products" class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Badwa product</span>
            <h2 class="mb-4">Nos produits</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
          </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="custom-testimony-container">    
                    <!-- Product 2 -->
                    <div class="custom-testimony-wrap p-4 pb-5">
                         <div class="custom-user-img mb-5" style="background-image: url(../Templates/images/person_2.jpg)">
                         </div>
                         <div class="text text-center">
                             <h5 class="testimonial-title">Authentique Dattes</h5>
                             <p class="mb-5 pl-4 line">dattes nour est la meilleure d'algérie Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro maiores sunt, exercitationem quae quibusdam, sapiente ipsam quos suscipit ducimus doloremque
                               officiis repellendus. Tempora voluptatibus voluptatum nisi in, blanditiis suscipit velit! </p>
                             <span class="position">azul</span>
                         </div>
                     </div>
                <div class="navigation-btns text-center">
                    <button class="prev-btn">&#8249; </button>
                    <button class="next-btn"> &#8250;</button>
                </div>
            </div>
        </div>
    </div>
</section>

	<section id="google-maps" class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Location</span>
					<h2 class="mb-4">Notre siège social</h2>
					<p>Badwa vous ouvre ses portes pour une expérience d'achat exquise des dérivés du fruit de paradis.</p>
				</div>
			</div>
			<div class="row ftco-animate">
				<div class="col-md-12 text-center">
					<div class="map-container">
					<div
           id="map" class="map-container" style="height: 500px;">
          </div>
				</div>
			</div>
		</div>
	</section>
 <!-- Make sure you put this AFTER Leaflet's CSS -->

		<section id="contact" class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          </div>
        </div>
      </div>
    </section>
    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Badwa product</h2>
              <p>Produit algérien artisanal.</p>
            </div>
          </div>
		
		 
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Avez-vous des questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">27 rue semrouni Ouled Fayet-Alger</span></li><br>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+213 659 60 20 19</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">Badwa.product@gmail.com</span></a></li>
	              </ul>
	            </div>
			
            </div>
          </div>
        </div>

		<div class="col-md-12 text-center">
			<div class="d-felx justify-content-center align-items-center">
				<ul class="ftco-footer-social list-unstyled">
					<li class="ftco-animate"><a href="https://www.facebook.com/profile.php?id=100083283275745&mibextid=ZbWKwL"><span class="icon-facebook"></span></a></li>
					<li class="ftco-animate"><a href="https://www.instagram.com/badwaproduct?igsh=NTc4MTIwNjQ2YQ=="><span class="icon-instagram"></span></a></li>
				  </ul>
			  </div>
			</div>

        <div class="row">
          <div class="col-md-12 text-center">
			

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright All rights reserved 
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <!-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> -->


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="../Templates/js/main.js"></script>
  <script src="../Templates/js/nav.js"></script>
   <script src="../Templates/js/carte.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
        
  </body>
</html>