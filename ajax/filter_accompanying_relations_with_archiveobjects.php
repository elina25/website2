<?php
require_once("../inc/init.php");
//require_once("inc/lang.php");

$CultureID = 1;
if (isset($_GET['lang']) === false) {
    include '../lang/gr/language.php';
} else {
    include '../lang/' . $_GET['lang'] . '/language.php';
}


$controllerMainUnities = new ControllerMainUnities();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$itemtypes = $ControllerAccompanyingObject->getAllAccompanyingItemTypes();
$details = $controllerMainUnities->getPersonFromPersonID($_GET['id']);
$keywords = $controllerMainUnities->getKeywordFromPersonID($_GET['id'],$CultureID);
$types = $ControllerAccompanyingObject->getItemTypeFromItemID($_GET['id']);

$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$accitems = $ControllerArchivedObjectRelations->ViewArchivedObjectRelation($_GET['id'], $_GET['accompanyingItemTypeID']);
//$items = $ControllerArchivedObjectRelations->GetArchivedPerArchivedRelation($_GET['id'], $_GET['accompanyingItemTypeID']);

//print_r($keywords);

//print_r($filters);
//echo json_encode($items);

?>





	


            <div class="">


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

                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
                        <div class="row">
                          <div class="entry-summary">
                            <?php foreach ($details as $detail) { ?>
                            <?php

                                MakeItemList($detail, 'fullName', $lang);
                                MakeItemList($detail, 'relatives', $lang);
                                MakeItemList($detail, 'profession', $lang);
                                MakeItemList($detail, 'biographicalData', $lang);
                                MakeItemList($detail, 'remarks', $lang);
                                MakeItemList($detail, 'specialIssues', $lang);
                                MakeItemList($detail, 'ArchiveCode', $lang);
                                MakeItemList($detail, 'UniqueName', $lang);
                                MakeItemList($detail, 'comments', $lang);  ?>
                              

                             <?php } ?>

                          </div>


                          <div class="entry-summary">
                            <?php foreach ($parents as $parent) { ?>
                            <?php MakeItemList($parent, 'UniqueName', $lang); ?>
                            <?php } ?>

                          </div>

                          <div class="entry-summary">
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
                          </div>
          
                          <?php } ?>



                            <div class="entry-summary">
                            <h6><?php echo $lang['keyword'];?></h6>    
                              <?php foreach ($keywords as $keywordd){ ?>
                              <?php echo $keywordd->KeywordTranslation?>
                              <?php } ?>
                            </div>





                        </div>
                       
                      </div>
                      <!-- /.listing-boxes -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="tab-rent" role="tabpanel">
                     	<div class="listing-boxes">
			    							
        										 <div class="row">
        											<div class="entry-summary">
        											    <?php foreach ($accitems as $accitem) { ?>
        													<p class="entry-content"><b><?php echo $lang['name']; ?></b>&nbsp;&nbsp;<?php echo $accitem->acc_uniqueName?></p><br/>
        											    <?php } ?>
        											</div>
        										</div>
        										    <div class="listing-detail-section" id="listing-detail-section-keyword" data-title="<?php echo $lang['keyword']; ?>">
        													<h2><?php echo $lang['keyword'];?></h2>                    
        														<div class="box">
						                      		<div class="box-inner">
							                        	<div class="overview overview-half overview-no-margin">
							                        		<?php foreach ($accitems as $accitem){ ?>
									            				       <b><?php echo $lang['name']; ?></b>&nbsp;&nbsp;<?php echo $accitem->acc_uniqueName?>
							          						       <?php } ?>
							                        	</div>
						                      		</div>
						                      		
        							             </div>
        							         </div>
                      </div>
                    </div>
              </div>
          </div>

