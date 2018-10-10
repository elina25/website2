<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

//$ControllerArtwork = new ControllerArtwork();
$item_type_id = $_GET['item_type_id'];
$ControllerMainUnities = new ControllerMainUnities();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerKeyword = new ControllerKeyword();
$ControllerBibliography = new ControllerBibliography();
$bibliographies = $ControllerBibliography->getAllBibliography($_GET['item_type_id']);
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$accompanyingObjects = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemType($_GET['item_type_id']);
$typesOfMainUnities = $ControllerMainUnities->getAllMainUnitiesItemTypes();
$SourcesOfPhotos = $ControllerMainUnities->getAllSourcesForPhotos();
$KeywordsFilters = $ControllerKeyword->getKeywordWithTypeID($_GET['item_type_id'],$CultureID);

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
              <div class="container">
                <h1><?php echo $lang['sinodeutiko_iliko'] ?>
                </h1>
                <div class="page-title-actions">
             
                
                </div>
              </div>
             
            </div>
            <!-- /.page-title -->
            <div class="container">
              <nav class="breadcrumb">
                <a class="breadcrumb-item" href="#">Home</a>
                <a class="breadcrumb-item" href="#">Library</a>
                <a class="breadcrumb-item" href="#">Data</a>
                <span class="breadcrumb-item active">Bootstrap</span>
              </nav>


          <div class="row">

              

                <div class="col-md-4 col-lg-3">
                  <div class="sidebar">
                    <div class="widget">
                       <h3 class="page-title-small"><?php echo $lang['sinodeutiko_iliko'];?></h3>
                      <ul class="nav actions flex-column">
                     

                          <?php foreach ($itemtypes as $itemtype) { ?>

                              <li class="nav-item featured"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a></li>

                          <?php } ?>
                       

                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 col-lg-6">
                    <div id="accompanying_items" class="table-wrapper">
                    </div>
                </div>

                        <div class="col-md-4 col-lg-3">
                          <h3 class="page-title-small"><?php echo $lang['filters']?></h3>
                           <?php if ($_GET['item_type_id'] == 1) { 

                             include ("accompanying_filters/photo_list_filters.php");
                              
                          } else if ($_GET['item_type_id'] == 2) { 
                              
                             include ("accompanying_filters/printed_doc_list_filters.php");
                               
                          } else if ($_GET['item_type_id'] == 3) { 

                             include ("accompanying_filters/biography_list_filters.php");

                          } else if ($_GET['item_type_id'] == 4) { 
                              
                             include ("accompanying_filters/bibliography_list_filters.php");

                          } else if ($_GET['item_type_id'] == 5) { 

                             include ("accompanying_filters/audiovisual_list_filters.php");

                          } else if ($_GET['item_type_id'] == 6) {

                             include ("accompanying_filters/document_list_filters.php");

                          } else if ($_GET['item_type_id'] == 7) {

                             include ("accompanying_filters/note_list_filters.php");

                          } else if ($_GET['item_type_id'] == 8) {

                             include ("accompanying_filters/map_list_filters.php");

                          } else {

                             include ("inc/accompanying_filters/sponsor_list_filters.php");
                          }

                          ?>
                         
                         </div>
               
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

    <script type="text/javascript">
    $(function () {
        var item_type_id = "<?php echo isset($_GET['item_type_id']) && $_GET['item_type_id'] ? $_GET['item_type_id'] : ''; ?>";
        accompanying_item_type(item_type_id);

            function accompanying_item_type(item_type_id) {
            if (item_type_id == 1) {
                getPhotos();
            }
            if (item_type_id == 2) {
                getPrintedDoc();
            }
            if (item_type_id == 3) {
                getBiographies();
            }
            if (item_type_id == 4) {
                getBibliographies();
            }
            if (item_type_id == 5) {
                getAudioVisual();
            }
            if (item_type_id == 6) {
                getDocuments();
            }
            if (item_type_id == 7) {
                getNotes();
            }
            if (item_type_id == 8) {
                getMaps();
            }
            if (item_type_id == 9) {
                getSponsors();
            }
        }

         function getBiographies() {
            $.ajax({
                url: "ajax/lists/biography_list.php",
                type: "GET",
                success: function (result) {
                   console.log(result);
                    $('#accompanying_items').html(result);
                }
            });
        }
        function getBibliographies() {
            $.ajax({
                url: "ajax/lists/bibliography_list.php",
                type: "GET",
                success: function (result) {
                   console.log(result);
                    $('#accompanying_items').html(result);
                }
            });
        }
        function getAudioVisual() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/audiovisual_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getDocuments() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/document_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getPrintedDoc() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/printed_doc_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getNotes() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/note_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getPhotos() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/photos_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getMaps() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/map_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }
        function getSponsors() {
            $('#accompanying_items').html('<div class="text-center"><span class="fa fa-spin fa-spinner fa-4x"></span></div>');
            console.log("test");
            $.ajax({
                url: "ajax/lists/sponsor_list.php",
                type: "GET",
                success: function (data) {
                    $("#accompanying_items").empty();
                    $("#accompanying_items").append(data);
                }
            });
        }

});
    </script>

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
  </body>
</html>