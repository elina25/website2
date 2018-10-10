<?php
require_once("../inc/init.php");
   

if (empty($_GET['lang'])){
 include '../lang/gr/language.php';
 $CultureID = 1;;
} else {
  include '../lang/' . $_GET['lang'] . '/language.php';
  if ($_GET['lang'] == "en") ;
$CultureID = 2;
   }


$ControllerKeyword = new ControllerKeyword();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 


$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'], $_GET['item_id']); 
//$main = $ControllerArchivedObjectRelations->ViewArchivedObjectRelation($_GET['item_id'], $_GET['item_type_id']); 
$listsOfGeo = $ControllerAccompanyingObject->GetAllRelationsAccToGeoList($_GET['item_id'], $_GET['item_type_id']); 
$main = $ControllerAccompanyingObject->GetAllRelationsAccToMainEntitiesList($_GET['item_id'], $_GET['item_type_id'],$CultureID); 
$region_lists = $ControllerAccompanyingObject->GetAllRelationsAccToRegions($_GET['item_id'],$CultureID); 

?>

<?php $langParam = ((isset($_GET['lang']) === false || ($_GET['lang'] == ''))?  '' : '&lang='.$_GET['lang']); ?>
<?php if ($_GET['related_children'] == 0){ ?> 


<?php if ($_GET['cat'] == 11){ ?>
<?php $acs = $ControllerAccompanyingObject->GetAllRelationsAccToAccItemsS($_GET['item_id'],$_GET['item_type_id'],$CultureID); 
print_r($_GET['lang']);
?>

                  
                     <div class="tab-pane active" id="tab-rent" role="tabpanel">
                      <div class="table-wrapper">
                        <div class="overview">
                          <ul>


                            <?php foreach ($acs as $ac){ ?>

                            <?php if ($_GET['item_type_id'] == 3) { ?>

                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->secondObjectID;  
                                  echo $langParam;?>" class="nav-link "><b><?php echo $ac->FullName?></b></a>
                                </li>
                               <?php  } else if ($_GET['item_type_id'] == 9){ ?>
                            
                                <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->secondObjectID;  echo $langParam; ?>" class="nav-link "><b><?php echo $ac->FriendlyName?></b></a>
                                </li>
                              <?php  }  else if ($_GET['item_type_id'] == 1 || $_GET['item_type_id'] == 2 || $_GET['item_type_id'] == 6 || $_GET['item_type_id'] == 7 || $_GET['item_type_id'] == 8) { ?> 

                              <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->secondObjectID;  echo $langParam; ?>" class="nav-link "><b><?php echo $ac->Title?></b></a>
                              </li>

                                <?php  } else if ($_GET['item_type_id'] == 4 || $_GET['item_type_id'] == 5) { ?>

                              <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->secondObjectID;  echo $langParam; ?>" class="nav-link "><b><?php echo $ac->title?></b></a>
                              </li>

                                <?php  } ?>

                               <?php  } ?> 
                          </ul>
                        </div>  

                          <ul class="pagination pull-right">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                          </ul>
                      </div>
                    </div>
              </div> 


<?php } else if  ($_GET['cat'] == 12){  ?>
                  

                 		 <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                                    <?php foreach ($main as $mn) { ?>

                                     <?php if ($_GET['item_type_id'] == 25)  { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->title?></b></a>
                                      </li>
                                    <?php  } else if ($_GET['item_type_id'] == 23) { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->frontView?></b></a>
                                      </li>

                                      <?php  } else if ($_GET['item_type_id'] == 16) { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->name?></b></a>
                                      </li>

                                    <?php  } else { ?>

                                    <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->friendlyName?></b></a>
                                      </li>
                                      <?php  } ?>

                                      <?php  } ?>

                                </ul>

                                   
                            </div>  
 
                              <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                        </div>
                          
                      </div>

                      <?php } else if  ($_GET['cat'] == 14){  ?>


                             <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                          
                                    <?php foreach ($region_lists as $region_list) { ?>
                                      <li class="nav-item featured">
                                          <a href="region.php?ArchivedObjectID=<?php echo $region_list->archivedObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $region_list->FriendlyName?></b></a>
                                      </li>
                                    <?php  } ?>

                                </ul>

                                   
                            </div>  
 
                              <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                        </div>
                          
                      </div>

               
<?php } else {  ?>

                       <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                          
                                    <?php foreach ($listsOfGeo as $listOfGeo) { ?>
                                      <li class="nav-item featured">
                                          <a href="" class="nav-link "><b><?php echo $listOfGeo->UniqueName?></b></a>
                                      </li>
                                    <?php  } ?>

                                </ul>

                                   
                            </div>  
 
                              <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                        </div>
                          
                      </div>
             
                <?php  } ?>
                
                <?php } else { ?>
                 
                 <?php if ($_GET['cat'] == 11){ ?>
                 
                 <?php echo "Εδω θα εμφανίζονται οι συσχετιζόμενες οντότητες των ιδιων αλλά και των παιδιών τους " ?>
                 
                 <?php } else if ($_GET['cat'] == 12) { ?>
                
                  <?php echo "Εδω θα εμφανίζονται οι συσχετιζόμενες οντότητες των ιδιων αλλά και των παιδιών τους " ?>
                                  
                 <?php } else if ($_GET['cat'] == 13) { ?>
                 
                 <?php echo "Εδω θα εμφανίζονται οι συσχετιζόμενες οντότητες των ιδιων αλλά και των παιδιών τους " ?>

                 <?php  } else { ?>
                 
                  <?php echo "Εδω θα εμφανίζονται οι συσχετιζόμενες οντότητες των ιδιων αλλά και των παιδιών τους " ?>
                  
                 <?php } ?>
                 
                <?php } ?>






