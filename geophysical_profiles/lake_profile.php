<?php 
$path = realpath(__DIR__."/.." );
require_once ($path . "/inc/init.php");
require_once ($path . "/inc/lang.php");
echo 'dasdas';
//session_start();







?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link href="../assets/libraries/slick/slick.css" rel="stylesheet" type="text/css">
    <link href="../assets/libraries/slick/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/trackpad-scroll-emulator.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/chartist.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/jquery.raty.css" rel="stylesheet" type="text/css">
    <link href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/nouislider.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/explorer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <title></title>
  </head>
  <body class="">
    <div class="page-wrapper">
      <div class="header-wrapper">
          <?php include('../inc/header.php') ?>
          <!-- /.container -->
      </div>
        <!-- /.header -->

      <!-- /.header-wrapper -->
      <div class="main-wrapper">
        <div class="main">
          <div class="main-inner">
            <div class="listing-hero">
              <div class="listing-hero-inner">
                <div class="container">
                  <h1></h1>
            	</div>
                <!-- /.container -->
              </div>
              <!-- /.listing-hero-inner -->
            </div>
            <!-- /.listing-hero -->
            <div class="listing-toolbar-wrapper">
              <div class="listing-toolbar" data-spy="affix" data-offset-top="203">
                <div class="container">
                  <ul class="nav">
                  </ul>
                  <!-- /.nav -->
                </div>
                <!-- /.container -->
              </div>
              <!-- /.listing-toolbar -->
            </div>
            <!-- /.listing-toolbar-wrapper -->
            <div class="container">
              <nav class="breadcrumb">
                <a class="breadcrumb-item" href="#">Home</a>
                <a class="breadcrumb-item" href="#">Library</a>
                <a class="breadcrumb-item" href="#">Data</a>
                <span class="breadcrumb-item active">Bootstrap</span>
              </nav>

                <div class="row">
                  <!-- ************************************************************************* START OF SIDEBAR *************************************************************************** -->
              	  <div class="col-md-4 col-lg-3">
                    <div class="sidebar">
                      <div class="widget">
                    	  <h2><?php echo $lang['subareas'];?></h2>
                          <ul class="nav actions flex-column">
                      	     
                          </ul>
                      </div>
             	      </div>
                 </div> 


                  <!-- ************************************************************************* END OF SIDEBAR *************************************************************************** -->



                  <!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->
               
            <div class="col-md-4 col-lg-6 col-md-push-3">
                <div class="" id="sy">
                    <div class="listing-tabs-header">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['otherdetails']; ?></a>
                            </li>
                            <li class="nav-item not-show">
                              <a class="nav-link" href="#tab-rent" data-toggle="tab"><?php echo $lang['sinodeutiko_iliko']; ?></a>
                            </li>
                        </ul>
                    </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">

                          <div class="listing-detail-section" id="listing-detail-section-details" data-title="Details">
                              <h2><?php echo $lang['details']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                       
                                      </div>
                                  </div>
                              </div>
                          </div>


                           <div class="listing-detail-section" id="listing-detail-keywords" data-title="<?php echo $lang['keyword'];?>">
                              <h2><?php echo $lang['keyword'];?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                      
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="listing-detail-section" id="listing-character" data-title="<?php echo $lang['character'];?>">
                              <h2><?php echo $lang['character'];?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="listing-detail-section" id="listing-detail-section-map-position" data-title="Map Position">
                                <h2>Map Position</h2>
                                    <iframe class="mb30" style="height:320px;width:100%;border:0;"
                                          src="https://www.google.com/maps/embed/v1/place?q=47.603138,-122.332302&key=AIzaSyDmXybAJzoPZ6hH-Jhv7QMCSGgQ6MY8WqY">
                                    </iframe>
                            </div>
                       
                      </div>
                    </div>
                    <div class="tab-pane not-show" id="tab-rent" role="tabpanel">
                      <div class="listing-boxes">
                        <div class="row">
                          <div class="blog-container classic" style="padding-top:40px;">
                              <article>
                                <div class="content" style="width:100%;">
                                </div>
                              </article>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
