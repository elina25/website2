<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

//session_start();
$ControllerMainUnities = new ControllerMainUnities();
$ControllerKeyword = new ControllerKeyword();
$ControllerSea = new ControllerSea();
$ControllerLake = new ControllerLake();
$ControllerRiver = new ControllerRiver();
$ControllerMountain = new ControllerMountain();
$ControllerLandarea = new ControllerLandarea();

$typesOfMainUnities = $ControllerMainUnities->getAllItemTypes();
$geophysicals = $ControllerMainUnities->getAllItemsWithItemType($_GET['item_type_id']);
$geos = $ControllerMainUnities->getAllGeoUnities();
$kinds = $ControllerMainUnities->getAllKindsForGeoUnitiesWithTypeID($_GET['item_type_id'],$CultureID);
$KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID($_GET['item_type_id'],$CultureID);
$current_itemtype_id = $_GET['item_type_id'];


//$lists = $ControllerMainUnities->getAllWithItemTypeID($_GET['item_type_id']);

/* start of pagination*/
$currentPage = 1;
$offset = 0;
$num_of_pages = 0;

if(isset($_GET['page']) && is_numeric($_GET['page']))
{
  $currentPage = $_GET['page'];
}
$offset = ($currentPage - 1)  * $PAGE_SIZE;


/* end of pagination*/

if ($_GET['item_type_id'] == 11){
$FilterObject = LakeFilters::Load();
$countOfRecords = $ControllerLake->getAllLakesCount($CultureID, $FilterObject);
$lists = $ControllerLake->getAllLakesFromLakesDetails($CultureID, $FilterObject, $PAGE_SIZE, $offset);
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 
}
else if ($_GET['item_type_id'] == 10){
$FilterObject = SeaFilters::Load(); 
$countOfRecords = $ControllerSea->getAllSeaCount($CultureID,$FilterObject);
$lists = $ControllerSea->getAllSeasFromSeaDetails($CultureID, $FilterObject, $PAGE_SIZE, $offset);
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 
}
else if ($_GET['item_type_id'] == 9){
$FilterObject = LandAreaFilters::Load();
$countOfRecords = $ControllerLandarea->getAllLandAreasCount($CultureID,$FilterObject);
$lists = $ControllerLandarea->getAllLandareasFromLandereaDetails($CultureID, $FilterObject, $PAGE_SIZE, $offset);
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 
}
else if ($_GET['item_type_id'] == 8){
$FilterObject = MountainFilters::Load();
$countOfRecords = $ControllerMountain->getAllMountainCount($CultureID,$FilterObject);
$lists = $ControllerMountain->getAllMountainsFromMountainDetails($CultureID, $FilterObject, $PAGE_SIZE, $offset);
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 
}
else {
$FilterObject = RiverFilters::Load();
$countOfRecords = $ControllerRiver->getAllRiverCount($CultureID,$FilterObject);
$lists = $ControllerRiver->getAllRiversFromRiversDetails($CultureID, $FilterObject, $PAGE_SIZE, $offset);
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 

}


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
     <?php foreach ($geophysicals as $geophysical) { ?>
    <title> <?php echo ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName  ) ?></title>
    <?php } ?>
   
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
            <div class="listing-hero">
              
              </div>


              <!-- /.container-->
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
                <a class="breadcrumb-item" href="#">Γεωφυσικές Οντότητες&nbsp; /</a>
                <span class="breadcrumb-item active"><?php echo $geophysicals[0]->SingularDesc; ?></span>
              </nav>
           


          <div class="row">
