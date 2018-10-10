<?php 

require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$accs = $ControllerAccompanyingObject->GetAllRelationsAccToAccItems($_GET['item_id']);
$lists = $ControllerAccompanyingObject->GetAllRelationsAccToMainEntities($_GET['item_id']);
$geophysicals = $ControllerAccompanyingObject->GetAllRelationsAccToGeo($_GET['item_id']);
$regions = $ControllerAccompanyingObject->GetAllRelationsAccToRegionsCount($_GET['item_id']); 
$type = $_GET['item_type_id'];

//print_r($regionss);
//$typesOfMainUnities = $ControllerMainUnities->getAllItemTypes();
//$counts = $ControllerArchivedObject->getArchivedObjectWithID($_GET['item_id']);

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

    <title><?php echo $accompanyingitems[0]->uniqueName; ?></title>

   
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
              <div class="listing-hero-inner">
            
              </div>
              <!-- /.listing-hero-inner -->
            </div>
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
            <!-- /.page-title -->
            <div class="container">
             <nav class="breadcrumb">
                <a class="breadcrumb-item" href="http://www.panorama.gr/website2/">ΑΡΧΙΚΗ &nbsp;/</a>
                <a class="breadcrumb-item" href="#"><?php echo $lang['sinodeutiko_iliko'];?>&nbsp; /</a>
               <!-- <a class="breadcrumb-item" href="http://www.panorama.gr/website2/accompanying_item.php?item_type_id=<?php $_GET['item_type_id']; ?>"><?php echo $type;?> &nbsp/</a>-->
                <span class="breadcrumb-item active"><?php echo $accompanyingitems[0]->uniqueName; ?>&nbsp</span>
              </nav>

              <div class="row">
                   
<!-- *****************************************************************************************  START OF SIDEBAR  ******************************************************************************************************** -->
                <div class="col-md-4 col-lg-3">
                  <div class="sidebar" id="sidebar_region">
                      <div class="widget">
                         <ul class="nav actions flex-column">
                              <li class="nav-item featured nav-link sideborder">
                                <p style="font-size: 20px; text-align: center; color:#ffffff;"><?php echo $lang['sinodeutiko_iliko'];?></p>
                              </li>
                                <?php foreach ($itemtypes as $itemtype) { ?>

                                <li class="nav-item featured"><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></a>
                                </li>

                              <?php } ?>
                          </ul>
                      </div>
                    </div>
                </div>


