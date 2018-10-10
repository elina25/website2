<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerNote = new ControllerNote();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$details = $ControllerNote->getNotesDetailsWithID($_GET['item_id'], $CultureID);
$informations = $ControllerNote->getNotesWithID($_GET['item_id']);
$keywords = $ControllerNote->getKeywordForNotes($_GET['item_id'], $CultureID);
$chars = $ControllerNote->getCharacterizationOfNote($_GET['item_id'], $CultureID);
$types = $ControllerNote->getPublicationTypeOfNote($_GET['item_id'], $CultureID);

?>



      
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                  <div class="listing-boxes">




                      <h4><?php echo $lang['GeneralDetails']; ?></h4>
                                <div class="box">
                                    <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                        <div class="entry-summary">
                                          
                                            <?php foreach ($details as $detail) {  ?>
                                          
                                            <?php   MakeItemList($detail, 'Abbreviation', $lang,'abbreviationPlainText'); 
                                                    MakeItemList($detail, 'SourceDetailsPlainText', $lang); 
                                                    MakeItemList($detail, 'title', $lang); 
                                                    MakeItemList($detail, 'subtitle', $lang); 
                                                    MakeItemList($detail, 'Authors', $lang, 'authors'); 
                                                    MakeItemList($detail, 'SubmissionInfo', $lang);
                                                    MakeItemList($detail, 'Translators', $lang);
                                                    MakeItemList($detail, 'UsageInfo', $lang); 
                                                    MakeItemList($detail, 'Sponsor', $lang); 
                                                    MakeItemList($detail, 'OtherOwners', $lang);
                                                    MakeItemList($detail, 'Notes', $lang);


                                                      
                                              } ?>

                                              <?php foreach ($informations as $information) {  
                                                    //MakeItemList($audiovisualdetail, 'privateData', $lang); 
                                                        MakeItemList($information, 'PageNumber', $lang); 
                                                        MakeItemList($information, 'IsExcerpt', $lang); 
                                                        MakeItemList($information, 'ExcerptPages', $lang); 
                                                        MakeItemList($information, 'Location', $lang); 
                                                        MakeItemList($information, 'CopyrightHeldByApan', $lang); 
                                                        MakeItemList($information, 'CopyrightHeldByPlainText', $lang , 'copyrightHeldByApan'); 

                                                  } ?>

                                                    <?php foreach ($chars as $char){

                                                        MakeItemList($char, 'characterization', $lang); 

                                                       } ?>
                                                        

                                                      <?php foreach ($types as $type){

                                                        MakeItemList($type, 'publicationType', $lang); 

                                                       } ?>
                                          </div>
                                      </div>
                                    </div>
                                </div>



                                 <?php 
                                  if(!IsNullOrEmpty($detail->CommentsPlainText)){?>
                                   <h4><?php echo $lang['CommentsPlainText']; ?></h4>
                                       <div class="box">
                                         <div class="box-inner">
                                            <div class="overview overview-half overview-no-margin">
                                              <div class="entry-summary">
                                              <?php echo $detail->CommentsPlainText ?>
                                              </div>

                                              
                                             </div>
                                         </div>
                                     </div>
                               <?php } ?>

                                <?php 
                                  if(!IsNullOrEmpty($detail->Content)){?>
                                   <h4><?php echo $lang['Content']; ?></h4>
                                       <div class="box">
                                         <div class="box-inner">
                                            <div class="overview overview-half overview-no-margin">
                                              
                                            <div class="entry-summary">
                                                <?php echo $detail->Content ?>
                                            </div>
                                              
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


                                    










  
      


    <!--<?php foreach ($accompanyingitems as $item) {  


        MakeItemList($item, 'uniqueName', $lang); 
        MakeItemList($item, 'archiveCode', $lang); 
        MakeItemList($item, 'documentPath', $lang); 

     } ?>-->

      
  

    </div>
  </div>
</div>
               
              
         

    
