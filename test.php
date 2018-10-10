<?php 
require_once("inc/init.php");
require_once("inc/lang.php");
/* start of pagination*/
?>
   
<?php 
$currentPage = 1;
$offset = 0;
$num_of_pages = 0;

if(isset($_GET['page']) && is_numeric($_GET['page']))
{
  $currentPage = $_GET['page'];
}
$offset = ($currentPage - 1)  * $PAGE_SIZE;
//print_r($currentPage);

/* end of pagination*/



//session_start();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerRegion = new ControllerRegion();
$ControllerArchivedObject = new ControllerArchivedObject();
$ControllerMainUnities = new ControllerMainUnities();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();

$currentID = $_GET['ArchivedObjectID'];

$counts = $ControllerArchivedObject->getArchivedObjectWithID($_GET['ArchivedObjectID']);
$subcountries = $ControllerArchivedObject->getAllRegionsWithParentID($counts->ArchivedObjectID,$CultureID);
$brothers = $ControllerArchivedObject->getAllBrothersOfARegion($counts->ArchivedObjectID,$CultureID);
$father = $ControllerArchivedObject->getTheFatherOfAOfARegion($_GET['ArchivedObjectID'],$CultureID);
$allmainentities = $ControllerAccompanyingObject->getAllMainTypes();
$GetAllGeoentities = $ControllerMainUnities->getAllGeoUnities();
$getAllAccompanyingItemTypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$details = $ControllerRegion->getRegionDetailsWithID($_GET['ArchivedObjectID'],$CultureID);
$keywords = $ControllerRegion->getKeywordFromRegion($_GET['ArchivedObjectID'],$CultureID);
$chars = $ControllerRegion->getCharacterizationWithRegionID($_GET['ArchivedObjectID']);
$places = $ControllerRegion->getRegionsWithID($_GET['ArchivedObjectID']);
$map_details = $ControllerRegion->getRegionsWithID($_GET['ArchivedObjectID']);
//$relation_entities = $ControllerArchivedObject->getPointToRegion($_GET['ArchivedObjectID']);
$relation_entities = $ControllerArchivedObjectRelations->getPointToRegion($_GET['ArchivedObjectID']);
//print_r($relation_entities); 





