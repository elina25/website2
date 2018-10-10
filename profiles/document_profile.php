<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerDocument = new ControllerDocument();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$documentdetails = $ControllerDocument->getDetailsDocumentWithID($_GET['item_id'], $CultureID);
$documents = $ControllerDocument->getDocumentWithID($_GET['item_id']);
//$kinds = $ControllerDocument->getKindOfAudioVisualWithID($_GET['item_id'], $CultureID);
//$characterazations = $ControllerDocument->getCharacterizationOfAudioVisualWithID($_GET['item_id'], $CultureID);
$keywords = $ControllerDocument->getKeywordFromAudioVisualID($_GET['item_id'], $CultureID);
//$usages = $ControllerDocument->getUsageFromAudioVisualID($_GET['item_id']);
//$usagedetails = $ControllerDocument->getUsageDetailsFromAudioVisualID($_GET['item_id'], $CultureID);
$sources = $ControllerDocument->getDocumentSourceWithID($_GET['item_id'], $CultureID);
$forms = $ControllerDocument->getDocumentFormWithID($_GET['item_id'], $CultureID);
$origins = $ControllerDocument->getDocumentOriginWithID($_GET['item_id'], $CultureID);
$typecontents = $ControllerDocument->getDocumentTypeContentWithID($_GET['item_id'], $CultureID);
$characterazations = $ControllerDocument->getDocumentCharactWithID($_GET['item_id'], $CultureID);





