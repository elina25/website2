<?php
require_once("inc/init.php");
require_once("inc/lang.php");



$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerSponsor = new ControllerSponsor();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$sponsordetails = $ControllerSponsor->getSponsorWithID($_GET['item_id'], $CultureID);

print_r($sponsordetails);





?>



      
           <div class="tab-content">
              <div class="tab-pane active" id="tab-all" role="tabpanel">
                  <div class="listing-boxes">

                

        <!--<?php foreach ($accompanyingitems as $item) {  


                MakeItemList($item, 'uniqueName', $lang); 
                MakeItemList($item, 'archiveCode', $lang); 
                MakeItemList($item, 'documentPath', $lang); 

         } ?>-->


                            <?php if (count($sponsordetails) > 0){ ?>
                                  <div class="listing-detail-section" id="listing-detail-GeneralDetails" data-title="<?php echo $lang['GeneralDetails'];?>">
                                    <h4><?php echo $lang['GeneralDetails']; ?></h4>
                                        <div class="box">
                                          <div class="box-inner">
                                             <div class="overview overview-half overview-no-margin">
                                               <?php foreach ($sponsordetails as $sponsordetail) {  
                                                    MakeItemList($sponsordetail, 'FriendlyName', $lang,); 
                                                 

                                                } ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                            <?php } ?>




 
        </div>
    </div>
</div>
    
