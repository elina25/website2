<?php 

require_once("inc/init.php");

require_once("inc/lang.php");



$ControllerMainUnities = new ControllerMainUnities();

$ControllerAccompanyingObject = new ControllerAccompanyingObject();

$ControllerKeyword = new ControllerKeyword();

$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();

$Alltypes = $ControllerAccompanyingObject->getAllItemTypes();

$SourcesOfPhotos = $ControllerMainUnities->getAllSourcesForPhotos();

$typesOfMainUnities = $ControllerMainUnities->getAllItemTypes();

$FilterObject = BibliographyFilters::Load();

$current_itemtype_id = $_GET['item_type_id'];



//$KeywordsFilters = $ControllerKeyword->getKeywordWithTypeID($_GET['item_type_id'],$CultureID);

//$information = $ControllerArtwork->getArtWorksWithID($_GET['id'], $CultureID);

//$kinds = $ControllerArtwork->getKindforArtwork($_GET['item_type_id']);

//$types = $ControllerAccompanyingObject->getItemTypeFromItemID($_GET['id']);

//$keywords = $ControllerArtwork->getKeywordFromArtworkID($_GET['id']);

//$details = $ControllerArtwork->getsomeDetailsforArtwork($_GET['id']);





?>



<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <link href="assets/libraries/slick/slick.css" rel="stylesheet" type="text/css">

    <link href="assets/libraries/slick/slick-theme.css" rel="stylesheet" type="text/css">

    <link href="assets/css/trackpad-scroll-emulator.css" rel="stylesheet" type="text/css">

    <link href="assets/css/chartist.min.css" rel="stylesheet" type="text/css">

    <link href="assets/css/jquery.raty.css" rel="stylesheet" type="text/css">

    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="assets/css/nouislider.min.css" rel="stylesheet" type="text/css">

    <link href="assets/css/explorer.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <script type="text/javascript" src="assets/js/jquery.js"></script>

    <title></title>

  </head>

  <body class="">

    <div class="page-wrapper">

      <div class="header-wrapper">

       

        <?php include("inc/header.php"); ?>



      </div>

      <!-- /.header-wrapper -->

      <div class="main-wrapper">

        <div class="main">

          <div class="main-inner">

            <div class="page-title">

             

             

            </div>

            <!-- /.page-title -->

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

            <div class="container">

              <nav class="breadcrumb">

                <a class="breadcrumb-item" href="http://www.panorama.gr/website2/">ΑΡΧΙΚΗ &nbsp;/</a>

             <span class="breadcrumb-item active">Συνοδευτικό Υλικό&nbsp /</span>
             <span class="breadcrumb-item active"> 
              
                                    <?php switch ($_GET['item_type_id']) {

                                       case 1:

                                        echo $lang['photos_list']; 

                                        break;

                                       case 2:

                                        echo $lang['printed_doc']; 

                                        break;

                                       case 3:

                                        echo $lang['biography_list']; 

                                        break;

                                       case 4:

                                        echo $lang['bibliography_list']; 

                                        break;

                                        case 5:

                                        echo $lang['audiovisual_list']; 

                                        break;

                                        case 6:

                                        echo $lang['document_list']; 

                                        break;

                                        case 7:

                                        echo $lang['notes_list']; 

                                        break;

                                        case 8:

                                        echo $lang['map_list']; 

                                        break;

                                        default:

                                         echo $lang['sponsor_list']; 

                                         break;

                                        } ?>

                                     

              </nav>





          <div class="row">

