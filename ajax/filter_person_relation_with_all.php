<?php
require_once("../inc/init.php");
//require_once("inc/lang.php");

$CultureID = 1;
if (isset($_GET['lang']) === false) {
    include '../lang/gr/language.php';
} else {
    include '../lang/' . $_GET['lang'] . '/language.php';
}


$ControllerMainUnities = new ControllerMainUnities();
$ControllerPerson = new ControllerPerson();
$ControllerGeophysical = new ControllerGeophysical();
$ControllerKeyword = new ControllerKeyword();
$ControllerArchivedObject =  new ControllerArchivedObject();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$geos = $ControllerMainUnities->getAllGeoUnities();
$detailss = $ControllerPerson->getPersonWithID($_GET['id'],$CultureID); 
$kind = $ControllerGeophysical->getKindOfGeophysical($_GET['id'],$CultureID); 
$keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 
$relation_entities = $ControllerArchivedObject->getRelationEntitiesOfArchivedObjectID($_GET['id']);
$sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id']);
$mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
$geophysicals = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id']);




$main = $ControllerArchivedObjectRelations->GetArchivedPerArchivedlist($_GET['id'], $_GET['accompanyingItemTypeID']); 
$listsOfGeo = $ControllerArchivedObjectRelations->getLstArchivedPerGeoRelation($_GET['id'], $_GET['accompanyingItemTypeID']); 
?>
<?php if ($_GET['cat'] == 11){ ?>

<?php $accitems = $ControllerArchivedObjectRelations->ViewArchivedObjectlist($_GET['id'], $_GET['accompanyingItemTypeID']); ?>

 <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" id="first_tab">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['otherdetails']; ?></a>
                      </li>

                      <li class="nav-item" id="not">
                        <a class="nav-link" href="#tab-rent" data-toggle="tab"><?php echo $lang['sinodeutiko_iliko']; ?></a>
                      </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
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
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                       <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                                    <?php foreach ($accitems as $accitem){ ?>
                                       <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $accitem->accompanyingItemTypeID; ?>&item_id=<?php echo $accitem->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $accitem->uniqueName?></b></a>
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
                </div> 


<?php } else if  ($_GET['cat'] == 12){  ?>
                  <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['otherdetails']; ?></a>
                      </li>

                      <li class="nav-item" id="not">
                        <a class="nav-link" href="#tab-rent" data-toggle="tab"><?php echo $lang['sinodeutiko_iliko']; ?></a>
                      </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
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


                      

                        
                       
                  
                       
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                       <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                          
                                    <?php foreach ($main as $mn) { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->UniqueName?></b></a>
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
                </div>
<?php } else {  ?>

   <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['otherdetails']; ?></a>
                      </li>

                      <li class="nav-item" id="not">
                        <a class="nav-link" href="#tab-rent" data-toggle="tab"><?php echo $lang['sinodeutiko_iliko']; ?></a>
                      </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
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

                    

                     


                        
                       
                       
                      </div>
                    </div>
                    <!-- /.tab-pane -->
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
                </div>
                <?php  } ?>





