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

$ControllerMainUnities = new ControllerMainUnities();
$ControllerLake = new ControllerLake();
$ControllerGeophysical = new ControllerGeophysical();
$ControllerKeyword = new ControllerKeyword();
$ControllerArchivedObject =  new ControllerArchivedObject();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$relation_entities = $ControllerArchivedObject->getRelationEntitiesOfArchivedObjectID($_GET['id']);
//$sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id']);
//$mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
//$geophysicals = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id']);




$main = $ControllerArchivedObjectRelations->GetArchivedPerArchivedlist($_GET['id'], $_GET['accompanyingItemTypeID'], $CultureID); 

$listsOfGeo = $ControllerArchivedObjectRelations->getGeoItemsRelatedToGeoItemsOnly($_GET['id'], $_GET['accompanyingItemTypeID'], $CultureID);
 
?>

<?php $currentPage = 1;
$offset = 0;
$num_of_pages = 0;
  
if(isset($_GET['page']) && is_numeric($_GET['page']))
{
  $currentPage = $_GET['page'];
}
$offset = ($currentPage - 1)  * $PAGE_SIZE;
?>

<?php $langParam = ((isset($_GET['lang']) === false || ($_GET['lang'] == ''))?  '' : '&lang='.$_GET['lang']); 

 if ($_GET['cat'] == 11){ ?>


<?php $accitems = $ControllerArchivedObjectRelations->ViewArchivedObjectlist($_GET['id'], $_GET['accompanyingItemTypeID'], $PAGE_SIZE, $offset, $CultureID);
    $countOfRecords = $_GET['rowsum'];
      
?>

<?php $num_of_pages = ceil($countOfRecords / $PAGE_SIZE); ?>


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


                                <?php } else if ($_GET['accompanyingItemTypeID'] == 8) { ?>


                                <div class="listing-row-medium">
                                <div class="listing-row-medium-inner">
                                  <a href="#" class="listing-row-medium-image" style="background-image: url('../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΧΑΡΤΕΣ/WebThumbsSmall/thumb_<?php echo $ac->documentPath?>'); ">
                                  </a>
                                  <div class="listing-row-medium-content">
                                    <a class="listing" href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                                    
                                    <h4 class="listing-row-medium-title"><a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link ">
                                
                                   ΣΥΝΔΕΕΤΑΙ ΜΕ:  </a></h4>
                                  </div>
                                </div>
                              </div> 

             

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
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->abbreviation?></b></a>
                                </li>

                                  <?php  } else if ($_GET['accompanyingItemTypeID'] == 5) { ?>
                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->title?></b></a>
                                </li>

                                  <?php  } else  { ?>


                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                               </li>

                              <?php  } ?>
                              <?php  } ?>
                             </ul>
                            </div>
                          <?php if ($num_of_pages > 1){ ?>
                              <ul class="pagination pull-right">
                                  <?php if($currentPage > 1) { ?>
                                  <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,1)">Start</button></li>
                                  <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $currentPage-1; ?>)">Previous</button></li>
                                  <?php } ?>
                                  <?php for ($i=1; $i <= $num_of_pages; $i++)
                                  {
                                  if (IsNeighbourPage($currentPage, $i, $num_of_pages))  { ?>

                                  <li class="page-item">
                                    <button class="page-link <?php echo ($currentPage == $i ? 'active' : '') ?>" onclick="filterResultsForGeo(<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $i ?>)"><?php echo $i ?></button>
                                  </li>

                                  <?php } ?>
                                  <?php } ?>
                                  <?php if($currentPage < $num_of_pages ) { ?>
                                  <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $currentPage+1;  ?>)">Next</button></li>
                                  <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $ac->accompanyingItemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $num_of_pages;  ?>)">End</button></li>
                                  <?php } ?>
                              </ul>
                      <?php  } ?>
                      </div>

                    </div>
              </div> 



          <?php } else if  ($_GET['cat'] == 12) {  ?>
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
 
                              <?php if ($num_of_pages > 1){ ?>
                              <ul class="pagination pull-right">
                              <?php if($currentPage > 1) { ?>
                              <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $mn->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,1)">Start</button></li>
                              <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $mn->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $currentPage-1; ?>)"> Previous</button></li>
                              <?php } ?>
                              <?php for ($i=1; $i <= $num_of_pages; $i++)
                              {
                              if (IsNeighbourPage($currentPage, $i, $num_of_pages))  { ?>

                              <li class="page-item">
                                <button class="page-link <?php echo ($currentPage == $i ? 'active' : '') ?>" onclick="filterResultsForGeo(<?php echo $mn->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $i ?>)"><?php echo $i ?></button>
                              </li>

                              <?php } ?>
                              <?php } ?>
                              <?php if($currentPage < $num_of_pages ) { ?>
                              <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $mn->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $currentPage+1;  ?>)">Next</button></li>
                              <li class="page-item"><button class="page-link" onclick="filterResultsForGeo(<?php echo $mn->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $num_of_pages;  ?>)">End</button></li>
                              <?php } ?>
                          </ul>

                          <?php  } ?>

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
                                          <a class="nav-link" href="lake_profile.php?id=<?php echo $listOfGeo->geophysicalObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                      </li>
                                   

                                    <?php } else if ($_GET['accompanyingItemTypeID'] == 10) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="sea_profile.php?id=<?php echo $listOfGeo->seaID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                      </li>

                                       <?php } else if ($_GET['accompanyingItemTypeID'] == 9) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="landarea_profile.php?id=<?php echo $listOfGeo->geophysicalObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>

                                     <?php } else if ($_GET['accompanyingItemTypeID'] == 8) { ?>
                                    <li class="nav-item featured">
                                          <a class="nav-link" href="mountain_profile.php?id=<?php echo $listOfGeo->geophysicalObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>
                                    <?php }  else { ?>

                                      <li class="nav-item featured">
                                          <a class="nav-link" href="river_profile.php?id=<?php echo $listOfGeo->geophysicalObjectID; echo $langParam;?>" class="nav-link "><b><?php echo $listOfGeo->friendlyName?></b></a>
                                    </li>
                                    <?php } ?>

                                    <?php } ?>



                                </ul>
                                   
                            </div> 
                            <?php if ($num_of_pages > 1){ ?>
 
                            <ul class="pagination pull-right">
                              <?php if($currentPage > 1) { ?>
                              <li class="page-item"><button class="page-link" onclick="filterResults(<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,1)">Start</button></li>
                              <li class="page-item"><button class="page-link" onclick="filterResults(<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $currentPage-1; ?>)"> Previous</button></li>
                              <?php } ?>
                              <?php for ($i=1; $i <= $num_of_pages; $i++)
                              {
                              if (IsNeighbourPage($currentPage, $i, $num_of_pages))  { ?>

                              <li class="page-item">
                                <button class="page-link <?php echo ($currentPage == $i ? 'active' : '') ?>" onclick="filterResults(<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $i ?>)"><?php echo $i ?></button>
                              </li>

                              <?php } ?>
                              <?php } ?>
                              <?php if($currentPage < $num_of_pages ) { ?>
                              <li class="page-item"><button class="page-link" onclick="filterResults(<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $currentPage+1;  ?>)">Next</button></li>
                              <li class="page-item"><button class="page-link" onclick="filterResults(<?php echo $listOfGeo->itemTypeID; ?>,<?php echo $_GET['cat']; ?>,<?php echo $countOfRecords; ?>,<?php echo $num_of_pages;  ?>)">End</button></li>
                              <?php } ?>
                          </ul>

                          <?php  } ?>
                        </div>
                          
                      </div>
                </div>
                <?php  } ?>