//$apikey = "AIzaSyAEEH9bT4mLikLdYQwSKSrDNx4WBxJofGI";
//$id = $_GET['ArchivedObjectID'];
//print_r($mainunities);
//$lat = $places[0]->Latitude;
//$long = $places[0]->Longitude;
//print_r($long);
//print_r($lat);

 
  //$lat = 0;
  //$long = 0;
  //$zoom = 8;

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
    <title><?php echo $details[0]->FriendlyName?></title>
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
                <a class="breadcrumb-item" href="http://www.panorama.gr/website2/">ΑΡΧΙΚΗ &nbsp;/</a>
                <a class="breadcrumb-item" href="#">ΤΟΠΟΙ&nbsp; /</a>
                <a class="breadcrumb-item" href="region.php?ArchivedObjectID=<?php echo $father[0]->RegionID; ?>"><?php echo $father[0]->FriendlyName;?> &nbsp/</a>
                <span class="breadcrumb-item active"><?php echo $details[0]->FriendlyName; ?>&nbsp</span>
              </nav>

                <div class="row">
                  <!-- ************************************************************************* START OF SIDEBAR *************************************************************************** -->
                  <div class="col-md-4 col-lg-3">
                    <div class="sidebar" id="sidebar_region">
                      <div class="widget">
                         <ul class="nav actions flex-column">
                            <li class="nav-item featured nav-link sideborder">
                              <p style="font-size: 16px; text-align: center; color:#ffffff; margin-bottom:0px;"><?php echo $father[0]->FriendlyName;?></p>
                            </li>
                           <?php foreach ($brothers as $brother) { ?>
                            <li class="nav-item featured <?php echo ($brother->RegionID == $currentID ? 'active' : '') ?>">
                               <a href="region.php?ArchivedObjectID=<?php echo $brother->RegionID; ?>" class="nav-link">
                                 <?php echo ((isset($_GET['lang']) === false)?  $brother->FriendlyName : $brother->FriendlyName  ) ?>
                              </a>
                            </li>

                      
                         <?php } ?>
                        </ul>
                      </div>
                    </div>


                    <?php 
                      if (!IsNullOrEmpty($subcountries[0]->UniqueName)){ ?>

                     <div class="sidebar" id="">
                      <div class="widget">
                       
                          <ul class="nav actions flex-column">
                            <li class="nav-item featured nav-link sideborder">
                             
                            <p style="font-size: 16px; text-align: center; color:#ffffff; margin-bottom:0px;"><?php echo $lang['subareas'];?></p>
                              
                            </li>
                             <?php foreach ($subcountries as $subcountry) { ?>
                            <li class="nav-item featured">
                              <a href="region.php?ArchivedObjectID=<?php echo $subcountry->ArchivedObjectID; ?>" class="nav-link">
                                <?php echo $subcountry->FriendlyName; ?>
                              </a>
                            </li>
                            <?php } ?>
                          </ul>
                      </div>
                    </div>
                    <?php  } ?>
                 </div> 


                   
                 


                  <!-- ************************************************************************* END OF SIDEBAR *************************************************************************** -->



                  <!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->
               
            <div class="col-md-4 col-lg-6 col-md-push-3">
                <div class="" id="">
                    <div class="listing-tabs-header">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a id="tabone" class="nav-link active" href="#tab-all" data-toggle="tab"><?php echo $lang['basicdetails']; ?></a>
                            </li>
                            <li class="nav-item not-show" id="not">
                              <a id="tabtwo" class="nav-link " href="#tab-rent" data-toggle="tab"><span id="innertitle"><!-- <?php echo $lang['sinodeutiko_iliko']; ?> --></span></a>
                            </li>
                        </ul>
                    </div>
                  <div class="tab-content">

                  
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">

                          <?php foreach ($details as $detail) { ?>
                          <?php if(!IsNullOrEmpty($details[0]->Summary)){ ?> 
                            <div class="box">
                             
                             <?php echo $detail->Summary;?>
                             
                            </div>
                          <?php  } ?>
                          <?php  } ?>

                      
                                <table class="table table-bordered opening-hours">
                                  <tbody>
                                    <?php foreach ($details as $detail) { ?>
                                    
                                    <!--   <?php 
                                    if(!IsNullOrEmpty($details[0]->FriendlyName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['FriendlyName']; ?></th>
                                        <td><?php echo $detail->FriendlyName?></td>
                                      </tr>
                                      <?php  } ?> -->
                                      <?php if(!IsNullOrEmpty($details[0]->FriendlyName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['koini_onomasia']; ?></th>
                                        <td><?php echo $detail->FriendlyName?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($details[0]->LocalName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['LocalName']; ?></th>
                                        <td><?php echo $detail->LocalName?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php 
                                    	if(!IsNullOrEmpty($details[0]->PhoneticTranscription)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['phoneticTranscription']; ?></th>
                                        <td><?php echo $detail->PhoneticTranscription?></td>
                                      </tr>
                                      <?php } ?> 

                                      <?php 
                                    	if(!IsNullOrEmpty($details[0]->OfficialName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['OfficialName']; ?></th>
                                        <td><?php echo $detail->OfficialName?></td>
                                      </tr>
                                      <?php } ?>
                                     <?php } ?>


                                        <?php if(!IsNullOrEmpty($relation_entities[0]->UniqueName)){ ?>
                                        <?php foreach ($relation_entities as $relation){ ?>
                                             <tr><td> <?php echo $lang['relation_entities']; ?>
                                                <th class="min-width center"><?php echo ($relation->itemType) ? $relation->itemType : '' . " " . $relation->UniqueName .'</br>'?></th>
                                                 
                                                            
                                                        <?php } ?></td>
                                            </tr>
                                        <?php } ?>


                                        <?php if(!IsNullOrEmpty($relation_entities[0]->UniqueName)){ ?>
                                         <tr>
                                        <th class="min-width center"><?php echo $lang['relation_entities']; ?></th>
                                        <td></td>
                                      </tr>
                                        <?php foreach ($relation_entities as $relation){ ?>
                                             <tr><td> 
                                                <th class="min-width left"><?php echo ($relation->itemType) ? $relation->itemType : '' . " " . $relation->UniqueName .'</br>'?></th>
                                                 
                                                            
                                                        <?php } ?></td>
                                            </tr>
                                        <?php } ?>

                                  </tbody>
                                </table>


                                
                                         <?php 
                                          if(!IsNullOrEmpty($details[0]->OfficialName)){ ?>
                                         <table id="tablemargin" class="table table-bordered opening-hours">
                                            <thead align="left" style="display: table-header-group">
                                           
                                            <tr>
                                               <th class="min-width left"><?php echo $lang['view']; ?> </th>
            
                                            </tr>
                                             
                                            </thead>
                                          <tbody>

                                           <?php foreach ($relation_entities as $relation){ ?>
                                            <tr>
                                              <td><?php echo ($relation->itemType) ? $relation->itemType : '' . " " . $relation->UniqueName .'</br>'?></td>
                                            
                                              <?php } ?>
                                          </tbody>
                                          </table>
                                        <?php } ?>
                                              
                                

                                                         
                           <?php if(count($chars) > 0){?>
                            <h3><?php echo $lang['character'];?></h3>
                            <div class="table boxcustompadding">
                              <div class="box-inner">
                                <ul class="amenities">
                                 <?php foreach ($chars as $char){ ?>
                                  <li class="yes"><?php echo $char->RegionCharacterName?></li>
                                 <?php } ?>
                                </ul>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if(count($keywords) > 0){?>
                              <h3><?php echo $lang['keywords'];?></h3>
                                <div class="box">
                                  <div class="box-inner">
                                    <?php foreach ($keywords as $keywordd){ ?>
                                      <?php echo " " . " " . $keywordd->KeywordTranslation . " " . "|" ?>
                                    <?php } ?>
                                  </div>
                                </div>
                            <?php } ?>
                            
                            	 <?php if(!IsNullOrEmpty($map_details[0]->Latitude)){ ?>
                                <div class="listing-detail-section" id="listing-detail-section-map-position" data-title="<?php echo $lang['Map'];?>">
                                  <h2><?php echo $lang['Map'];?></h2>
<!--                                    <iframe class="mb30" style="height:320px;width:100%;border:0;"-->
<!--                                          src="https://www.google.com/maps/embed/v1/place?q=--><?php //echo $map_details->latitude?><!--,--><?php //echo $map_details->longitude ?><!--&key=AIzaSyAEEH9bT4mLikLdYQwSKSrDNx4WBxJofGI">-->
<!--                                    </iframe>-->
                                    <iframe class="mb30" style="height:320px;width:100%;border:0;"
                                            src="https://www.google.com/maps/embed/v1/place?q=<?php echo $map_details[0]->Latitude?>,<?php echo $map_details[0]->Longitude ?>&key=AIzaSyCW5CHvLGwaYpXIvB4s8pSzlr81YmCXhzg&zoom=5&maptype=satellite">
                                    </iframe>

                                  <!--   <iframe class="mb30" style="height:320px;width:100%;border:0;"
                                    src="https://www.google.com/maps/embed/v1/view?key=AIzaSyCW5CHvLGwaYpXIvB4s8pSzlr81YmCXhzg&zoom=5&maptype=satellite&center=<?php echo $map_details[0]->Latitude?>,<?php echo $map_details[0]->Longitude ?>">
                                    </iframe> -->
                                </div>
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
<!-- ************************************************************************* END OF MAIN PAGE *************************************************************************** -->


<!-- ************************************************************************* START OF RIGHT SIDEBAR *************************************************************************** -->
              
            <div class="col-md-4 col-lg-3">
                <div class="sidebar" id="sidebar_two_region">

                    <?php

                    $acc_flag = false;
                    foreach ($getAllAccompanyingItemTypes as $accitemtype) {
                        $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['ArchivedObjectID'],$accitemtype->accompanyingItemTypeID,$CultureID);
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
                                            <?php $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['ArchivedObjectID'],$accitemtype->accompanyingItemTypeID,$CultureID); ?>

                                            <?php if (intval($sk->rowsum) > 0 ) { ?>
                                          <li>
                                          	<?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $accitemtype->SingularDesc : $accitemtype->StandardName) ?>
                                            <a href="javascript:filterResults(<?php echo $accitemtype->accompanyingItemTypeID?>,11,<?php echo $sk->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo $accitemTypeDescription;  ?><span><?php echo $sk->rowsum?></span> </a>
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

                   <?php

                    $acc_flag = false;
                    foreach ($allmainentities as $one) {
                        $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['ArchivedObjectID'],$one->itemTypeID,$CultureID);
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
            							            <?php $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['ArchivedObjectID'],$one->itemTypeID,$CultureID); ?>
                                      <?php if (intval($mainunities->rowsum) > 0 ) { ?>
	                            			    <li class="li-content">
	                            			    <?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $one->SingularDesc : $one->StandardName) ?>
                                          <a href="javascript:filterResults(<?php echo $one->itemTypeID?>,12,<?php echo $mainunities->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo $accitemTypeDescription;  ?><span><?php echo $mainunities->rowsum?></span></a>
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

                    

                   <?php  $acc_flag = false;
                    foreach ($GetAllGeoentities as $geoentity) {
                        $geophysicals = $ControllerRegion->getCountOfGeophysicalObjectsRelatedOfRegions($_GET['ArchivedObjectID'],$geoentity->itemTypeID);
                        if (intval($geophysicals->rowsum) > 0 ){
                            $acc_flag =true;
                        }
                       } ?>
                    <?php if($acc_flag){ ?>  
                    <div id="geophysical">
                        <div class="widget">
                            <div class="category-column">
                                <h3 id="geophysical_title"><?php echo $lang['geofisiki_ontotita'] ?></h3>
                              <ul>
                                <li><?php foreach ($GetAllGeoentities as $geoentity) { ?>
                                <ul>
                                  <?php $geophysicals = $ControllerRegion->getCountOfGeophysicalObjectsRelatedOfRegions($_GET['ArchivedObjectID'],$geoentity->itemTypeID); ?>
                                    <?php if (intval($geophysicals->rowsum) > 0 ) { ?>
                                <li>
                                <?php $accitemTypeDescription = ((isset($_GET['lang']) === false)?  $geoentity->SingularDesc : $geoentity->StandardName) ?>
                                    <a href="javascript:filterResults(<?php echo $geoentity->itemTypeID?>,13,<?php echo $geophysicals->rowsum?>,1,'<?php echo $accitemTypeDescription ?>' )" ><?php echo $accitemTypeDescription;  ?> <span><?php echo $geophysicals->rowsum?></span> </a>
                                </li>
                              <?php } ?>
                              </ul>
                            </li>
                              <?php } ?>
                            </ul>
                            </div>
                        </div>
                    </div>

               <?php }?> 
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
          <!--<ul class="nav flex-column">
            <li class="nav-item"><a href="admin-dashboard.html" class="nav-link">Author Dashboard</a></li>
           
          </ul>-->
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
      //       $("#not").css("display", "block");
      //   });

      //  $('.ajax_li').each(function() {
      //       if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
      //           $(this).addClass('active').siblings().removeClass('active');
      //       }
      //   });

  
      function filterResults (itemTypeId,cat,rowsum,page,itemTypeDescription) {
        //console.log(cat);
        //console.logJSON.stringify(cat)
      var url = "ajax/filter_relations_with_region.php?";
      url += "id=" + <?php echo $_GET['ArchivedObjectID']; ?>;
      url += "&rowsum=" + rowsum;
      url += "&accompanyingItemTypeID=" + itemTypeId;
      url += "&cat=" + cat;
      url += "&page=" + page;
      url += "&lang=<?php echo $_GET['lang']; ?>" ;


      //console.log(url);
      $.ajax({  
        url: url,
        type: "GET",
        //data:{accompanyingItemTypeID: this.attr("title")}
        success: function (result) {
          //console.log(result);
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

  
  //$('#innertitle').text(function(i,title, oldText) {
     // 

 //if (title == 1)
 // alert('title');
  //return oldText === '<?php echo $lang['sinodeutiko_iliko']; ?>' ? '<?php echo $lang['sinodeutiko_iliko']; ?>' : oldText;
      //document.getElementById('yourElementId').title = 'your new title';


   //   var current_type = <?php echo $accitemtype->accompanyingItemTypeID?> ;

      // if (current_type == 1)
      //   return oldText === '<?php echo $lang['sinodeutiko_iliko']; ?>' ? 'New word' : oldText;
      // else (current_type == 2){
      //    return oldText === '<?php echo $lang['sinodeutiko_iliko']; ?>' ? '<?php echo $lang['bibliography_list']; ?>' : oldText;
   
    

    //});
  });










 
      $( document ).ready(function() { //KRIVEI TO DIVS STO DEKSI SIDEBAR AN EINAI KENA
          //
          // var personalDetails = $("#personaldetails");
          // var personaldetails_title = $("#personaldetails_title");
          //
          // // var accompanaying_items = $("#accompanaying_items");
          // // var accompanaying_items_title = $("#accompanaying_items_title");
          //
          // var geophysical = $("#geophysical");
          // var geophysical_title = $("#geophysical_title");
          //
          //
          // var personalDetails_text = $.trim(personalDetails.text());
          // var personalDetails_text_title = $.trim(personaldetails_title.html());
          //
          // // var accompanaying_items_text = $.trim(accompanaying_items.text());
          // // var accompanaying_items_text_title = $.trim(accompanaying_items_title.html());
          //
          // var geophysical_text = $.trim(geophysical.text());
          // var geophysical_text_title = $.trim(geophysical_title.html());
          //
          //
          // if(personalDetails_text.length===personalDetails_text_title.length)
          //     personalDetails.hide();
          // else
          //     personalDetails.show();
          //
          // // if(accompanaying_items_text.length===accompanaying_items_text_title.length)
          // //     accompanaying_items.hide();
          // // else
          // //     accompanaying_items.show();
          //
          //
          // if(geophysical_text.length===geophysical_text_title.length)
          //     geophysical.hide();
          // else
          //     geophysical.show();

      });
  </script>
  </body>
</html>