?>



      
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                  <div class="listing-boxes">

                

        <!--<?php foreach ($accompanyingitems as $item) {  


                MakeItemList($item, 'uniqueName', $lang); 
                MakeItemList($item, 'archiveCode', $lang); 
                MakeItemList($item, 'documentPath', $lang); 

        } ?>-->



                                <table class="table table-bordered opening-hours">
                                  <tbody>
                                    <?php foreach ($documentdetails as $documentdetail) { ?>
                                    
                                
                                      <?php if(!IsNullOrEmpty($documentdetails[0]->AbbreviationPlainText)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['abbreviationPlainText']; ?></th>
                                        <td><?php echo $documentdetail->AbbreviationPlainText?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($documentdetails[0]->TitlePlainText)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['titlePlainText']; ?></th>
                                        <td><?php echo $documentdetail->TitlePlainText?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->SubtitlePlainText)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['subtitle']; ?></th>
                                        <td><?php echo $documentdetail->SubtitlePlainText?></td>
                                      </tr>
                                      <?php } ?> 

                                      <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->Authors)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['authors']; ?></th>
                                        <td><?php echo $documentdetail->Authors?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->Translators)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['Translators']; ?></th>
                                        <td><?php echo $documentdetail->Translators?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->SubmissionInfo)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['SubmissionInfo']; ?></th>
                                        <td><?php echo $documentdetail->SubmissionInfo?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->UsageInfo)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['UsageInfo']; ?></th>
                                        <td><?php echo $documentdetail->UsageInfo?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->Notes)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['Notes']; ?></th>
                                        <td><?php echo $documentdetail->Notes?></td>
                                      </tr>
                                      <?php } ?>

                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->DatesMentioned)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['DatesMentioned']; ?></th>
                                        <td><?php echo $documentdetail->DatesMentioned?></td>
                                      </tr>
                                      <?php } ?>


                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->CommentsPlainText)){ ?>
                                        <tr>
                                        <th class="min-width center"><?php echo $lang['CommentsPlainText']; ?></th>
                                        <td><?php echo $documentdetail->CommentsPlainText?></td>
                                      </tr>
                                      <?php } ?>


                                       <?php 
                                        if(!IsNullOrEmpty($documentdetails[0]->Theme)){ ?>
                                        <tr>
                                        <th class="min-width center"><?php echo $lang['Theme']; ?></th>
                                        <td><?php echo $documentdetail->Theme?></td>
                                      </tr>
                                      <?php } ?>

                                    <?php } ?>
                                  </tbody>
                                </table>    


                                  <?php if(count($documents) > 0){?>
                                      <!--  <h3 style="padding-top: 20px;" ><?php echo $lang['IsPublished'];?></h3> -->
                                    <div class="table boxcustompadding">
                                      <div class="box-inner">
                                        <ul class="amenities">
                                          <?php if (($documents->IsPublished) == 1 ) { ?>
                                          <li class="yes"><?php echo $lang['IsPublished']; ?></li>
                                          <?php } else { ?>
                                          <li class="no"><?php echo $lang['IsPublished']; ?></li>
                                          <?php } ?>
                                        </ul>
                                      </div>
                                    </div>
                                  <?php } ?>

                                  <?php if(count($documents) > 0){?>
                                      <!--  <h3 style="padding-top: 20px;" ><?php echo $lang['IsExpert'];?></h3> -->
                                    <div class="table boxcustompadding">
                                      <div class="box-inner">
                                           <ul class="amenities">
                                            <?php if (($documents->IsExpert) == 1 ) { ?>
                                            <li class="yes"><?php echo $lang['IsExpert']; ?></li>
                                            <?php } else { ?>
                                            <li class="no"><?php echo $lang['IsExpert']; ?></li>
                                            <?php } ?>
                                          </ul>
                                      </div>
                                    </div>
                                  <?php } ?>

                            <?php if(count($forms) > 0){?>
                              <div class="table boxcustompadding">
                                 <h3><?php echo $lang['form'];?></h3>
                                 <hr>
                                <div class="box-inner">
                                  <ul class="amenities">
                                   <?php foreach ($forms as $form){ ?>
                                    <li class="yes"><?php echo $form->LookupValue?></li>
                                   <?php } ?>
                                  </ul>
                                </div>
                              </div>
                            <?php } ?>

                            <?php if (count($documents) > 0){ ?>
                              <div class="listing-detail-section" id="listing-detail-language" data-title="<?php echo $lang['language'];?>">
                                  <h4><?php echo $lang['language']; ?></h4>
                                  <div class="box">
                                      <div class="box-inner">
                                          <div class="cat-links icon-meta">
                                              <i class=""></i><b><?php echo $documents->LookupValue; ?></b>&nbsp;&nbsp;
                                              <input type="checkbox" name="tag_2" id="tag_2" value="yes"  disabled="disabled" <?php echo ($documents->LookupValue ? 'checked' : '');?>>
                                              <?php echo $LookupValue; ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <?php } ?>

                            
                                  <?php if(count($documents) > 0){?>
                                      <!--  <h3 style="padding-top: 20px;" ><?php echo $lang['IsExpert'];?></h3> -->
                                    <div class="table boxcustompadding">
                                      <div class="box-inner">
                                           <ul class="amenities">
                                            <?php if (($documents->LookupValue) == 1 ) { ?>
                                            <li class="yes"><?php echo $lang['LookupValue']; ?></li>
                                           
                                            <?php } ?>
                                          </ul>
                                      </div>
                                    </div>
                                  <?php } ?>

                                <!--  <?php if (count($documents) > 0){ ?>
                                  <div class="listing-detail-section" id="listing-detail-details" data-title="<?php echo $lang['details'];?>">
                                    <h4><?php echo $lang['details']; ?></h4>
                                        <div class="box">
                                          <div class="box-inner">
                                             <div class="overview overview-half overview-no-margin">
                                               <?php  
                                                    MakeItemList($documents, 'PublicationNamePlainText', $lang, 'PublicationName'); 
                                                    MakeItemList($documents, 'IssueNo', $lang); 
                                                    MakeItemList($documents, 'Pages', $lang); 
                                                    MakeItemList($documents, 'WebAddress', $lang); 
                                                    MakeItemList($documents, 'WritingYear', $lang); 
                                                    MakeItemList($documents, 'PageNumber', $lang); 
                                                    MakeItemList($documents, 'CopyrightHeldByApan', $lang, 'copyrightHeldByApan'); 
                                                    MakeItemList($documents, 'CopyrightHeldByPlainText', $lang, 'copyrightHeldBy'); 
                                                    /*MakeItemList($document, 'PrivateData', $lang);*/
                                                    /*MakeItemList($document, 'DocumentLanguageID', $lang); */
                                                    /*MakeItemList($document, 'CopyrightHeldByPlainText', $lang);*/

                                                ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                <?php } ?>
                                -->

                                <table class="table table-bordered opening-hours">
                                  <tbody>
                                    <?php foreach ($documents as $document) { ?>
                                    
                                
                                      <?php if(!IsNullOrEmpty($documents[0]->PublicationName)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['PublicationNamePlainText']; ?></th>
                                        <td><?php echo $document->PublicationNamePlainText?></td>
                                      </tr>
                                      <?php  } ?>

                                      <?php if(!IsNullOrEmpty($documents[0]->IssueNo)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['IssueNo']; ?></th>
                                        <td><?php echo $document->IssueNo?></td>
                                      </tr>
                                      <?php  } ?>
                                      <?php 
                                        if(!IsNullOrEmpty($documents[0]->Pages)){ ?>
                                        <tr>
                                        <th class="min-width center"><?php echo $lang['Pages']; ?></th>
                                        <td><?php echo $document->Pages?></td>
                                      </tr>
                                      <?php } ?>


                                       <?php 
                                        if(!IsNullOrEmpty($documents[0]->WebAddress)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['WebAddress']; ?></th>
                                        <td><?php echo $document->WebAddress?></td>
                                      </tr>
                                      <?php } ?>

                                        <?php 
                                        if(!IsNullOrEmpty($documents[0]->WritingYear)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['WritingYear']; ?></th>
                                        <td><?php echo $document->WritingYear?></td>
                                      </tr>
                                      <?php } ?>

                                        <?php 
                                        if(!IsNullOrEmpty($documents[0]->PageNumber)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['PageNumber']; ?></th>
                                        <td><?php echo $document->PageNumber?></td>
                                      </tr>
                                      <?php } ?>

                                        <?php 
                                        if(!IsNullOrEmpty($documents[0]->CopyrightHeldByApan)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['CopyrightHeldByApan']; ?></th>
                                        <td><?php echo $document->CopyrightHeldByApan?></td>
                                      </tr>
                                      <?php } ?>

                                      <?php 
                                        if(!IsNullOrEmpty($documents[0]->CopyrightHeldByPlainText)){ ?>
                                      <tr>
                                        <th class="min-width center"><?php echo $lang['CopyrightHeldByPlainText']; ?></th>
                                        <td><?php echo $document->CopyrightHeldByPlainText?></td>
                                      </tr>
                                      <?php } ?>

                                    <?php } ?>
                                  </tbody>
                                </table>    



                           <!--  <?php if (count($sources) > 0){ ?>
                            <div class="listing-detail-section" id="listing-detail-sources" data-title="<?php echo $lang['source'];?>">
                                <h4><?php echo $lang['source']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                    <?php foreach ($sources as $source) { ?>
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $source->LookupValue; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_4" id="tag_4" value="yes"  disabled="disabled" <?php echo ($source->LookupValue ? 'checked' : '');?>>
                                            <?php echo $LookupValue; ?>
                                        </div>
                                    <?php  }  ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> -->


                            <?php if(count($sources) > 0){?>
                              <div class="table boxcustompadding">
                                 <h3><?php echo $lang['source'];?></h3>
                                 <hr>
                                <div class="box-inner">
                                  <ul class="amenities">
                                   <?php foreach ($sources as $source){ ?>
                                    <li class="yes"><?php echo $source->LookupValue?></li>
                                   <?php } ?>
                                  </ul>
                                </div>
                              </div>
                            <?php } ?>


                             <?php if(count($forms) > 0){?>
                              <div class="table boxcustompadding">
                                 <h3><?php echo $lang['form'];?></h3>
                                 <hr>
                                <div class="box-inner">
                                  <ul class="amenities">
                                   <?php foreach ($forms as $form){ ?>
                                    <li class="yes"><?php echo $form->LookupValue?></li>
                                   <?php } ?>
                                  </ul>
                                </div>
                              </div>
                            <?php } ?>



<!-- 
                            <?php if (count($forms) > 0){ ?>
                            <div class="listing-detail-section" id="listing-detail-form" data-title="<?php echo $lang['form'];?>">
                                <h4><?php echo $lang['form']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                    <?php foreach ($forms as $form) { ?>
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $form->LookupValue; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_5" id="tag_5" value="yes"  disabled="disabled" <?php echo ($form->LookupValue ? 'checked' : '');?>>
                                            <?php echo $LookupValue; ?>
                                        </div>
                                        <?php  }  ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
 -->
                            



                            <?php if (count($origins) > 0){ ?>
                              <div class="listing-detail-section" id="listing-detail-origin" data-title="<?php echo $lang['origin'];?>">
                                  <h4><?php echo $lang['origin']; ?></h4>
                                  <div class="box">
                                      <div class="box-inner">
                                          <?php foreach ($origins as $origin) { ?>
                                            <div class="cat-links icon-meta">
                                                <i class=""></i><b><?php echo $origin->LookupValue; ?></b>&nbsp;&nbsp;
                                                <input type="checkbox" name="tag_6" id="tag_6" value="yes"  disabled="disabled" <?php echo ($origin->LookupValue ? 'checked' : '');?>>
                                                <?php echo $LookupValue; ?>
                                            </div>
                                          <?php  }  ?>
                                      </div>
                                  </div>
                              </div>
                            <?php } ?>

                           <!--  <?php if (count($typecontents) > 0){ ?>
                            <div class="listing-detail-section" id="listing-detail-TypeContent" data-title="<?php echo $lang['TypeContent'];?>">
                                <h4><?php echo $lang['TypeContent']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                    <?php foreach ($typecontents as $typecontent) { ?>
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $typecontent->LookupValue; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_7" id="tag_7" value="yes"  disabled="disabled" <?php echo ($typecontent->LookupValue ? 'checked' : '');?>
                                            <?php echo $LookupValue; ?>
                                        </div>
                                        <?php  }  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>-->

                            <?php if(count($typecontents) > 0){?>
                              <div class="table boxcustompadding">
                                 <h3><?php echo $lang['TypeContent'];?></h3>
                                 <hr>
                                <div class="box-inner">
                                  <ul class="amenities">
                                   <?php foreach ($typecontents as $typecontent){ ?>
                                    <li class="yes"><?php echo $typecontent->LookupValue?></li>
                                   <?php } ?>
                                  </ul>
                                </div>
                              </div>
                            <?php } ?>

                             <?php if (count($characterazations) > 0){ ?>
                            <div class="listing-detail-section" id="listing-detail-ch" data-title="<?php echo $lang['ch'];?>">
                                <h4><?php echo $lang['ch']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                    <?php foreach ($characterazations as $char) { ?>
                                        <div class="cat-links icon-meta">
                                            <i class=""></i><b><?php echo $char->LookupValue; ?></b>&nbsp;&nbsp;
                                            <input type="checkbox" name="tag_8" id="tag_8" value="yes"  disabled="disabled" <?php echo ($char->LookupValue ? 'checked' : '');?>
                                            <?php echo $LookupValue; ?>
                                        </div>
                                        <?php  }  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>


                            
                           <?php if (count($keywords) > 0){ ?>
                              <div class="listing-detail-section" id="listing-detail-keyword" data-title="<?php echo $lang['keyword'];?>">
                               <h4><?php echo $lang['keyword']; ?></h4>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                            <?php foreach ($keywords as $keywordd){ ?>
                                            <?php echo $keywordd->KeywordTranslation . " " . "|"?>
                                            <?php } ?>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                           <?php } ?>


 
        </div>
    </div>
</div>
    
