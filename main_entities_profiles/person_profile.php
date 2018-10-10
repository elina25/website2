
<?php 
require_once ("inc/init.php");
require_once ("inc/lang.php");

//session_start();

// $controllerMainUnities = new ControllerMainUnities();
$ControllerPerson = new ControllerPerson();
// $ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
// $ControllerAccompanyingObject = new ControllerAccompanyingObject();
// $itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
// $ControllerKeyword = new ControllerKeyword();

$details = $ControllerPerson->getPersonFromPersonID($_GET['item_id']);
$detailss = $ControllerPerson->getPersonWithID($_GET['item_id'],$CultureID); 
// $types = $ControllerAccompanyingObject->getItemTypeFromItemID($_GET['id']);
// $unities = $controllerMainUnities->getAllMainUnitiesItemTypes();
// $geos = $controllerMainUnities->getAllGeoUnities();
// $themes = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
// $sk = $ControllerArchivedObjectRelations->ViewArchivedObjectRelationss($_GET['id']);
// $mainunities = $ControllerArchivedObjectRelations->GetArchivedPerArchived($_GET['id']);
// $geophysicals = $ControllerArchivedObjectRelations->getArchivedPerGeoRelation($_GET['id']);
// $keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 




?>




                  <!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->
               
           
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
          </div>
<!-- ************************************************************************* START OF MAIN PAGE *************************************************************************** -->



