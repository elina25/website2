<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerPrintedHandwrittenDoc = new ControllerPrintedHandwrittenDoc();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$informations = $ControllerPrintedHandwrittenDoc->getPrintedOrHandwrittenDocWithID($_GET['item_id'], $CultureID);
$details = $ControllerPrintedHandwrittenDoc->getHandPrintedWithID($_GET['item_id']);
$keywords = $ControllerPrintedHandwrittenDoc->getKeywordFromPrintedHandwrittenDoc($_GET['item_id'], $CultureID);
$usages = $ControllerPrintedHandwrittenDoc->getUsageFromHandWtitten($_GET['item_id']);
$usagedetails = $ControllerPrintedHandwrittenDoc->getUsageDetailsFromHandWrittenPrinted($_GET['item_id'], $CultureID);
$sources = $ControllerPrintedHandwrittenDoc->getHandPrintedSourceWithID($_GET['item_id'], $CultureID);
$date = $ControllerPrintedHandwrittenDoc->getHandPrintedDateWithID($_GET['item_id']);


?>



                
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                  <div class="listing-boxes">

<!-- 
                              <h4><?php echo $lang['GeneralDetails']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                            <?php foreach ($informations as $information) { ?>
                                              <?php
                                              MakeItemList($information, 'Kind', $lang,'kind'); 
                                              MakeItemList($information, 'SourceDetailsPlainText', $lang); 
                                              MakeItemList($information, 'title', $lang); 
                                              MakeItemList($information, 'subtitle', $lang); 
                                              MakeItemList($information, 'Creator', $lang, 'creator'); 
                                              MakeItemList($information, 'Legende', $lang); 
                                              MakeItemList($information, 'Description', $lang); 
                                              MakeItemList($information, 'BackView', $lang); 
                                              MakeItemList($information, 'Sponsor', $lang, 'sponsor'); 
                                              MakeItemList($information, 'CommentsPlainText', $lang);
                                             
                                               ?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                                </div> -->


                                 <table class="table table-bordered opening-hours">
                                  <tbody>
                                    <?php foreach ($informations as $information) { ?>
                                    
                                  
                                      <?php if(!IsNullOrEmpty($informations[0]->Kind)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['kind']; ?></th>
                                        <td><?php echo $information->Kind?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($informations[0]->SourceDetails)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['SourceDetailsPlainText']; ?></th>
                                        <td><?php echo $information->SourceDetails?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php 
                                      if(!IsNullOrEmpty($informations[0]->title)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['title']; ?></th>
                                        <td><?php echo $information->title?></td>
                                      </tr>
                                      <?php } ?> 

                                      <?php 
                                      if(!IsNullOrEmpty($informations[0]->subtitle)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['subtitle']; ?></th>
                                        <td><?php echo $information->subtitle?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                      if(!IsNullOrEmpty($informations[0]->Creator)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['creator']; ?></th>
                                        <td><?php echo $information->Creator?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                      if(!IsNullOrEmpty($informations[0]->Legende)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['Legende']; ?></th>
                                        <td><?php echo $information->Legende?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                      if(!IsNullOrEmpty($informations[0]->Description)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['Description']; ?></th>
                                        <td><?php echo $information->Description?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                      if(!IsNullOrEmpty($informations[0]->BackView)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['BackView']; ?></th>
                                        <td><?php echo $information->BackView?></td>
                                      </tr>
                                      <?php } ?>

                                      <?php 
                                      if(!IsNullOrEmpty($informations[0]->Sponsor)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['sponsor']; ?></th>
                                        <td><?php echo $information->Sponsor?></td>
                                      </tr>
                                      <?php } ?>

                                      <?php 
                                      if(!IsNullOrEmpty($informations[0]->Comments)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['CommentsPlainText']; ?></th>
                                        <td><?php echo $information->Comments?></td>
                                      </tr>
                                      <?php } ?>
                                           <?php } ?>
                                  </tbody>
                                </table>


                                <table class="table table-bordered opening-hours">
                                  <tbody>
                                    <?php foreach ($details as $detail) { ?>
                                    
                                  
                                      <?php if(!IsNullOrEmpty($details[0]->copyrightHeldByApan)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['copyrightHeldByApan']; ?></th>
                                        <td><?php echo $detail->copyrightHeldByApan?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($details[0]->copyrightHeldBy)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['copyrightHeldBy']; ?></th>
                                        <td><?php echo $detail->copyrightHeldBy?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($details[0]->Location)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['Location']; ?></th>
                                        <td><?php echo $detail->Location?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($details[0]->PPI)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['PPI']; ?></th>
                                        <td><?php echo $detail->PPI?></td>
                                      </tr>
                                      <?php  } ?>

                                    <?php } ?>
                                  </tbody>
                                </table>


                             <!--    <?php if (count($details)>0){?>
                                  <?php foreach ($details as $detail) { ?>
                                  <h4><?php echo $lang['GeneralDetails']; ?></h4>
                                  <div class="box">
                                      <div class="box-inner">
                                        <div class="overview overview-half overview-no-margin">
                                          <div class="entry-summary">
                                            <p class="entry-content <?php echo NotShowItem($detail->copyrightHeldByApan); ?>"><b><?php echo $lang['copyrightHeldByApan']; ?></b>&nbsp;&nbsp;<?php echo $detail->copyrightHeldByApan; ?> </p>
                                            <p class="entry-content <?php echo NotShowItem($detail->copyrightHeldBy); ?>"><b><?php echo $lang['copyrightHeldBy']; ?></b>&nbsp;&nbsp;<?php echo $detail->copyrightHeldBy; ?> </p>
                                            <p class="entry-content <?php echo NotShowItem($detail->Location); ?>"><b><?php echo $lang['Location'] ?></b>&nbsp;&nbsp;<?php echo $detail->Location ?> </p>
                                            <p class="entry-content <?php echo NotShowItem($detail->PPI); ?>"><b><?php echo $lang['PPI'] ?></b>&nbsp;&nbsp;<?php echo $detail->PPI ?> </p>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                <?php } ?>
                                <?php } ?> -->

<!-- 
                                   <h4><?php echo $lang['OriginalCreationDate']; ?></h4>
                                    <div class="box">
                                    <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                            <p class="entry-content <?php echo NotShowItem($date->YearInfo); ?>"><b><?php echo $lang['YearInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->YearInfo; ?> </p>
                                            <p class="entry-content <?php echo NotShowItem($date->MonthInfo); ?>"><b><?php echo $lang['MonthInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->MonthInfo; ?> </p>
                                            <p class="entry-content <?php echo NotShowItem($date->DayInfo); ?>"><b><?php echo $lang['DayInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->DayInfo; ?> </p>
                                        </div>
                                      </div>

                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $lang['ca']; ?></b>&nbsp;&nbsp;

                                            <input type="checkbox" name="tag_3" id="tag_3" value="yes"  disabled="disabled" <?php echo ($date->$ca['tag_3']==1 ? 'checked' : '');?>>
                                            <?php echo $ca; ?>
                                        </div>
                                    </div>
                                </div> -->




                                  <?php if(count($date) > 0){?>
                                    <!--  <h3 style="padding-top: 20px;" ><?php echo $lang['IsPublished'];?></h3> -->
                                    <div class="table boxcustompadding">
                                      <h4><?php echo $lang['OriginalCreationDate']; ?></h4>
                                      <div class="box-inner">
                                        <ul class="amenities">
                                          <?php if (($date->ca) == 1 ) { ?>
                                          <li class="yes"><?php echo $lang['ca']; ?></li>
                                          <?php } else { ?>
                                          <li class="no"><?php echo $lang['ca']; ?></li>
                                          <?php } ?>
                                         </ul>
                                         <ul>
                                            <p class="entry-content <?php echo NotShowItem($date->YearInfo); ?>"><b><?php echo $lang['YearInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->YearInfo; ?></p>
                                            <p class="entry-content <?php echo NotShowItem($date->MonthInfo); ?>"><b><?php echo $lang['MonthInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->MonthInfo; ?></p>
                                            <p class="entry-content <?php echo NotShowItem($date->DayInfo); ?>"><b><?php echo $lang['DayInfo']; ?></b>&nbsp;&nbsp;<?php echo $date->DayInfo; ?></p>
                                         </ul>
                                      </div>
                                    </div>
                                  <?php } ?>




                                <h4><?php echo $lang['LookupValue']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                            <?php foreach ($sources as $source) { ?>
                                             <?php echo $source->LookupValue?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                

                                <div class="box">
                                    <div class="box-inner">
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $lang['IsOriginal']; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_1" id="tag_1" value="yes"  disabled="disabled" <?php echo ($details[0]->$IsOriginal['tag_1']==1 ? 'checked' : '');?>>
                                            <?php echo $IsOriginal; ?>
                                        </div>
                                    </div>
                                </div>

                                   <div class="box">
                                    <div class="box-inner">
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $lang['IsColored']; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_2" id="tag_2" value="yes"  disabled="disabled" <?php echo ($details[0]->$IsColored['tag_2']==1 ? 'checked' : '');?>>
                                            <?php echo $IsColored; ?>
                                        </div>
                                    </div>
                                </div>



         


                                  <?php 
                                  if(!IsNullOrEmpty($informations[0]->CommentsPlainText)){?>
                                   <h4><?php echo $lang['comments']; ?></h4>
                                       <div class="box">
                                         <div class="box-inner">
                                            <div class="overview overview-half overview-no-margin">
                                              <br/>
                                              <?php foreach ($informations as $information){ ?>
                                              <?php echo $informations->CommentsPlainText ?>
                                              <?php } ?>
                                             </div>
                                         </div>
                                     </div>
                               <?php } ?>


                              <?php 
                                  if(!IsNullOrEmpty($keywords[0]->KeywordTranslation)){?>
                                   <h4><?php echo $lang['keyword']; ?></h4>
                                       <div class="box">
                                         <div class="box-inner">
                                            <div class="overview overview-half overview-no-margin">
                                              <br/>
                                              <?php foreach ($keywords as $keywordd){ ?>
                                              <?php echo $keywordd->KeywordTranslation . " " . "|"?>
                                              <?php } ?>
                                             </div>
                                         </div>
                                     </div>
                               <?php } ?>


                               <?php 
                                 if (count($usages) > 0){?>
                                   <h4><?php echo $lang['usages']; ?></h4>
                                      <div class="box">
                                         <div class="box-inner">
                                            <div class="overview overview-half overview-no-margin">
                                              <br/>
                                             <?php foreach ($usages as $usage) {  
                                                MakeItemList($usage, 'use', $lang);
                                                MakeItemList($usage, 'YearInfo', $lang);
                                                MakeItemList($usage, 'MonthInfo', $lang);
                                                MakeItemList($usage, 'DayInfo', $lang);

                                              } ?>
                                            </div>
                                         </div>
                                      </div>
                                <?php } ?>


                                  <?php foreach ($usagedetails as $usagedetail) {  
                                      MakeItemList($usagedetail, 'occasion', $lang);
                                      MakeItemList($usagedetail, 'comments', $lang);
    

                                  } ?>


    


                         
                  </div>
                </div>
              </div>




                                            <!--<?php foreach ($accompanyingitems as $item) {  


                                                MakeItemList($item, 'uniqueName', $lang); 
                                                MakeItemList($item, 'archiveCode', $lang); 
                                                MakeItemList($item, 'documentPath', $lang); 

                                             } ?>-->


  





   

 
      
      
  


               
              
         

    
