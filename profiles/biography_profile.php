<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerBiography = new ControllerBiography();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$keywords = $ControllerBiography->getKeywordFromBiographyID($_GET['item_id'], $CultureID);
$informations = $ControllerBiography->getBiographyWithID($_GET['item_id'], $CultureID);
?>                        

 



                          
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                  <div class="listing-boxes">



                        <table class="table table-bordered opening-hours">
                          <tbody>
                            <?php foreach ($informations as $information) { ?>
                          
                              <?php if(!IsNullOrEmpty($informations[0]->FullName)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['fullName']; ?></th>
                                <td><?php echo $information->FullName?></td>
                              </tr>
                              <?php  } ?>

                              <?php if(!IsNullOrEmpty($informations[0]->Office)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['Office']; ?></th>
                                <td><?php echo $information->Office?></td>
                              </tr>
                              <?php  } ?>

                              <?php if(!IsNullOrEmpty($informations[0]->HonorTitle)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['HonorTitle']; ?></th>
                                <td><?php echo $information->HonorTitle?></td>
                              </tr>
                              <?php  } ?>

                              <?php 
                              if(!IsNullOrEmpty($informations[0]->Nickname)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['Nickname']; ?></th>
                                <td><?php echo $information->Nickname?></td>
                              </tr>
                              <?php } ?> 

                              <?php 
                              if(!IsNullOrEmpty($informations[0]->ServiceDetails)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['ServiceDetails']; ?></th>
                                <td><?php echo $information->ServiceDetails?></td>
                              </tr>
                              <?php } ?>

                          
                              <?php 
                              if(!IsNullOrEmpty($informations[0]->BirthLocation)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['BirthLocation']; ?></th>
                                <td><?php echo $information->BirthLocation?></td>
                              </tr>
                              <?php } ?>

                              <?php 
                              if(!IsNullOrEmpty($informations[0]->DeathLocation)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['DeathLocation']; ?></th>
                                <td><?php echo $information->DeathLocation?></td>
                              </tr>
                              <?php } ?>

                              <?php 
                              if(!IsNullOrEmpty($informations[0]->BurialLocation)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['BurialLocation']; ?></th>
                                <td><?php echo $information->BurialLocation?></td>
                              </tr>
                              <?php } ?>

                              <?php 
                              if(!IsNullOrEmpty($informations[0]->Profession)){ ?>
                              <tr>
                                <th class="min-width center"><?php echo $lang['Profession']; ?></th>
                                <td><?php echo $information->Profession?></td>
                              </tr>
                              <?php } ?>


                            <?php } ?>
                            </tbody>
                          </table>

<!-- 
                              <h4><?php echo $lang['GeneralDetails']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                            <?php foreach ($informations as $information) { ?>
                                              <?php
                                              MakeItemList($information, 'FullName', $lang, 'fullName');
                                              MakeItemList($information, 'Office', $lang);
                                              MakeItemList($information, 'HonorTitle', $lang);
                                              MakeItemList($information, 'Nickname', $lang);
                                              MakeItemList($information, 'ServiceDetails', $lang);
                                              MakeItemList($information, 'BirthLocation', $lang);
                                              MakeItemList($information, 'DeathLocation', $lang);
                                              MakeItemList($information, 'BurialLocation', $lang);
                                              MakeItemList($information, 'Profession', $lang);
                                              //MakeItemList($information, 'CommentsPlainText', $lang);
                                             // MakeItemList($information, 'HistoricalDataPlainText', $lang);
                                               ?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                                </div> -->


                                <?php //$data = (array) $informations[0];
                                 if (!IsNullOrEmpty($informations[0]->CareerPlainText)){?>
                                     <h4><?php echo $lang['CareerPlainText'];?></h4>
                                      <div class="box">
                                        <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                            <?php foreach ($informations as $information) { ?>
                                              <?php echo $information->CareerPlainText  ?>
                                            <?php } ?>
                                          </div>
                                        </div>
                                      </div>
                                  <?php } ?>
                         
                                <?php //$data = (array) $informations[0];
                                 if (!IsNullOrEmpty($informations[0]->Education)){?>
                                     <h4><?php echo $lang['Education'];?></h4>
                                      <div class="box">
                                        <div class="box-inner">
                                            <?php foreach ($informations as $information) { ?>
                                              <?php echo $information->Education  ?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                <?php } ?>

                                 <?php //$data = (array) $informations[0];
                                 if (!IsNullOrEmpty($informations[0]->HistoricalDataPlainText)){?>
                                    <h4>Ιστορικά Στοιχεία</h4>
                                      <div class="box">
                                          <?php foreach ($informations as $information) { ?>
                                              <?php echo $information->HistoricalDataPlainText  ?>
                                            <?php } ?>
                                       </div>
                                <?php } ?>
                                <!-- 
                                <?php foreach ($informations as $information) { ?>
                                    <?php if(!IsNullOrEmpty($informations[0]->HistoricalDataPlainText)){ ?> 
                                      <div class="box">
                                        <?php echo $information->HistoricalDataPlainText;?>
                                      </div>
                                    <?php  } ?>
                                <?php  } ?> -->

                                  
                                <?php //$data = (array) $informations[0];
                                 if (!IsNullOrEmpty($informations[0]->CommentsPlainText)){?>
                                    <h4><?php echo $lang['Comments'];?></h4>
                                      <div class="box">
                                        <?php echo $informations[0]->CommentsPlainText; ?>
                                      </div>
                                <?php } ?>

                                

                                <?php if(count($keywords) > 0){?>
                                  <button style="color:#7f7f7f; width: 100%; background-color: #ffffff; box-shadow: 0 1px 2px rgba(50, 50, 50, 0.12); text-align: left;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#keyword"></i><?php echo $lang['keywords']; ?><i style="padding-left: 10px;" class="fa fa-angle-down"></i></button>
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
          	                      </div>
                                </div>
                              </div>


              



          


       