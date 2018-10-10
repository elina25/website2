<?php 
require_once ("inc/init.php");
require_once ("inc/lang.php");

//session_start();

$controllerMainUnities = new ControllerMainUnities();
$ControllerPerson = new ControllerPerson();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$ControllerKeyword = new ControllerKeyword();

// $details = $ControllerPerson->getPersonFromPersonID($_GET['id']);
// $detailss = $ControllerPerson->getPersonWithID($_GET['id'],$CultureID); 
// $types = $ControllerAccompanyingObject->getItemTypeFromItemID($_GET['id']);
// $unities = $controllerMainUnities->getAllMainUnitiesItemTypes();
// $geos = $controllerMainUnities->getAllGeoUnities();
// $themes = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
// $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id']);
// $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
// $geophysicals = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id']);
// $keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 




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
    <title><?php echo $lang['person']; ?></title>
  </head>
  <body class="">
    <div class="page-wrapper">
      <div class="header-wrapper">
          <?php include('inc/header.php') ?>
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
                 <?php foreach ($details as $detail) { ?>
                  <h1><?php echo $detail->fullName;?></h1>
                  <?php } ?>
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
               <a class="breadcrumb-item" href="#">Αρχική</a>
                <a class="breadcrumb-item" href="#">Κύριες Οντότητες</a>
                <a class="breadcrumb-item" href="#">Άνθρωπος</a>
                <span class="breadcrumb-item active"><?php echo $details[0]->fullName ?></span>
              </nav>

                <div class="row">
                  <!-- ************************************************************************* START OF SIDEBAR *************************************************************************** -->
             


                  <div class="col-md-4 col-lg-3">
                      <div class="sidebar" id="sidebar_region">
                      <div class="widget">
                        <ul class="nav actions flex-column">
                          <li class="nav-item featured nav-link">
                             <p style="font-size: 20px; text-align: center; color:#ffffff; margin-top:0px;"><?php echo $lang['geofisiki_ontotita'];?></p>
                              
                          </li>
                            <?php foreach($geos as $geo) { ?>
                             <li class="nav-item featured"><a href="geophysical_entity.php?item_type_id=<?php echo $geo->itemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $geo->PluralDesc : $geo->StandardName  ) ?></a></li>

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


                      	<?php if (count($detailss) > 0){?>
                          <div class="listing-detail-section" id="listing-detail-section-details" data-title="<?php echo $lang['details']; ?>">
                              <h2><?php echo $lang['details']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <?php foreach ($detailss as $detaill) { ?>
				                            <?php

				                                MakeItemList($detaill, 'fullName', $lang);
				                                MakeItemList($detaill, 'relatives', $lang);
				                                MakeItemList($detaill, 'profession', $lang);
				                                MakeItemList($detaill, 'biographicalData', $lang);
				                                MakeItemList($detaill, 'remarks', $lang);
				                                MakeItemList($detaill, 'specialIssues', $lang);
				                                MakeItemList($detaill, 'comments', $lang);  ?>
				                              
										<?php } ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <?php } ?>


                        <?php 
                          if(!IsNullOrEmpty($keywords[0]->KeywordTranslation)){ ?>
                            <div class="listing-detail-section" id="listing-detail-section-keyword" data-title="<?php echo $lang['keyword']; ?>">
                              <h2><?php echo $lang['keyword']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                           <?php foreach ($keywords as $keywordd){ ?>
                                                <?php echo $keywordd->KeywordTranslation . " " . "|"?>
                                            <?php } ?>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        <?php } ?>
                    



                          <div class="entry-summary">
                            <?php foreach ($parents as $parent) { ?>
                            <?php MakeItemList($parent, 'UniqueName', $lang); ?>
                            <?php } ?>

                          </div>

                         <!-- <div class="entry-summary">
                            <?php foreach ($details as $detail) { ?>

                              <p class="entry-content"><?php echo $lang['webaccess'] ?>&nbsp;&nbsp;<?php if ($details['0']->WebAccess == 1){  
                                echo $lang['administrators'];
                                  } else if ($details['0']->WebAccess == 2){ 
                                  echo $lang['researcher'];
                                  }  else if ($details['0']->WebAccess == 3){ 
                                  echo $lang['subscriber'];
                                } else{
                                  echo $lang['audience'] ;
                                } ?></p>
                              <p><?php echo $lang[''] ?><?php if ($details['0']->Imprimatur == 1) {
                                  echo $lang['EN'];
                                } else {
                                  echo $lang['GR'];
                                } ?>
                                <input type="checkbox" name="tag_3" id="tag_3" value="yes" <?php echo ($Imprimatur['tag_3']== 0 ? 'checked' : '' );?>></p><br/>


                          	<?php } ?>
                          </div>-->
          
                       

                       
                      </div>
                    </div>
                    <div class="tab-pane not-show" id="tab-rent" role="tabpanel">
                      <div class="listing-boxes">
                        <div class="row">
                          <div class="blog-container classic" style="padding-top:4details0px;">
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
                  <div class="sidebar" id="sidebar_two_region">

                  <?php 
                    if(!IsNullOrEmpty($sk[0]->SingularDesc)){ ?>
                     <div class="widget">
                            <div class="category-column">
                              <h3><?php echo $lang['sinodeutiko_iliko'] ?></h3>
                              <ul>
                                 <li><?php foreach ($sk as $sks) { ?>
                                  <li>
                                   <a href="javascript:filterResultsForPerson(<?php echo $sks->accompanyingItemTypeID?>,11)" ><?php echo ((isset($_GET['lang']) === false)?  $sks->SingularDesc : $sks->StandardName  ) ?><span><?php echo $sks->rowsum?></span> </a>
                                  </li>
                                    <!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->
                                  </li><?php } ?>
                  							</ul>
                            </div>
                      </div>
                       <?php  } ?>

                    <?php 
                      if(!IsNullOrEmpty($mainunities[0]->SingularDesc)){ ?>
                        <div class="widget">
                            <div class="category-column">
                              <h3><?php echo $lang['kiria_ontotita'] ?></h3>
                              <ul>
                                <li><?php foreach ($mainunities as $mainunity) { ?>
                                <li>
                                   <a href="javascript:filterResultsForPerson(<?php echo $mainunity->itemTypeID?>,12)" ><?php echo ((isset($_GET['lang']) === false)?  $mainunity->SingularDesc : $mainunity->StandardName  ) ?><span><?php echo $mainunity->rowsum?></span> </a>
                                </li>
                                    <!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->
                                  <?php } ?>
                               </ul>
                            </div>
                        </div>
                        <?php } ?>
                   
                      <?php 
                        if(!IsNullOrEmpty($geophysicals[0]->SingularDesc)){ ?>
                        <div class="widget">
                            <div class="category-column">
                              <h3><?php echo $lang['geofisiki_ontotita'] ?></h3>
                              <ul>
                               <li><?php foreach ($geophysicals as $geophysical) { ?>
                                <li>
                                    <a href="javascript:filterResultsForPerson(<?php echo $geophysical->itemTypeID?>,13)" ><?php echo ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName  ) ?> <span><?php echo $geophysical->rowsum?></span> </a>
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


        function NotShowItem($item) {
        if (IsNullOrEmpty($item))
          return "not-show";
        else
          return "";
      }
  
      function filterResultsForPerson (itemTypeId,cat) {
        //console.log(cat);
        //console.logJSON.stringify(cat)

      var url = "ajax/filter_person_relation_with_all.php?";
      url += "id=" + <?php echo $_GET['id']; ?>;
      url += "&accompanyingItemTypeID=" + itemTypeId;
      url += "&cat=" + cat;

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
  

  </script>
  </body>
</html>

