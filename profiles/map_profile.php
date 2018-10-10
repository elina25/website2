<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerMap = new ControllerMap();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$documentdetails = $ControllerMap->getAllMapDetailWithID($_GET['item_id'], $CultureID);
$maps = $ControllerMap->getAllMapsWithID($_GET['item_id']);
//$kinds = $ControllerDocument->getKindOfAudioVisualWithID($_GET['item_id'], $CultureID);
//$characterazations = $ControllerDocument->getCharacterizationOfAudioVisualWithID($_GET['item_id'], $CultureID);
//$keywords = $ControllerDocument->getKeywordFromAudioVisualID($_GET['item_id'], $CultureID);
//$usages = $ControllerDocument->getUsageFromAudioVisualID($_GET['item_id']);
//$usagedetails = $ControllerDocument->getUsageDetailsFromAudioVisualID($_GET['item_id'], $CultureID);
//$sources = $ControllerDocument->getDocumentSourceWithID($_GET['item_id'], $CultureID);
//$forms = $ControllerDocument->getDocumentFormWithID($_GET['item_id'], $CultureID);
//$origins = $ControllerDocument->getDocumentOriginWithID($_GET['item_id'], $CultureID);
//$typecontents = $ControllerDocument->getDocumentTypeContentWithID($_GET['item_id'], $CultureID);
//$characterazations = $ControllerDocument->getDocumentCharactWithID($_GET['item_id'], $CultureID);


