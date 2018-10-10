	<?php
require_once("inc/lang.php");
require_once("inc/init.php");

$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerArchivedObject = new ControllerArchivedObject();
$ControllerMainUnities = new ControllerMainUnities();
$geos = $ControllerMainUnities->getAllGeoUnities();
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$countries = $ControllerArchivedObject->getAllRegionsWithNoParent($CultureID);

?>

	

		<div class="header">
          <div class="container">
            <div class="header-inner">
              <div class="navigation-toggle toggle">
                <span></span>
                <span></span>
                <span></span>
              </div>
              <!-- /.header-toggle -->
              <div class="header-logo">
                <a href="index.html" class="header-title"></a>
                <a href="http://apanarchive.gr/website2/">
                  <img id="imgheader" src="./assets/images/logo_laskaridis.png" alt="Logo">
                </a>
              </div>
              <div class="header-logo">
                <a href="index.html" class="header-title"></a>
                <a href="http://apanarchive.gr/website2/">
                  <img src="./assets/images/apan-logo-gr.jpg" alt="Logo">
                </a>
              </div>
              <!-- /.header-logo -->
              <div class="header-nav">
                <div class="primary-nav-wrapper">
                  <ul id="menu" class="nav parent">
                    <li class="nav-item has-sub-menu menu-item">
                      <a href="#" class="nav-link" id="menu-item1"><?php echo $lang['locations']; ?></a>
                      <ul class="sub-menu" id="sub-menu1">
                       <?php foreach ($countries as $country) { ?>
							         <li class="sub-menu-item1" id="sub-menu-item1"><a href="region.php?ArchivedObjectID=<?php echo $country->RegionID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>">
									       <?php echo $country->FriendlyName; ?></a></li>
						          <?php } ?>	
                      </ul>
                    </li>

                    <li class="nav-item has-sub-menu menu-item current">
                     <a href="accompanying_item.php<?php echo (isset($_GET['lang']))? "?lang=".$_GET['lang']:''; ?>" class="nav-link "><?php echo $lang['sinodeutiko_iliko']?></a>
                      <ul class="sub-menu">
                       <?php foreach ($itemtypes as $itemtype) { ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==5) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo $langParam;?>" class=""><?php echo $lang['audiovisual_list'] ?></a></li>
                       <?php } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==1) { ?>
                          <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==2) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php }   ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==3) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==6) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==7) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==8) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==9) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                        <?php if ($itemtype->accompanyingItemTypeID ==4) { ?>
                        <li><a href="accompanying_item.php?item_type_id=<?php echo $itemtype->accompanyingItemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->SingularDesc : $itemtype->StandardName  ) ?></a></li>
                        <?php  } ?>
                         <?php  } ?>

                      </ul>
                    </li>

                    <li class="nav-item has-sub-menu menu-item">
                      	<!--<a href="geophysical_entities.php<?php echo (isset($_GET['lang']))? "?lang=".$_GET['lang']:''; ?>" class="nav-link "><?php echo $lang['geofisiki_ontotita'] ?></a>-->
                        <a href="#" class="nav-link"><?php echo $lang['geofisiki_ontotita'] ?></a>
					            <ul class="sub-menu" id="sub-menu2">
                          <?php foreach($geos as $geo) { ?>
                            <li><a href="geophysical_entity.php?item_type_id=<?php echo $geo->itemTypeID; echo (isset($_GET['lang']))? "&lang=".$_GET['lang']:'';?>"><?php echo ((isset($_GET['lang']) === false)?  $geo->PluralDesc : $geo->StandardName  ) ?></a></li>
                          <?php } ?>
                      </ul>
                    </li>

                    <li id="four" class="nav-item menu-item">
                        <a href="search.php<?php echo (isset($_GET['lang']))? "?lang=".$_GET['lang']:''; ?>" class="nav-link"><?php echo $lang['search'] ?></a>
                    </li>

                    <li class="nav-item has-sub-menu menu-item">
                      <div id="flags_translate" class="lang_flags"><!--header-search-->
                    		<?php 
                    			if(isset($_GET['lang'])) {    
                        		$url = strip_param_from_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'lang' )
                        	?>                      
                        		<a href="<?php echo $url; ?>" class="nav-link ">GR</a>
                    		<?php } 
                    	  else { if (count($_GET) > 0){  ?>

                            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'&lang=en'; ?>" class="nav-link ">
                        <?php } 
                        else  { ?>
                            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'?lang=en'; ?>" class="nav-link ">

                        <?php  } ?>
                        <?php echo 'EN'; ?></a>
                        
                        <?php  }  ?>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- /.primary-nav-wrapper -->
              </div>
             <!-- <div class="header-toggle toggle">
                <span></span>
                <span></span>
                <span></span>
              </div>-->
              <!-- /.header-toggle -->
              <!--<div class="header-actions">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a href="#" class="nav-link modal-submit" id="modal-action-submit" data-toggle="modal" data-target="#modal-submit">
                      <i class="fa fa-plus"></i> <span>Submit Listing</span>
                    </a>
                  </li>
                </ul>
              </div>-->
              <!-- /.header-actions -->
            </div>
            <!-- /.header-inner -->
          </div>
          <!-- /.container -->
        </div>
        <!-- /.header -->

<script type="text/javascript">
//apply active-classes to submenu
//
// $(document).ready(function(){
//             $('#menu li a').click(function(e){
//                 e.preventDefault();
//                 $('#menu li a').removeClass('active');
//                 $(this).closest('nav-item.has-sub-menu.menu-item>li').find("a:eq(0)").addClass('active');
//                 $(this).addClass('active');
//             });
//         });
//
//
// $(document).ready(function () {
//
//     $("#menu li a").click(function (e) {
//       $('#menu a').removeClass('active');
//       $(this).closest('.menu-item').find('a').first().addClass('active');
//         //$(this).closest('.menu-item').find('a:eq(0)').addClass('active');
//       $(this).addClass('active');
//       e.preventDefault();
//     });
//
// });


</script>