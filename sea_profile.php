<?php 

require_once ("inc/init.php");

require_once ("inc/lang.php");


//session_start();

$ControllerMainUnities = new ControllerMainUnities();
$ControllerSea = new ControllerSea();
$ControllerGeophysical = new ControllerGeophysical();
$ControllerKeyword = new ControllerKeyword();
$ControllerArchivedObject =  new ControllerArchivedObject();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();

$allmainentities = $ControllerAccompanyingObject->getAllMainTypes();
$GetAllGeoentities = $ControllerMainUnities->getAllGeoUnities();
$getAllAccompanyingItemTypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$geos = $ControllerMainUnities->getAllGeoUnities();
$seadetails = $ControllerSea->getSeaDetailWithID($_GET['id'],$CultureID);
$kinds = $ControllerGeophysical->getKindOfGeophysical($_GET['id'],$CultureID); 
$keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 
//$seas = $ControllerSea->getSeaWithID($_GET['id']);
$relation_entities = $ControllerArchivedObject->getRelationEntitiesOfArchivedObjectID($_GET['id']);
$map_details = $ControllerSea->getSeaWithID($_GET['id']);
//$sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id']);
//$mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
//$geophysicals = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id']);

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

                <a class="breadcrumb-item" href="http://www.panorama.gr/website2/">Αρχική &nbsp;/</a>

                <a class="breadcrumb-item" href="#">Γεωφυσικές Οντότητες &nbsp;/</a>

                <a class="breadcrumb-item" href="#"><?php echo $lang['sea'];?> &nbsp;/</a>

                <span class="breadcrumb-item active"><?php echo $seadetails[0]->FriendlyName ?></span>

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
                          <li class="nav-item featured"><a href="geophysical_entity.php?item_type_id=<?php echo $geo->itemTypeID; echo $langParam;?>" class="nav-link "><?php echo ((isset($_GET['lang']) === false)?  $geo->PluralDesc : $geo->StandardName  ) ?></a>
                          </li>
                          <?php } ?>

                        </ul>

                    </div>

                  </div>

                 </div> 





                  <!-- ************************************************************************* END OF SIDEBAR *************************************************************************** -->







                  <!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->

               

            <div class="col-md-4 col-lg-6 col-md-push-3">

                <div class="" id="">

                    <div class="listing-tabs-header">

                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">

                              <a id="tabone" class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['otherdetails']; ?></a>

                            </li>

                            <li class="nav-item not-show" id="not">

                              <a id="tabtwo" class="nav-link" href="#tab-rent" data-toggle="tab"><span id="innertitle"><!-- <?php echo $lang['sinodeutiko_iliko']; ?> --></span></a>

                            </li>

                        </ul>

                    </div>

                  <div class="tab-content">

                    <div class="tab-pane active" id="tab-all" role="tabpanel">

                      <div class="listing-boxes">

                   
                            


                            <table class="table table-bordered opening-hours">
                              <tbody>
                                <?php foreach ($seadetails as $seadetail) { ?>

                                  
                                      <?php if(!IsNullOrEmpty($seadetails[0]->FriendlyName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['FriendlyName']; ?></th>
                                        <td><?php echo $seadetail->FriendlyName?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($seadetails[0]->OfficialName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['OfficialName']; ?></th>
                                        <td><?php echo $seadetail->OfficialName?></td>
                                      </tr>
                                      <?php  } ?>
                                   <?php  } ?>
                                </tbody>
                              </table>

                                  
          
                            <?php if(count($keywords) > 0){?>
                              <button style="color:#7f7f7f; width: 100%; background-color: #ffffff; box-shadow: 0 1px 2px rgba(50, 50, 50, 0.12); text-align: left;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#keyword"></i><h3><?php echo $lang['keywords']; ?><i style="padding-left: 10px;" class="fa fa-angle-down"></i></h3></button>


                              <div id="keyword" class="collapse">


                                <div class="box">
                                  <div class="box-inner">
                                    <?php foreach ($keywords as $keywordd){ ?>
                                    <?php echo " " . " " . $keywordd->KeywordTranslation . " " . "|" ?>
                                    <?php } ?>
                                  </div>
                                </div>

                              </div>
                              <?php  } ?>



                               <?php if(count($kinds) > 0){?>
                                 <div class="table boxcustompadding">
                                   <h3><?php echo $lang['kind'];?></h3>
                                   <hr>
                                   <div class="box-inner">
                                     <ul class="amenities">
                                      <?php foreach ($kinds as $kind){ ?>
                                      <li class="yes"><?php echo $kind->LookupValue?></li>
                                      <?php } ?>
                                    </ul>
                                  </div>
                                </div>
                              <?php } ?>


                             <?php if (count($relation_entities) > 0) { ?>
                              <button style="color:#7f7f7f; width: 100%; background-color: #ffffff; box-shadow: 0 1px 2px rgba(50, 50, 50, 0.12); text-align: left;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><h3><?php echo $lang['relation_entities'];?><i style="padding-left: 10px;" class="fa fa-angle-down"></i></h3></button>

                            <div id="demo" class="collapse">

                              <table class="table table-bordered opening-hours">
                                  <thead>
                                      <tr>
                                        <th width="25%">Τύπος Οντότητας</th>
                                        <th width="30%">Ονομασία ΑΠΑΝ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($relation_entities as $relation) { ?>
                                      <tr>
                                          <td><?php echo ($relation->itemType) ? $relation->itemType : 'Τόπος' . " " ?></td>
                                          <td> <?php echo $relation->uniqueName ?>
                                              
                                          </td>
                                       
                                      </tr>
                                    <?php } ?>
                                   </tbody>
                              </table>
                            </div>
                          <?php } ?>


                        <?php if(!IsNullOrEmpty($map_details[0]->latitude)){ ?>

                        <a href="#" class="button btn buttonpadding" id="modal-action-submit" data-toggle="modal" data-target="#modal-submit">
                          <button type="submit" class="btn"><span class="font_size_button"><?php echo $lang['Map'];?></span></h3></button>
                        </a>
                        <?php  } ?> 


                   

                        </div>

                    </div>



                      <div class="tab-pane not-show" id="tab-rent" role="tabpanel">

                        <div class="listing-boxes">

                          <div id="sy">



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

                                  $acc_flag = false;

                                  foreach ($getAllAccompanyingItemTypes as $accitemtype) {

                                    $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id'],$accitemtype->accompanyingItemTypeID,$CultureID);

                                    if (intval($sk->rowsum) > 0 ){

                                      $acc_flag =true;

                                    }

                                  } ?>

                                  <?php if($acc_flag){ ?>

                                  <div id="accompanaying_items">

                                    <div class="widget">

                                     <div class="category-column">

                                      <h3 id="accompanaying_title"><?php echo $lang['sinodeutiko_iliko'] ?></h3>

                                      <ul>

                                        <li id="ajax_li"><?php foreach ($getAllAccompanyingItemTypes as $accitemtype) { ?>

                                          <ul>

                                            <?php $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id'],$accitemtype->accompanyingItemTypeID,$CultureID); ?>



                                            <?php if (intval($sk->rowsum) > 0 ) { ?>

                                            <li>

                                             <?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $accitemtype->SingularDesc : $accitemtype->StandardName) ?>

                                             <a href="javascript:filterResultsForGeo(<?php echo $accitemtype->accompanyingItemTypeID?>,11,<?php echo $sk->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo $accitemTypeDescription;  ?><span class ="first_number" ><?php echo $sk->rowsum?> </span>/ <span class ="second_number" >162</span> </a>

                                           </li>

                                           <!-- ((isset($_GET['lang']) === false)?  $accitemtype->SingularDesc : $accitemtype->StandardName  ) -->

                                           <?php } ?>

                                         </ul>

                                       </li>

                                       <?php } ?>

                                     </ul>

                                   </div>

                                 </div>

                               </div>

                               <?php }?>



                           <?php $acc_flag = false;

                               foreach ($allmainentities as $one) {

                                $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id'],$one->itemTypeID,$CultureID);

                                if (intval($mainunities->rowsum) > 0 ){

                                  $acc_flag =true;

                                }

                              } ?>

                              <?php if($acc_flag){ ?>

                              <div id="personaldetails">

                                <div class="widget">

                                  <div class="category-column">

                                    <h3 id="personaldetails_title"> <?php echo $lang['kiria_ontotita'] ?></h3>

                                    <ul>

                                     <li><?php foreach ($allmainentities as $one) { ?>

                                      <ul>

                                       <?php $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id'],$one->itemTypeID,$CultureID); ?>

                                       <?php if (intval($mainunities->rowsum) > 0 ) { ?>

                                       <li class="li-content">

                                        <?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $one->SingularDesc : $one->StandardName) ?>

                                        <a href="javascript:filterResultsForGeo(<?php echo $one->itemTypeID?>,12,<?php echo $mainunities->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo $accitemTypeDescription;  ?><span><?php echo $mainunities->rowsum?></span></a>

                                      </li>



                                      <?php  } ?>



                                    </ul>

                                  </li>

                                  <?php } ?>

                                </ul>

                              </div>

                            </div>

                          </div>

                          <?php }?>


                          <?php

                            $acc_flag = false;
                            foreach ($GetAllGeoentities as $geophysical) {
                                $geos = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id'],$geophysical->itemTypeID,$CultureID);
                                if (intval($geos->rowsum) > 0 ){
                                    $acc_flag =true;
                                }
                               } ?>
                            <?php if($acc_flag){ ?>

                           
                                <div class="widget">
                                    <div class="category-column">
                                      <h3><?php echo $lang['geofisiki_ontotita'] ?></h3>
                                      <ul>
                                       <li><?php foreach ($GetAllGeoentities as $geophysical) { ?>
                                        <ul>
                                          <?php $geos = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id'],$geophysical->itemTypeID,$CultureID); ?>

                                          <?php if (intval($geos->rowsum) > 0 ) { ?>

                                        <li>

                                        <?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName) ?>


                                            <a href="javascript:filterResultsForGeo(<?php echo $geophysical->itemTypeID?>,13,<?php echo $geos->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName  ) ?> <span class ="first_number" ><?php echo $geos->rowsum?></span>/<span class ="second_number" >162</span> </a>
                                        </li>
                                      <?php } ?>
                                      </ul>
                                        </li>
                                         <?php } ?>
                                       </ul>
                                    </div>
                                </div>
                                <?php  } ?>



               

                   

                    <!--  <?php 

                      if(!IsNullOrEmpty($geophysicals[0]->SingularDesc)){ ?>

                        <div class="widget">

                            <div class="category-column">

                              <h3><?php echo $lang['geofisiki_ontotita'] ?></h3>

                              <ul>

                               <li><?php foreach ($geophysicals as $geophysical) { ?>

                                <li>

                                    <a href="javascript:filterResultsForGeo(<?php echo $geophysical->itemTypeID?>,13)" ><?php echo ((isset($_GET['lang']) === false)?  $geophysical->SingularDesc : $geophysical->StandardName  ) ?> <span><?php echo $geophysical->rowsum?></span> </a>

                                </li>

                                 <!--<li onclick ="filterResults('aaa');" class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li>-->

                              <?php } ?>

                              </li>

                              </ul>

                            </div>

                      </div>



                    <?php  } ?> -->



                         

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