?>



      
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                 
                  <div class="gallery">
                    <?php foreach ($documentdetails as $documentdetail) {  ?>

                        <a href="#" class="button buttonpadding" id="modal-action-submit" data-toggle="modal" data-target="#modal-submit">
                            <div class="gallery-item" style="background-image: url('https://apanarchive.gr/data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΧΑΡΤΕΣ/WebThumbsLarge/thumb_<?php echo $documentdetail->documentPath?>'); ">
                        
                            </div>
                        </a>
                    <?php  } ?>
                </div>

                  


                 <div class="listing-boxes">


        <!--<?php foreach ($accompanyingitems as $item) {  


                MakeItemList($item, 'uniqueName', $lang); 
                MakeItemList($item, 'archiveCode', $lang); 
                MakeItemList($item, 'documentPath', $lang); 

         } ?>-->
                <table class="table table-bordered opening-hours">
                    <tbody>
                      <?php foreach ($documentdetails as $documentdetail) { ?>
                        <?php if(!IsNullOrEmpty($documentdetails[0]->Title)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['title']; ?></th>
                            <td><?php echo $documentdetail->Title?></td>
                          </tr>
                          <?php  } ?>

                          <?php if(!IsNullOrEmpty($documentdetails[0]->Description)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Description']; ?></th>
                            <td><?php echo $documentdetail->Description?></td>
                          </tr>
                          <?php  } ?>

                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Chartographer)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Chartographer']; ?></th>
                            <td><?php echo $documentdetail->Chartographer?></td>
                          </tr>
                          <?php } ?> 

                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Publisher)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Publisher']; ?></th>
                            <td><?php echo $documentdetail->Publisher?></td>
                          </tr>
                          <?php } ?>
                        <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Languages)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Languages']; ?></th>
                            <td><?php echo $documentdetail->Languages?></td>
                          </tr>
                          <?php } ?>
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->PublicationPlace)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['PublicationPlace']; ?></th>
                            <td><?php echo $documentdetail->PublicationPlace?></td>
                          </tr>
                          <?php } ?> 
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->PublicationCountry)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['PublicationCountry']; ?></th>
                            <td><?php echo $documentdetail->PublicationCountry?></td>
                          </tr>
                          <?php } ?> 
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->PublicationYear)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['PublicationYear']; ?></th>
                            <td><?php echo $documentdetail->PublicationYear?></td>
                          </tr>
                          <?php } ?>  
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->OtherInfo)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['OtherInfo']; ?></th>
                            <td><?php echo $documentdetail->OtherInfo?></td>
                          </tr>
                          <?php } ?>  
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Verso)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Verso']; ?></th>
                            <td><?php echo $documentdetail->Verso?></td>
                          </tr>
                          <?php } ?> 
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Corrections)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Corrections']; ?></th>
                            <td><?php echo $documentdetail->Corrections?></td>
                          </tr>
                          <?php } ?>  
                          <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Source)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['source']; ?></th>
                            <td><?php echo $documentdetail->Source?></td>
                          </tr>
                          <?php } ?>
                           <?php 
                          if(!IsNullOrEmpty($documentdetails[0]->Comments)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['comments']; ?></th>
                            <td><?php echo $documentdetail->Comments?></td>
                          </tr>
                          <?php } ?>  
                          <?php } ?>
                    </tbody>
                </table>


                   <table class="table table-bordered opening-hours">
                    <tbody>
                      <?php foreach ($maps as $map) { ?>
                        <?php if(!IsNullOrEmpty($maps[0]->Series)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Series']; ?></th>
                            <td><?php echo $map->Series?></td>
                          </tr>
                          <?php  } ?>

                        <?php if(!IsNullOrEmpty($maps[0]->PublicationYear)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['PublicationYear']; ?></th>
                            <td><?php echo $map->PublicationYear?></td>
                          </tr>
                        <?php  } ?>

                        <?php 
                          if(!IsNullOrEmpty($maps[0]->Scale)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Scale']; ?></th>
                            <td><?php echo $maps->Scale?></td>
                          </tr>
                        <?php } ?> 


                        <?php 
                          if(!IsNullOrEmpty($maps[0]->CopyrightHeldBy)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['CopyrightHeldBy']; ?></th>
                            <td><?php echo $maps->CopyrightHeldBy?></td>
                          </tr>
                        <?php } ?>

                        <?php 
                          if(!IsNullOrEmpty($maps[0]->Location)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['Location']; ?></th>
                            <td><?php echo $maps->Location?></td>
                          </tr>
                        <?php } ?>

                        <!-- <?php 
                          if(!IsNullOrEmpty($maps[0]->PrivateData)){ ?>
                          <tr>
                            <th class="min-width center"><?php echo $lang['PrivateData']; ?></th>
                            <td><?php echo $maps->PrivateData?></td>
                          </tr>
                        <?php } ?> -->
                      <?php } ?>
                    </tbody>
                </table>



                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->IsShrinked) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['IsShrinked']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['IsShrinked']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>

                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->IsMagnified) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['IsMagnified']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['IsMagnified']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>

                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->RightToUse) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['RightToUse']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['RightToUse']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>

                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->ExistSlides) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['ExistSlides']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['ExistSlides']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>

                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->ExistPhotos) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['ExistPhotos']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['ExistPhotos']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>

                <?php if(count($maps) > 0){?>
                    <div class="table boxcustompadding">
                      <div class="box-inner">
                        <ul class="amenities">
                          <?php if (($maps[0]->CopyrightHeldByApan) == 1 ) { ?>
                          <li class="yes"><?php echo $lang['CopyrightHeldByApan']; ?></li>
                          <?php } else { ?>
                          <li class="no"><?php echo $lang['CopyrightHeldByApan']; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                <?php } ?>

             
                         

     


                         

                     


                           <!--<?php if (count($sources) > 0){ ?>
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
                            <?php } ?>

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

                            <?php if (count($typecontents) > 0){ ?>
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
                               <?php } ?>-->


 
        </div>
    </div>
</div>



<div id="modal-submit" class="modal fade">    <!-- Map pop up modal box -->
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


            <div class="gallery-item-modal" style="background-image: url('https://apanarchive.gr/data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΧΑΡΤΕΣ/<?php echo $documentdetail->documentPath?>'); ">
            </div>


            </div>

        </div>
      </div>
</div>

