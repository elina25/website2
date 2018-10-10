<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerBibliography = new ControllerBibliography();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerKeyword = new ControllerKeyword();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$informations = $ControllerBibliography->getBibliographyWithID($_GET['item_id']);
$keywords = $ControllerKeyword->getKeywordForEachItem($_GET['item_id'],$CultureID); 
$details = $ControllerBibliography->getBibliographyDetailsWithID($_GET['item_id'], $CultureID);
$documentsForms = $ControllerBibliography->getDocumentFormIDWithID($_GET['item_id'], $CultureID);


?>





             <!-- <?php foreach ($accompanyingitems as $item) {  
                MakeItemList($item, 'uniqueName', $lang); 
              } ?>-->


                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">


                              <table class="table table-bordered opening-hours">
                                  <tbody>
                                      <?php foreach ($informations as $information) { ?>
                                        <?php if(!IsNullOrEmpty($informations[0]->abbreviationPlainText)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['abbreviationPlainText']; ?></th>
                                            <td><?php echo $information->abbreviationPlainText?></td>
                                          </tr>
                                        <?php  } ?>

                                        <?php if(!IsNullOrEmpty($informations[0]->authors)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['authors']; ?></th>
                                            <td><?php echo $information->authors?></td>
                                          </tr>
                                        <?php  } ?>

                                        <?php 
                                          if(!IsNullOrEmpty($informations[0]->PhoneticTranscription)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['titlePlainText']; ?></th>
                                            <td><?php echo $information->titlePlainText?></td>
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
                                          if(!IsNullOrEmpty($informations[0]->firstPublisher)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['firstPublisher']; ?></th>
                                            <td><?php echo $information->firstPublisher?></td>
                                          </tr>
                                        <?php } ?>

                                         <?php 
                                          if(!IsNullOrEmpty($informations[0]->originalTitlePlainText)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['originalTitlePlainText']; ?></th>
                                            <td><?php echo $information->originalTitlePlainText?></td>
                                          </tr>
                                        <?php } ?>

                                         <?php 
                                          if(!IsNullOrEmpty($informations[0]->ISBN_ISDN)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['ISBN_ISDN']; ?></th>
                                            <td><?php echo $information->ISBN_ISDN?></td>
                                          </tr>
                                        <?php } ?>

                                          <?php 
                                          if(!IsNullOrEmpty($informations[0]->scientificEditor)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['scientificEditor']; ?></th>
                                            <td><?php echo $information->scientificEditor?></td>
                                          </tr>
                                        <?php } ?>

                                          <?php 
                                          if(!IsNullOrEmpty($informations[0]->volume)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['volume']; ?></th>
                                            <td><?php echo $information->volume?></td>
                                          </tr>
                                        <?php } ?>

                                          <?php 
                                          if(!IsNullOrEmpty($informations[0]->CurrentLocation)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['CurrentLocation']; ?></th>
                                            <td><?php echo $information->CurrentLocation?></td>
                                          </tr>
                                        <?php } ?>

                                         <?php 
                                          if(!IsNullOrEmpty($informations[0]->translator)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['translator']; ?></th>
                                            <td><?php echo $information->translator?></td>
                                          </tr>
                                        <?php } ?>

                                         <?php 
                                          if(!IsNullOrEmpty($informations[0]->pages)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['pages']; ?></th>
                                            <td><?php echo $information->pages?></td>
                                          </tr>
                                        <?php } ?>

                                          <?php 
                                          if(!IsNullOrEmpty($informations[0]->publisher)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['publisher']; ?></th>
                                            <td><?php echo $information->publisher?></td>
                                          </tr>
                                        <?php } ?>

                                           <?php 
                                          if(!IsNullOrEmpty($informations[0]->issue)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['issue']; ?></th>
                                            <td><?php echo $information->issue?></td>
                                          </tr>
                                        <?php } ?>

                                           <?php 
                                          if(!IsNullOrEmpty($informations[0]->editionNumber)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['editionNumber']; ?></th>
                                            <td><?php echo $information->editionNumber?></td>
                                          </tr>
                                        <?php } ?>

                                           <?php 
                                          if(!IsNullOrEmpty($informations[0]->publicationPlace)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['publicationPlace']; ?></th>
                                            <td><?php echo $information->publicationPlace?></td>
                                          </tr>
                                        <?php } ?>

                                          <?php 
                                          if(!IsNullOrEmpty($informations[0]->publicationYear)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['publicationYear']; ?></th>
                                            <td><?php echo $information->publicationYear?></td>
                                          </tr>
                                        <?php } ?>

                                           <?php 
                                          if(!IsNullOrEmpty($informations[0]->firstPublicationPlace)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['firstPublicationPlace']; ?></th>
                                            <td><?php echo $information->firstPublicationPlace?></td>
                                          </tr>
                                        <?php } ?>

                                            <?php 
                                          if(!IsNullOrEmpty($informations[0]->firstPublicationYear)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['firstPublicationYear']; ?></th>
                                            <td><?php echo $information->firstPublicationYear?></td>
                                          </tr>
                                        <?php } ?>

                                            <?php 
                                          if(!IsNullOrEmpty($informations[0]->journalPlainText)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['journalPlainText']; ?></th>
                                            <td><?php echo $information->journalPlainText?></td>
                                          </tr>
                                        <?php } ?>

                                             <?php 
                                          if(!IsNullOrEmpty($informations[0]->isSource)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['isSource']; ?></th>
                                            <td><?php echo $information->isSource?></td>
                                          </tr>
                                        <?php } ?>

                                        <?php } ?>

                                          <?php foreach ($documentsForms as $documentsForm) { ?>
                                              <?php 
                                          if(!IsNullOrEmpty($documentsForms[0]->lookupValue)){ ?>
                                          <tr>
                                            <th class="min-width center"><?php echo $lang['kind_of_book']; ?></th>
                                            <td><?php echo $documentsForm->lookupValue?></td>
                                          </tr>
                                        <?php } ?>

                                      <?php } ?>
                                </tbody>
                                </table>



                 
                      
                 
                   
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


                          <?php 
                            if(!IsNullOrEmpty($details[0]->commentsPlainText)){ ?>
                            <button style="color:#7f7f7f; width: 100%; background-color: #ffffff; box-shadow: 0 1px 2px rgba(50, 50, 50, 0.12); text-align: left;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#comments"></i><?php echo $lang['comments']; ?><i style="padding-left: 10px;" class="fa fa-angle-down"></i></button>
                                <div id="comments" class="collapse">
                                  <div class="box">
                                    <div class="box-inner">
                                      <?php foreach ($details as $detail) {  ?>
                                        <?php echo $detail->commentsPlainText ?>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </div>
                          <?php  } ?>



                          <?php 
                            if(!IsNullOrEmpty($details[0]->elements)){ ?>
                            <button style="color:#7f7f7f; width: 100%; background-color: #ffffff; box-shadow: 0 1px 2px rgba(50, 50, 50, 0.12); text-align: left;" type="button" class="btn btn-info" data-toggle="collapse" data-target="#elements"></i><?php echo $lang['details']; ?><i style="padding-left: 10px;" class="fa fa-angle-down"></i></button>
                                <div id="elements" class="collapse">
                                  <div class="box">
                                    <div style="text-align: justify;" class="box-inner">
                                      <?php foreach ($details as $detail) {  ?>
                                        <?php echo $detail->elements ?>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </div>
                          <?php  } ?>


                       <div style="margin-top: 15px;" class="box">
                          <div class="box-inner">
                              <div class="cat-links icon-meta">
                                  <i class=""></i><b><?php echo $lang['collectiveWork']; ?></b>&nbsp;&nbsp;
                                  <input type="checkbox" name="tag_1" id="tag_1" value="1"  disabled="disabled" <?php echo ($informations[0]->$collectiveWork['tag_1']==1 ? 'checked' : 'not checked');?>>
                                  <?php echo $collectiveWork; ?>
                              </div>
                          </div>
                      </div>


                    <!--     <?php 
                            if(!IsNullOrEmpty($details[0]->commentsPlainText)){ ?>
                             <h4><?php echo $lang['comments']; ?></h4>
                              <div class="box">
                                <div class="box-inner">
                                    <div class="overview overview-half overview-no-margin">
                                      <div class="entry-summary">
                                          <?php foreach ($details as $detail) {  ?>
                                            <?php echo $detail->commentsPlainText ?>
                                          <?php } ?>
                                     </div>
                                </div>
                              </div>
                              </div>
                        <?php } ?>
 -->




                      </div>
                  </div>
              </div>







  

       