<!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->





 <!-- ************************************************************************* START OF RIGHT SIDEBAR *************************************************************************** -->
              
                <div class="col-md-4 col-lg-3">
                  <div class="sidebar">
                     <div class="widget">
                            <div class="category-column">
                              <h3><i class="fa fa-diamond"></i> <?php echo $lang['sinodeutiko_iliko'] ?></h3>
                              <ul>
                                <li>
                  								<li>
                  								
                  								</li>
                  									<!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->
                  								</li>
                  							</ul>
                            </div>
                      </div>

                        <div class="widget">
                            <div class="category-column">
                              <h3><i class="fa fa-diamond"></i> <?php echo $lang['kiria_ontotita'] ?></h3>
                              <ul>
                                <li>
								                <li>
									                
							                  </li>
								                  	<!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->
								                
								                </li>
                               </ul>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="category-column">
                              <h3><i class="fa fa-diamond"></i> <?php echo $lang['geofisiki_ontotita'] ?></h3>
                              <ul>
                                <li>
								              </li>
                              </ul>
                            </div>
                      </div>
             	      </div>
                </div>

                 <!-- ************************************************************************* END OF RIGHT SIDEBAR *************************************************************************** -->

                <!-- /.col-* -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </div>
          <!-- /.main-inner -->
        </div>
        <!-- /.main -->
      </div>
      <!-- /.main-wrapper -->
      <div class="footer-wrapper">
   
     <?php include ("./../inc/footer.php") ?>
      </div>
      <!-- /.footer-wrapper -->
    </div>
    <!-- /.page-wrapper -->

    <div class="side-wrapper">
      <div class="side">
        <div class="side-inner">
          <div class="side-user">
            <span class="avatar" style="background-image: url('../assets/img/tmp/user-10.jpg');"></span>
            <span class="side-user-avatar-name">
              <strong>William F. Kane</strong>
              <span>System administrator</span>
            </span>
            <a href="#" class="side-user-avatar-action">
              <i class="fa fa-cog"></i>
            </a>
          </div>
          <!-- /.side-user -->
          <ul class="nav flex-column">
            <li class="nav-item"><a href="admin-dashboard.html" class="nav-link">Author Dashboard</a></li>
            <li class="nav-item"><a href="admin-listings.html" class="nav-link">Listings Queue</a></li>
            <li class="nav-item"><a href="admin-projects.html" class="nav-link">Running Projects</a></li>
            <li class="nav-item"><a href="admin-tasks.html" class="nav-link">Tasks Management</a></li>
            <li class="nav-item"><a href="admin-users.html" class="nav-link">User Accounts</a></li>
          </ul>
          <h3>Welcome Back</h3>
          <form class="form-dark" method="post" action="?">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Username">
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password">
            </div>
            <!-- /.form-group -->
            <button class="btn btn-primary pull-right" type="submit">Login</button>
          </form>
        </div>
        <!-- /.side-inner -->
      </div>
      <!-- /.side -->
    </div>
    <!-- /.side-wrapper -->
    <div class="side-overlay"></div>
    <!-- /.side-overlay -->
    <script src="http://maps.googleapis.com/maps/api/js?libraries=weather,geometry,visualization,places,drawing&key=AIzaSyDmXybAJzoPZ6hH-Jhv7QMCSGgQ6MY8WqY" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/tether.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/chartist.min.js"></script>
    <script type="text/javascript" src="../assets/js/google-map-richmarker.min.js"></script>
    <script type="text/javascript" src="../assets/js/google-map-infobox.min.js"></script>
    <script type="text/javascript" src="../assets/js/google-map-markerclusterer.js"></script>
    <script type="text/javascript" src="../assets/js/google-map.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.trackpad-scroll-emulator.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.inlinesvg.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.affix.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="../assets/libraries/slick/slick.min.js"></script>
    <script type="text/javascript" src="../assets/js/nouislider.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.raty.js"></script>
    <script type="text/javascript" src="../assets/js/wNumb.js"></script>
    <script type="text/javascript" src="../assets/js/particles.min.js"></script>
    <script type="text/javascript" src="../assets/js/explorer.js"></script>
    <script type="text/javascript" src="../assets/js/explorer-map-search.js"></script>
    <script type="text/javascript">


  

  </script>
  </body>
</html>