<!-- *****************************************************************************************  END OF SIDEBAR  ******************************************************************************************************** -->







                  <!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->
               
            <div class="col-md-4 col-lg-6 col-md-push-3">
                <div class="" id="">
                    <div class="listing-tabs-header">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a id="tabone" class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $accompanyingitems[0]->uniqueName; ?></a>
                            </li>
                            <li class="nav-item not-show" id="not">
                              <a id="tabtwo" class="nav-link " href="#tab-rent" data-toggle="tab"><?php echo $lang['sinodeutiko_iliko']; ?></a>
                            </li>
                        </ul>
                    </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="">


                            <?php 
                                $current_page = $_GET['item_type_id'];
                              
                               if(array_key_exists('$accompanyingitems[0]->accompanyingItemTypeID',$_GET)) {
                                $current_page = $_GET['$accompanyingitems[0]->accompanyingItemTypeID']; 
                                  
                               } 
                            
                               switch ($current_page) {
                                  case 1:
                                      include ('main_entities_profiles/religious_monument_profile.php');
                                      break;
                                  case 2:
                                      include ('main_entities_profiles/christian_orthodox_monument.php');
                                      break;
                                  case 3:
                                      include ('main_entities_profiles/artwork_profile.php');
                                      break;
                                  case 4:
                                      include ('main_entities_profiles/educational_foundation_profile.php');
                                      break;
                                  case '5':
                                      include ('main_entities_profiles/epigraph_profile.php');
                                      break;
                                  case '6':
                                      include ('main_entities_profiles/community_profile.php');
                                      break;
                                  case '7':
                                      include ('main_entities_profiles/cemetery_profile.php');
                                      break;
                                  case '13':
                                      include ('main_entities_profiles/archaeological_religious_monument_profile.php');
                                      break;
                                  case '14':
                                      include ('main_entities_profiles/archaeological_site_profile.php');
                                      break;
                                  case '15':
                                      include ('main_entities_profiles/fortress.php');
                                      break;
                                  case '16':
                                      include ('main_entities_profiles/tomb.php');
                                      break;
                                  case '17':
                                      include ('main_entities_profiles/museum.php');
                                      break;
                                  case '18':
                                      include ('main_entities_profiles/exhibition.php');
                                      break;
                                  case '19':
                                      include ('main_entities_profiles/administration_building.php');
                                      break;
                                  case '20':
                                      include ('main_entities_profiles/welfare_building.php');
                                      break;
                                  case '21':
                                      include ('main_entities_profiles/infrastructure_building.php');
                                      break;
                                  case '22':
                                      include ('main_entities_profiles/social_residential_building.php');
                                      break;
                                  case '23':
                                      include ('main_entities_profiles/coin_profile.php');
                                      break;
                                  case '24':
                                      include ('main_entities_profiles/person_profile.php');
                                      break;
                                  case '25':
                                      include ('main_entities_profiles/religious_event_profile.php');
                                      break;
                                  default:
                                      echo "An error occured!";
                                                  }

                            ?>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab-rent" role="tabpanel">
                      <div class="">
                        <div class="row">
                          <div class="blog-container classic" style="padding-top:0px;">
                              <article id="sy">
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


                  <div id="accompanaying_items">
                    <div class="widget">
                      <div class="category-column">
                			  <label class="form-check-label">
      					           <div class="checkbox-wrapper">
                      			<input class="form-check-input" type="checkbox" id="checked_have_child"><span class="indicator"></span>
                      		</div> <?php echo $lang['connect'] ?>
                      	</label>
                      </div>
                    </div>
                  </div>

                  <?php 
                    if(!IsNullOrEmpty($accs[0]->SingularDesc)){ ?>
                     <div class="widget">
                            <div class="category-column">
                              <h3><?php echo $lang['sinodeutiko_iliko'] ?></h3>
                              <ul>
                                <li id="ajax_li"><?php foreach ($accs as $acc) { ?>
                                    <a href="javascript:filterResults(<?php echo $acc->accompanyingItemTypeID?>,11)" ><?php echo ((isset($_GET['lang']) === false)?  $acc->SingularDesc : $acc->StandardName  ) ?><span class ="first_number" ><?php echo $acc->rowsum?></span> / <span class ="second_number" >162</span> </a>
                                </li><?php } ?>
                              </ul>
                            </div>
                      </div>
                  <?php } ?>



                    <?php 
                      if(!IsNullOrEmpty($regions[0]->rowsum)){ ?>
                        <div class="widget">
                            <div class="category-column">
                              <h3><?php echo $lang['locations'] ?></h3>
                              <ul>
                                <li><?php foreach ($regions as $region) { ?>
                                  <li>
                                     <a href="javascript:filterResults(30,14)" ><?php echo $lang['locations'] ?><span class ="first_number" ><?php echo $region->rowsum?></span>/ <span class ="second_number" >162</span> </a>
                                  </li>
                                  <?php } ?>
                                </li>
                               </ul>
                            </div>
                        </div>
                    <?php } ?>
                    

                    

                    <?php 
                      if(!IsNullOrEmpty($lists[0]->SingularDesc)){ ?>
                        <div class="widget">
                            <div class="category-column">
                              <h3> <?php echo $lang['kiria_ontotita'] ?></h3>
                              <ul>
                                <li><?php foreach ($lists as $list) { ?>
                                <li>
                                   <a href="javascript:filterResults(<?php echo $list->itemTypeID?>,12)" ><?php echo ((isset($_GET['lang']) === false)?  $list->SingularDesc : $list->StandardName  ) ?><span class ="first_number" ><?php echo $list->rowsum?></span>/ <span class ="second_number" >162</span> </a>
                                </li>
                                    
                                  <?php } ?>
                                </li>
                               </ul>
                            </div>
                        </div>
                    <?php } ?>
                    

                    <?php 
                      if(!IsNullOrEmpty($geophysicals[0]->SingularDesc)){ ?>
                        <div class="widget">
                            <div class="category-column">
                              <h3> <?php echo $lang['geofisiki_ontotita'] ?></h3>
                              <ul>
                                <li><?php foreach ($geophysicals as $geophysical) { ?>
                                <li>
                                    <a href="javascript:filterResults(<?php echo $geophysical->itemTypeID?>,13)" ><?php echo ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName  ) ?> <span class ="first_number" ><?php echo $geophysical->rowsum?></span> / <span class ="second_number" >162</span> </a>
                                </li>
                                 <!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->
                              <?php } ?>
                              </li>
                              </ul>
                            </div>
                        </div>
                    <?php } ?>
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
   
     <?php include ("inc/footer.php") ?>
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

      function NotShowItem($item) {
        if (IsNullOrEmpty($item))
          return "not-show";
        else
          return "";
      }
  

    // $("#ajax_li").click(function() {
    //         $("#not").css("display", "block");
    //     });



    // $('.ajax_li').each(function() {
    //         if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
    //             $(this).addClass('active').siblings().removeClass('active');
    //         }
    //     });



   $('#checked_have_child').click(function(){  //WHEN CHECKED THE NUMBER IS RED

       var checked =  $(this).is(':checked');


      if(checked){

      $(".second_number").css('color','red');
      $(".first_number").css('color','#643476');
    }

        else {
      $(".first_number").css('color','red');
      $(".second_number").css('color','#643476');


        }

    


      });


      function filterResults (itemTypeId,cat) {

      var value= $('#checked_have_child').is(':checked');

  
      var url = "ajax/filter_acc_relatios_with_acc_item.php?";
      url += "item_id=" + <?php echo $_GET['item_id']; ?>;
      url += "&item_type_id=" + itemTypeId;
      //url += "&current_item_type_id=" + <?php echo $_GET['item_type_id']; ?>;
      url += "&cat=" + cat;
      url += "&lang=<?php echo $_GET['lang']; ?>" ;

        if(value)
         url += "&related_children=1";
        else
          url += "&related_children=0";  


      $.ajax({  
        url: url,
        type: "GET",
        success: function (result) {
          console.log(result);
          $('#sy').html(result);
        },
        error: function(s){
          alert('kati pige poli stravaaa' + s);
        }
      });

    }



  $( document ).ajaxStart(function() { // molis patas kapoio link pou kalei to ajax ginete active to deutero tab
  $("#not" ).show();
  $("#not").removeClass("not-show");
  $("#tab-rent").addClass("active");
  $("#tab-all").removeClass("active");
  


  $("#not" ).show();
  $("#not").removeClass("not-show");
  $("#tabtwo").addClass("active");
  $("#tabone").removeClass("active");

});


  </script>
  </body>
</html>
