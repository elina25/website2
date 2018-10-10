
<?php
require_once("../inc/init.php");
//require_once("inc/lang.php");

if (empty($_GET['lang'])){
 include '../lang/gr/language.php';
 $CultureID = 1;
} else {
  include '../lang/' . $_GET['lang'] . '/language.php';
  if ($_GET['lang'] == "en") ;
  $CultureID = 2;
   }

$PAGE_SIZE = 20;

$ControllerArchivedObject =  new ControllerArchivedObject();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$ControllerGeophysical = new ControllerGeophysical();

$main = $ControllerArchivedObjectRelations->GetArchivedPerArchivedlist($_GET['id'], $_GET['accompanyingItemTypeID'], $CultureID);

$listsOfGeo = $ControllerArchivedObjectRelations->getGeoItemsRelatedToGeoItemsOnly($_GET['id'], $_GET['accompanyingItemTypeID'], $CultureID);

?>
<?php if ($_GET['cat'] == 11){ ?>

<?php $accitems = $ControllerArchivedObjectRelations->ViewArchivedObjectlist($_GET['id'], $_GET['accompanyingItemTypeID'], $PAGE_SIZE, $offset, $CultureID); ?>

                     <div class="tab-pane active" id="tab-rent" role="tabpanel">
                      <div class="table-wrapper">
                        <div class="overview">
                       
                          <ul>
                            <?php foreach ($accitems as $ac){ ?>
                              <?php if ($_GET['accompanyingItemTypeID'] == 1) { ?>

                                <div class="listing-row-medium">
                                <div class="listing-row-medium-inner">
                                  <a href="listings-detail.html" class="listing-row-medium-image" style="background-image: url('../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΦΩΤΟΓΡΑΦΙΚΟ ΥΛΙΚΟ/WebThumbsSmall/thumb_<?php echo $ac->documentPath?>'); ">
                                  </a>
                                  <div class="listing-row-medium-content">
                                    <a class="listing" href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                                    <!---<span class="listing-row-medium-rating">
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                      <i class="fa fa-star"></i>
                                    </span>--->
                                    <h4 class="listing-row-medium-title"><a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "></a></h4>
                                   
                                    <!-- /.listing-row-medium-address -->
                                  </div>
                                  <!-- /.listing-row-medium-content -->
                                </div>
                                <!-- /.listing-row-medium-inner -->
                              </div>
                              <!-- /.listings-row-medium -->


                               
                                <?php } else if ($_GET['accompanyingItemTypeID'] == 8) { ?>

                                <div class="listing-row-medium">
                                <div class="listing-row-medium-inner">
                                  <a href="listings-detail.html" class="listing-row-medium-image" style="background-image: url('../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΧΑΡΤΕΣ/WebThumbsSmall/thumb_<?php echo $ac->documentPath?>'); ">
                                  </a>
                                  <div class="listing-row-medium-content">
                                    <a class="listing" href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                                    
                                    <h4 class="listing-row-medium-title"><a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "></a></h4>
                                   
                                    <!-- /.listing-row-medium-address -->
                                  </div>
                                  <!-- /.listing-row-medium-content -->
                                </div>
                                <!-- /.listing-row-medium-inner -->
                              </div>
                              <!-- /.listings-row-medium -->


                               <?php }  else if ($_GET['accompanyingItemTypeID'] == 3) { ?>

                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->FullName?></b></a>
                               </li>

                                  <?php  } else if ($_GET['accompanyingItemTypeID'] == 9) { ?> 
                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->FriendlyName?></b></a>
                                </li>

                                  <?php  } else if ($_GET['accompanyingItemTypeID'] == 4) { ?>
                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->titlePlainText?></b></a>
                                </li>

                                  <?php  } else if ($_GET['accompanyingItemTypeID'] == 5) { ?>
                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->titlePlainText?></b></a>
                                </li>

                                  <?php  } else  { ?>

                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                               </li>

                              <?php  } ?>
                              <?php  } ?>


                          </ul>
                            </div> 
                     
            
                             



                      </div>

                    </div>
              </div> 


<?php } else if  ($_GET['cat'] == 12){  ?>
                  

                     <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>                          
                                    <?php foreach ($main as $mn) { ?>

                                    <?php if ($_GET['accompanyingItemTypeID'] == 3) { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->FriendlyName?></b></a>
                                      </li>

                                    <?php  } else if ($_GET['accompanyingItemTypeID'] == 16) { ?>
                                    <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->name?></b></a>
                                      </li>
                                    <?php  } else if ($_GET['accompanyingItemTypeID'] == 23) { ?>
                                       <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->frontView?></b></a>
                                      </li>
                                    <?php  } else if ($_GET['accompanyingItemTypeID'] == 24) { ?>
                                       <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->fullName?></b></a>
                                      </li>
                                    <?php  } else if ($_GET['accompanyingItemTypeID'] == 25) { ?>
                                       <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->title?></b></a>
                                      </li>
                                    <?php  } else  { ?>
                                       <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->itemTypeID; ?>&item_id=<?php echo $mn->itemID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->friendlyName?></b></a>
                                      </li>
                                    <?php  } ?>
                                    <?php  } ?>

                                </ul>

                                   
                            </div>  
 
                            
                        </div>
                          
                      </div>
               
<?php } else {  ?>

                       <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                          
                                    <?php foreach ($listsOfGeo as $listOfGeo) { ?>

                                      <?php if ($_GET['accompanyingItemTypeID'] == 11) { ?>


                                      <li class="nav-item featured">
                                          <a class="nav-link" href="lake_profile.php?id=<?php echo $listOfGeo->ArchivedObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                      </li>
                                   

                                    <?php } else if ($_GET['accompanyingItemTypeID'] == 10) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="sea_profile.php?id=<?php echo $listOfGeo->ArchivedObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                      </li>

                                       <?php } else if ($_GET['accompanyingItemTypeID'] == 9) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="landarea_profile.php?id=<?php echo $listOfGeo->ArchivedObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>

                                     <?php } else if ($_GET['accompanyingItemTypeID'] == 8) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="mountain_profile.php?id=<?php echo $listOfGeo->ArchivedObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>
                                    <?php }  else { ?>

                                      <li class="nav-item featured">
                                          <a class="nav-link" href="river_profile.php?id=<?php echo $listOfGeo->ArchivedObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>
                                    <?php } ?>

                                    <?php } ?>



                                </ul>

                            
                            </div>  
 
                          
                        </div>
                          
                      </div>
             
                <?php  } ?>


          
              