<div id="modal-submit" class="modal fade">    
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe class="mb30" style="height:450px;width:100%;border:0;"
            src="https://www.google.com/maps/embed/v1/place?q=<?php echo $map_details[0]->latitude?>,<?php echo $map_details[0]->longitude ?>&key=AIzaSyCW5CHvLGwaYpXIvB4s8pSzlr81YmCXhzg&zoom=5&maptype=satellite">
            </iframe>
          </div>
        </div>
      </div>
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

  

      function filterResultsForGeo (itemTypeId,cat,rowsum,page,itemTypeDescription) {

        //console.log(cat);

        //console.logJSON.stringify(cat)

        //console.log(JSON.stringify(cat));



      var url = "ajax/filter_sea_relations_with_all.php?";

      url += "id=" + <?php echo $_GET['id']; ?>;

      url += "&rowsum=" + rowsum;

      url += "&accompanyingItemTypeID=" + itemTypeId;

      url += "&cat=" + cat;

      url += "&page=" + page;

      url += "&lang=<?php echo $_GET['lang']; ?>" ;





      $.ajax({  

        url: url,

        type: "GET",

        success: function (result) {

          console.log(result);

          $('#sy').html(result);

          $('#innertitle').text(itemTypeDescription);



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



  $( function() {

    $( "#accordion" ).accordion({

      collapsible: true

    });

  } );



  



  </script>

  </body>

</html>