<!-- ************************************************************************* START OF SIDEBAR LEFT SIDEBAR********** -->

              



            



                <div class="col-md-4 col-lg-3">

                  <div class="sidebar" id="sidebar_region">

                      <div class="widget">

                          <ul class="nav actions flex-column">

                            <li class="nav-item featured nav-link sideborder">

                               <p style="font-size: 20px; text-align: center; color:#ffffff; margin-bottom:0px;"><?php echo $lang['sinodeutiko_iliko'];?></p>

                             </li>

                                <?php $langParam = ((isset($_GET['lang']) === false)?  '' : '&lang='.$_GET['lang']); ?>



                                <?php foreach ($itemtypes as $itemtype) { ?>

                                <?php if ($itemtype->accompanyingItemTypeID ==1) { ?>

                               <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==2) { ?>

                                 <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                                <?php if ($itemtype->accompanyingItemTypeID ==5) { ?>

                                <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo $lang['audiovisual_list'] ?></a></li>

                               <?php  } ?>

                               

                               <?php if ($itemtype->accompanyingItemTypeID ==3) { ?>

                                 <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==4) { ?>

                                <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==6) { ?>

                               <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==7) { ?>

                               <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==8) { ?>

                              <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                               <?php if ($itemtype->accompanyingItemTypeID ==9) { ?>

                                <li class="nav-item featured <?php echo ($itemtype->accompanyingItemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                               <?php  } ?>

                       

                            <?php } ?>

                          </ul>

                       </div>

                  </div>

                </div>





<!-- ************************************************************************* END OF LEFT SIDEBAR *************************************************************************** -->





<!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->





                  

            <div class="col-md-4 col-lg-6 col-md-push-3">

                <div class="" id="sy">

                    <div class="listing-tabs-header">

                        <ul class="nav nav-tabs" role="tablist"> <!--LOAD THE NAME OF TE TAB -->

                            <li class="nav-item">

                                    <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php switch ($_GET['item_type_id']) {

                                       case 1:

                                        echo $lang['photos_list']; 

                                        break;

                                       case 2:

                                        echo $lang['printed_doc']; 

                                        break;

                                       case 3:

                                        echo $lang['biography_list']; 

                                        break;

                                       case 4:

                                        echo $lang['bibliography_list']; 

                                        break;

                                        case 5:

                                        echo $lang['audiovisual_list']; 

                                        break;

                                        case 6:

                                        echo $lang['document_list']; 

                                        break;

                                        case 7:

                                        echo $lang['notes_list']; 

                                        break;

                                        case 8:

                                        echo $lang['map_list']; 

                                        break;

                                        default:

                                         echo $lang['sponsor_list']; 

                                         break;

                                        } ?>

                                     </a>

                            </li>

                        </ul>

                    </div>

           

                    <?php if ($_GET['item_type_id'] == 1) { 



                       include ("accompanying_lists/photo_list.php");

                        

                    } else if ($_GET['item_type_id'] == 2) { 

                        

                       include ("accompanying_lists/printed_or_hand_list.php");

                         

                    } else if ($_GET['item_type_id'] == 3) { 



                       include ("accompanying_lists/biography_list.php");



                    } else if ($_GET['item_type_id'] == 4) { 

                        

                       include ("accompanying_lists/bibliography_list.php");



                    } else if ($_GET['item_type_id'] == 5) { 



                       include ("accompanying_lists/audiovisual_list.php");



                    } else if ($_GET['item_type_id'] == 6) {



                       include ("accompanying_lists/document_list.php");



                    } else if ($_GET['item_type_id'] == 7) {



                       include ("accompanying_lists/note_list.php");



                    } else if ($_GET['item_type_id'] == 8) {



                       include ("accompanying_lists/map_list.php");



                    } else {



                       include ("accompanying_lists/sponsor_list.php");

                    }?>



                



            </div>

          </div>

          </div>

          <!-- /.main-inner -->

        </div>

        <!-- /.main -->

      </div>

      <!-- /.main-wrapper -->

      <div class="footer-wrapper">

          <?php include ("inc/footer.php") ?>

      </div>

      <!-- /.footer-wrapper -->

    </div>



   <!--  <div class="side-wrapper">

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

            <div class="form-group">

              <input type="password" class="form-control" placeholder="Password">

            </div>

            <button class="btn btn-primary pull-right" type="submit">Login</button>

          </form>

        </div>

      </div>

    </div> -->

    <div class="side-overlay"></div>

    <!-- /.side-overlay -->

    <script src="http://maps.googleapis.com/maps/api/js?libraries=weather,geometry,visualization,places,drawing&key=AIzaSyDmXybAJzoPZ6hH-Jhv7QMCSGgQ6MY8WqY" type="text/javascript"></script>

    

    <script type="text/javascript" src="assets/js/tether.min.js"></script>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="assets/js/chartist.min.js"></script>

    <script type="text/javascript" src="assets/js/google-map-richmarker.min.js"></script>

    <script type="text/javascript" src="assets/js/google-map-infobox.min.js"></script>

    <script type="text/javascript" src="assets/js/google-map-markerclusterer.js"></script>

    <script type="text/javascript" src="assets/js/google-map.js"></script>

    <script type="text/javascript" src="assets/js/jquery.trackpad-scroll-emulator.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.inlinesvg.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.affix.js"></script>

    <script type="text/javascript" src="assets/js/jquery.scrollTo.js"></script>

    <script type="text/javascript" src="assets/libraries/slick/slick.min.js"></script>

    <script type="text/javascript" src="assets/js/nouislider.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.raty.js"></script>

    <script type="text/javascript" src="assets/js/wNumb.js"></script>

    <script type="text/javascript" src="assets/js/particles.min.js"></script>

    <script type="text/javascript" src="assets/js/explorer.js"></script>

    <script type="text/javascript" src="assets/js/explorer-map-search.js"></script>  



  </body>

</html>