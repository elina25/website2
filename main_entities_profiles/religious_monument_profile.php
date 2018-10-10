<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControlleReligious= new ControllerAudioVisual();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$audiovisuals = $ControllerAudioVisual->getAudioVisualWithID($_GET['item_id'], $CultureID);
$audiovisualdetails = $ControllerAudioVisual->getAudioVisualDetailsWithID($_GET['item_id']);
$kinds = $ControllerAudioVisual->getKindOfAudioVisualWithID($_GET['item_id'], $CultureID);
$characterazations = $ControllerAudioVisual->getCharacterizationOfAudioVisualWithID($_GET['item_id'], $CultureID);
$keywords = $ControllerAudioVisual->getKeywordFromAudioVisualID($_GET['item_id'], $CultureID);
$usages = $ControllerAudioVisual->getUsageFromAudioVisualID($_GET['item_id']);
$usagedetails = $ControllerAudioVisual->getUsageDetailsFromAudioVisualID($_GET['item_id'], $CultureID);

?>







           <div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">

              <?php if (count($accompanyingitems) > 0){ ?>
                              <div class="listing-detail-section" id="listing-detail-section-documentPath" data-title="<?php echo $lang['documentPath'];?>">
                                    <div class="box">
                                      <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                            <?php foreach ($accompanyingitems as $item) {  ?>
                        <audio controls>
                          <source src="../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/AUDIOVISUAL/RADIOMK_1986_AIGAIO_DELOS_02.mp3" type="audio/ogg">
                          <!--<source src="../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/AUDIOVISUAL/<?php echo $item->documentPath?>" type="audio/ogg">-->
                        </audio>
                        <?php } ?>
                        
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <?php } ?>




                                  <table class="table table-bordered opening-hours">
                                <tbody>
                                <?php foreach ($audiovisuals as $audiovisual) { ?>
                                <?php 
                                if(!IsNullOrEmpty($audiovisuals[0]->title)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['title']; ?></th>
                                    <td><?php echo $audiovisual->title?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php 
                                if(!IsNullOrEmpty($audiovisuals[0]->subtitle)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['subtitle']; ?></th>
                                    <td><?php echo $audiovisual->subtitle?></td>
                                  </tr>
                                  <?php  } ?>
                                  <?php  } ?>
                                  <?php foreach ($kinds as $kind) { ?>
                                  <?php if(!IsNullOrEmpty($kinds[0]->lookupValue)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['kind']; ?></th>
                                    <td><?php echo $kind->lookupValue?></td>
                                  </tr>
                                  <?php  } ?>
                               
                                  
                                  <?php } ?>
                                </tbody>
                            </table>


              <?php 
                          if(!IsNullOrEmpty($characterazations[0]->characterazation)){ ?>
                          <div class="listing-detail-section" id="listing-detail-characterization" data-title="<?php echo $lang['characterization'];?>">
                                 <h4><?php echo $lang['characterization']; ?></h4>
                                  <div class="box">
                                      <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                            <div class="entry-summary">
                          <?php foreach ($characterazations as $characterazation){ ?>
                                                <?php echo $characterazation->characterization . " . "?>
                                              <?php } ?>
                        </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
              <?php } ?>
                  
                



                                <?php 
                                if(!IsNullOrEmpty($audiovisualdetails[0]->copyrightHeldByApan)){ ?>
                                <div class="listing-detail-section" id="listing-detail-copyright" data-title="<?php echo $lang['copyright'];?>">
                                  <h4><?php echo $lang['copyright']; ?></h4>
                                  <div class="box">
                                    <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                            <div class="entry-summary">
                                            <?php foreach ($audiovisualdetails as $audiovisualdetail) { ?>
                          <?php if ($audiovisualdetails['0']->copyrightHeldByApan == 1) {
                                  echo $lang['yes'];
                                } else {
                                  echo $lang['no'];
                                } ?>
                            <?php } ?>
                        </div>
                                         </div>
                                    </div>
                                  </div>
                                  </div>
                               <?php } ?>

                             <!--   <?php 
                                if(!IsNullOrEmpty($audiovisualdetails[0]->copyrightHeldBy)){ ?>
                                <div class="listing-detail-section" id="listing-detail-copyright" data-title="<?php echo $lang['copyright'];?>">
                                  <h4><?php echo $lang['copyright']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                            <div class="entry-summary">
                                            <?php foreach ($audiovisualdetails as $audiovisualdetail) { 
                          MakeItemList($audiovisualdetail, 'copyrightHeldBy', $lang);
                            } ?>
                        </div>
                                         </div>
                                    </div>
                                  </div>
                                </div>
                               <?php } ?>
 -->

                                <?php if(!IsNullOrEmpty($audiovisualdetails[0]->copyrightHeldBy)){ ?>
                                <table class="table table-bordered opening-hours">
                              <tbody>
                                <?php foreach ($audiovisualdetails as $audiovisualdetail) { ?>
                               
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['copyrightHeldBy']; ?></th>
                                    <td><?php echo $audiovisualdetail->copyrightHeldBy?></td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                            </table>
                             <?php } ?>





                                  <table class="table table-bordered opening-hours">
                                <tbody>
                                <?php foreach ($audiovisuals as $audiovisual) { ?>
                                <?php 
                                if(!IsNullOrEmpty($audiovisuals[0]->director)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['director']; ?></th>
                                    <td><?php echo $audiovisual->director?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php 
                                if(!IsNullOrEmpty($audiovisuals[0]->language)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['language']; ?></th>
                                    <td><?php echo $audiovisual->language?></td>
                                  </tr>
                                  <?php  } ?>
                            
                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->speaker)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['speaker']; ?></th>
                                    <td><?php echo $audiovisual->speaker?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->composer)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['composer']; ?></th>
                                    <td><?php echo $audiovisual->composer?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->direction)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['direction']; ?></th>
                                    <td><?php echo $audiovisual->direction?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->synopsis)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['synopsis']; ?></th>
                                    <td><?php echo $audiovisual->synopsis?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->occassion)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['occassion']; ?></th>
                                    <td><?php echo $audiovisual->occassion?></td>
                                  </tr>
                                  <?php  } ?>


                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->duration)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['duration']; ?></th>
                                    <td><?php echo $audiovisual->duration?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->format)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['format']; ?></th>
                                    <td><?php echo $audiovisual->format?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->digitizationform)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['digitizationform']; ?></th>
                                    <td><?php echo $audiovisual->digitizationform?></td>
                                  </tr>
                                  <?php  } ?>

                                  <?php if(!IsNullOrEmpty($audiovisuals[0]->interviewData)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['interviewData']; ?></th>
                                    <td><?php echo $audiovisual->interviewData?></td>
                                  </tr>
                                  <?php  } ?>
                                     <?php if(!IsNullOrEmpty($audiovisuals[0]->textsBy)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['textsBy']; ?></th>
                                    <td><?php echo $audiovisual->textsBy?></td>
                                  </tr>
                                  <?php  } ?>
                                     <?php if(!IsNullOrEmpty($audiovisuals[0]->musicBy)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['musicBy']; ?></th>
                                    <td><?php echo $audiovisual->musicBy?></td>
                                  </tr>
                                  <?php  } ?>
                                     <?php if(!IsNullOrEmpty($audiovisuals[0]->producedBy)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['producedBy']; ?></th>
                                    <td><?php echo $audiovisual->producedBy?></td>
                                  </tr>
                                  <?php  } ?>
                                     <?php if(!IsNullOrEmpty($audiovisuals[0]->otherInfo)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['otherInfo']; ?></th>
                                    <td><?php echo $audiovisual->otherInfo?></td>
                                  </tr>
                                  <?php  } ?>

                                     <?php if(!IsNullOrEmpty($audiovisuals[0]->othersInvolved)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['othersInvolved']; ?></th>
                                    <td><?php echo $audiovisual->othersInvolved?></td>
                                  </tr>
                                  <?php  } ?>
                                    <?php if(!IsNullOrEmpty($audiovisuals[0]->comments)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['comments']; ?></th>
                                    <td><?php echo $audiovisual->comments?></td>
                                  </tr>
                                  <?php  } ?>
                                <?php } ?>
                                </tbody>
                            </table>


                            <?php if(count($usages) > 0){?>
                                <table class="table table-bordered opening-hours">
                                <tbody>
                                <?php foreach ($usages as $usage) { ?>
                                <?php 
                                if(!IsNullOrEmpty($usages[0]->YearInfo)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['date']; ?></th>
                                    <td><?php echo $usage->DayInfo . '/' . $usage->MonthInfo . '/' .  $usage->YearInfo?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php 
                                if(!IsNullOrEmpty($usages[0]->use)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['usage_type']; ?></th>
                                    <td><?php echo $usage->use?></td>
                                  </tr>
                                  <?php  } ?>
                                   <?php foreach ($usagedetails as $usagedetail) { 
                                   if(!IsNullOrEmpty($usagedetails[0]->comments)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['comments']; ?></th>
                                    <td><?php echo $usagedetail->comments?></td>
                                  </tr>
                                  <?php  } ?>
                                  <?php  } ?>

                                  <?php } ?>
                                </tbody>
                              </table>
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



                           

                               <!--<?php 
                                if(!IsNullOrEmpty($usagedetails[0]->occasion)){ ?>
                                <div class="listing-detail-section" id="listing-detail-occasion" data-title="<?php echo $lang['occasion'];?>">
                                 <h4><?php echo $lang['occasion']; ?></h4>
                                  <div class="box">
                                      <div class="box-inner">
                                          <div class="overview overview-half overview-no-margin">
                                              <div class="entry-summary">
                                               <?php foreach ($usagedetails as $usagedetail) {  
                            MakeItemList($usagedetail, 'occasion', $lang);
                          } ?>
                                              </div>
                                           </div>
                                      </div>
                                  </div>
                                </div>
                               <?php } ?>-->
            </div>
                    </div>
                  </div>
               


                      

                          


                               
    



      
  

              
         

    