<!-- ************************************************************************* START OF SIDEBAR *************************************************************************** -->
              

                <div class="col-md-4 col-lg-3">
                  <div class="sidebar" id="sidebar_region">
                      <div class="widget">
                        <ul class="nav actions flex-column">
                          <li class="nav-item featured nav-link">
                             <p style="font-size: 20px; text-align: center; color:#ffffff;"><?php echo $lang['geofisiki_ontotita'];?></p>
                              
                          </li>
                            <?php foreach($geos as $geo) { ?>
                              <li class="nav-item featured <?php echo ($geo->itemTypeID == $current_itemtype_id ? 'active' : '') ?>"><a href="geophysical_entity.php?item_type_id=<?php echo $geo->itemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $geo->PluralDesc : $geo->StandardName  ) ?></a></li>
                            <?php } ?>
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
                           <?php if ($_GET['item_type_id'] == 11) { ?>
                            <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['lakes']; ?></a>
                            </li>
                            <?php } else if($_GET['item_type_id'] == 10) { ?>
                              <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['sea']; ?></a>
                            </li>
                            <?php } else if($_GET['item_type_id'] == 9) { ?>
                              <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['landarea']; ?></a>
                            </li>
                              <?php } else if($_GET['item_type_id'] == 8) { ?>
                              <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['mountain']; ?></a>
                            </li>
                             <?php } else { ?>
                              <li class="nav-item">
                              <a class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['rivers']; ?></a>
                            </li>
                            <?php  } ?>


                          
                        </ul>
                    </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">

                        <div class="table-wrapper">
                    <div class="overview">
                      <ul>
                            <?php if ($_GET['item_type_id'] == 11) { ?>
                                <?php foreach ($lists as $lake) { ?>
                                <li class="nav-item featured">  <a class="nav-link" href="lake_profile.php?id=<?php echo $lake->lakeID; ?>" class="nav-link "><?php echo $lake->friendlyName; ?></a></li> 
                                <?php } ?>
                            <?php } else if ($_GET['item_type_id'] == 10) { ?>
                                <?php foreach ($lists as $sea) { ?>
                                <li class="nav-item featured"> <a class="nav-link" href="sea_profile.php?id=<?php echo $sea->seaID; ?>" class="nav-link "><?php echo $sea->friendlyName; ?></a></li> 
                                <?php } ?>
                            <?php } else if ($_GET['item_type_id'] == 9) { ?>
                                <?php foreach ($lists as $landarea) { ?>
                                <li class="nav-item featured">  <a class="nav-link" href="landarea_profile.php?id=<?php echo $landarea->landAreaID; ?>" class="nav-link "><?php echo $landarea->FriendlyName; ?></a></li> 
                                <?php } ?>
                            <?php }  else if ($_GET['item_type_id'] == 8) { ?>
                                <?php foreach ($lists as $mountain) { ?>
                                <li class="nav-item featured"> <a class="nav-link" href="mountain_profile.php?id=<?php echo $mountain->mountainID; ?>" class="nav-link "><?php echo $mountain->friendlyName; ?></a></li> 
                                <?php } ?>
                            <?php }  else { ?>
                                <?php foreach ($lists as $river) { ?>
                                <li class="nav-item featured"> <a class="nav-link" href="river_profile.php?id=<?php echo $river->riverID; ?>" class="nav-link "><?php echo $river->friendlyName; ?></a></li> 
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>  

                  <?php include('pagination/pagination_pages.php'); ?>
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
      

        <!-- ************************************************************************* END OF MAIN PAGE *************************************************************************** -->



 <!-- ************************************************************************* START OF RIGHT SIDEBAR *************************************************************************** -->

             <div class="col-md-4 col-lg-3">
                <div class="sidebar" id="sidebar_two_region">
                  <div class="filter filter-boxed filter-gray">
                    <form id="filters-form" method="POST" action="<?php echo GetPageUrl('') ?>">
                      <h2><?php echo $lang['search_criteria'] ?></h2>


                          <div class="form-group">
                                                 
                              <label for="MainUnities"> Τύπος συσχετιζόμενης οντότητας </label>
                              <select multiple class="form-control" id="MainUnities" name="MainUnities[]">
                                <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                                  <?php foreach ($typesOfMainUnities as $type) { ?>
                                      <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false)?  $type->SingularDesc : $type->StandardName  ) ?></option>
                                  <?php } ?>
                              </select>

                            <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                          </div>
                     
                        <div class="form-group">
                          <label><?php echo $lang['title']?></label>
                          <input type="text" name="Title" id="Title" class="form-control" placeholder="<?php echo $lang['search_title']?>">
                        </div>

                        <div class="form-group">
                          <label><?php echo $lang['koini_onomasia']?></label>
                          <input type="text" name="OfficialName" id="OfficialName" class="form-control" placeholder="<?php echo $lang['koini_onomasia']?>">
                        </div>

                        <div class="form-group">
                           <label for="Kinds">Είδος </label>
                            <select multiple class="form-control" id="Kinds" name="Kinds[]">
                                <?php foreach ($kinds as $kind) { ?>
                                  <option value="<?php echo $kind->ItemKindID ?>"><?php echo $kind->LookupValue ?></option>
                                <?php } ?>
                            </select>
                            <label for="Kinds"><?php echo $lang['multiple_select'] ?></label>
                        </div>


                        <div class="form-group">
                        <label for="Keywords"><?php echo $lang['keyword'] ?></label>
                        <select multiple class="form-control" id="Keywords" name="Keywords[]">
                          <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                            <option value="<?php echo $KeywordsFilter->KeywordID?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                          <?php } ?>
                        </select>
                        </div>

                        <div class="form-group-btn form-group-btn-placeholder-gap">
                        <button type="submit" class="btn btn-primary btn-block">Αναζήτηση</button>
                        </div>

                        
                        <button style="margin-left:70px; border: none; background-color:#eeeeee; " id="res"  class=" ">Καθαρισμός φίλτρων</button>
                   

                      <input type="hidden" name="submit_search" value="true">

                      <!-- /.form-group -->
                    </form>
                  </div>
                </div>
              </div>
            
            </div>
            <!-- /.container-fluid -->
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
    <script type="text/javascript" src="assets/js/jquery.js"></script>
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


    <script type="text/javascript">
      function SetFilters() {
          $("#Title").val('<?php echo $FilterObject->Title ?>'.replace('%','').replace('%',''));
          $("#OfficialName").val('<?php echo $FilterObject->OfficialName ?>'.replace('%','').replace('%',''));

          $.each('<?php echo $FilterObject->MainUnities ?>'.split(","), function(i,e){
              $("#MainUnities option[value='" + e + "']").prop("selected", true);
          });
          $.each('<?php echo $FilterObject->Kinds ?>'.split(","), function(i,e){
              $("#Kinds option[value='" + e + "']").prop("selected", true);
          });
          $.each('<?php echo $FilterObject->Keywords ?>'.split(","), function(i,e){
              $("#Keywords option[value='" + e + "']").prop("selected", true);
          });
      }

      $(document).ready(function() {
          <?php echo LakeFilters::SetFilters() ?>
      });

       $(document).ready(function() {
          <?php echo SeaFilters::SetFilters() ?>
      });
          $(document).ready(function() {
          <?php echo LandAreaFilters::SetFilters() ?>
      });

        $(document).ready(function() {
          <?php echo MountainFilters::SetFilters() ?>
      });

         $(document).ready(function() {
          <?php echo RiverFilters::SetFilters() ?>
      });

      $("#res").click(function() {
       var resetbuttom = document.getElementById("filters-form");
       resetbuttom.reset();
      });
    
      $(".page-item").click(function() {
        //console.log('1:');
        //console.log($(this).first().attr('href'));
      });

      $(".page-link").click(function() {
        console.log('2:');
        console.log($(this).attr('href'));

        var myForm = document.getElementById("filters-form");
        myForm.action = $(this).attr('href');
        myForm.submit();

        e.preventDefault();
        return false;
      });

      /*$('#filters-form').submit(function() {
        alert('Handler for .submit() called.');
          var main_unities = $("#slcMainUnities").val().join(',');
          var kinds = $("#slcKinds").val().join(',');
          var keywords = $("#slcKeywords").val().join(',');

          $("#MainUnities").val(main_unities);
          $("#Kinds").val(kinds);
          $("#Keywords").val(keywords);

          

          return false; // return false to cancel form action
      });*/
    </script>

  </body>
</html>