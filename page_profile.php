<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

//session_start();
$controllerMainUnities = new ControllerMainUnities();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$details = $controllerMainUnities->getPersonFromPersonID($_GET['id']);
$keywords = $controllerMainUnities->getKeywordFromPersonID($_GET['id']);
$types = $ControllerAccompanyingObject->getItemTypeFromItemID($_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Panorama</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="assets/css/imports.css" media="screen">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="single single-post">

		<div id="top"></div>

		<!-- Navigation (main menu)
		================================================== -->

		<div class="navbar-wrapper">
		
		</div><!-- /.navbar-wrapper -->




		<!-- Hero Section
		================================================== -->

		<section class="hero small-hero" style="background-image:url(assets/images/hero-4.jpg);">
			<div class="bg-overlay">
				<div class="container">
					<div class="intro-wrap">
						<h3 class="intro-title hidden"><?php echo $lang['person']; ?></h3>
					</div>
				</div>
			</div>
		</section>




		<!-- Main Section
		================================================== -->

		<section class="main container">
			<div id="content" class="row">
				<div class="col-sm-8 col-md-6 col-md-push-3">
					<header class="entry-header">
						<h1 class="entry-title">Time to Hit the Road</h1>
					</header>
					<article class="post">
						<div class="entry-summary">
							<p class="lead">And if I'm ever in need of advice from a psychotic potato dwarf, you'll certainly be the first to know. And that is more important. Then it doesn't have to end. I hate endings! I never know why. I only know who.</p>
						</div>
					
						<div id="comments" class="comments-area">
							<header class="page-header">
								<h2 class="comments-title"> 3 thoughts on “<span>Living the Travel Lifestyle</span>”</h2> </header>
						
							<div id="respond" class="comment-respond">
								<h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" href="#" style="display:none;">Cancel Reply</a></small></h3>
								
							
							</div>
						</div>
					</article>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 col-md-pull-6 blog-details-column">
					<div class="entry-meta">
						<span class="icon-meta">
							<span class="posted-on"> <i class="fa fa-calendar"></i>
								<span class="meta-item">May 11, 2015</span>
							</span>
						</span>

						<div class="byline icon-meta">
							<i class="fa fa-user "></i>
							<span class="author vcard meta-item">
								<a href="author.html" title="Posts by Olivia" rel="author">Olivia</a>
							</span>
						</div>

						<div class="comments-link icon-meta">
							<i class="fa fa-comments"></i>
							<span class="meta-item">
								<a href="#">3 Comments</a>
							</span>
						</div>

						<div class="cat-links icon-meta">
							<i class="fa fa-folder"></i>
							<a href="#" rel="category tag">Europe</a>&nbsp;&nbsp;
							<a href="#" rel="category tag">Family Travel</a>&nbsp;&nbsp;
							<a href="#" rel="category tag">North America</a>&nbsp;&nbsp;
							<a href="#" rel="category tag">Travel News</a>&nbsp;&nbsp;
							<a href="#" rel="category tag">Travel Planning</a>
						</div>

						<div class="tag-links icon-meta">
							<i class="fa fa-tag"></i>
							<a href="#" rel="tag">choices</a>&nbsp;&nbsp;
							<a href="#" rel="tag">destination</a>&nbsp;&nbsp;
							<a href="#" rel="tag">family</a>&nbsp;&nbsp;
							<a href="#" rel="tag">lifestyle</a>&nbsp;&nbsp;
							<a href="#" rel="tag">living</a>&nbsp;&nbsp;
							<a href="#" rel="tag">memories</a>&nbsp;&nbsp;
							<a href="#" rel="tag">planning</a>&nbsp;&nbsp;
							<a href="#" rel="tag">route</a>&nbsp;&nbsp;
							<a href="#" rel="tag">tips</a>&nbsp;&nbsp;
							<a href="#" rel="tag">trip</a>
						</div>
					</div>

					<div class="sidebar">
						<div class="sidebar-padder">
							<div class="widget scg_widget single-post-left widget_text">
								<div class="textwidget">
									<hr>
									<p>Are you a writer? Are you interested in seeing the world, and being paid to do it? Of course you are.
										<br>
										<br> <a href="#"><strong>Find our more</strong> <i class="fa fa-arrow-right"></i></a></p>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="sidebar col-xs-12 col-sm-4 col-md-3">
					<div class="sidebar-padder">
				
			
						<aside id="categories-2" class="widget widget_categories">
							<h3 class="widget-title">Topics</h3>
							<ul>
								<li class="cat-item cat-item-48"><a href="destinations.html">Destinations</a>
									>
							</ul>
						</aside>
					</div>
				</div>
			</div>
		</section>


		<!-- Footer
		================================================== -->


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
	</body>
</html>