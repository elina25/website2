<?php
require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$ControllerPhoto = new ControllerPhoto();
$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'],$_GET['item_id']);
$photodetails = $ControllerPhoto->getPhotosDetailsWithID($_GET['item_id'],$CultureID); 
$photos = $ControllerPhoto->getPhotosWithID($_GET['item_id']);

//$keywords = $ControllerRegion->getKeywordFromRegion($_GET['item_id'],$CultureID);


?>





      
                   <div class="tab-content">
                      <div class="tab-pane active" id="tab-all" role="tabpanel">
                        <div class="gallery">
                          <?php foreach ($photodetails as $photo) {  ?>
                          <a href="#" class="button buttonpadding" id="modal-action-submit" data-toggle="modal" data-target="#modal-submit">
                            <div class="gallery-item" style="background-image: url('https://apanarchive.gr/data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΦΩΤΟΓΡΑΦΙΚΟ ΥΛΙΚΟ/WebThumbsLarge/thumb_<?php echo $photo->documentPath?>'); ">
                            
                            </div>
                          </a>
                            <?php  } ?>
                          </div>
                          <div class="listing-boxes">
                              <table class="table table-bordered opening-hours">
                                <tbody>
                                <?php foreach ($photodetails as $photodetail) { ?>
                                <?php 
                                if(!IsNullOrEmpty($photodetails[0]->title)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['title']; ?></th>
                                    <td><?php echo $photodetail->title?></td>
                                  </tr>
                                  <?php } ?>
                                  <?php 
                                if(!IsNullOrEmpty($photodetails[0]->Photographer)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['Photographer']; ?></th>
                                    <td><?php echo $photodetail->Photographer?></td>
                                  </tr>
                                  <?php  } ?>
                                  <?php if(!IsNullOrEmpty($photodetails[0]->PhotoDescription)){ ?>
                                  <tr>
                                    <th class="min-width center"><?php echo $lang['PhotoDescription']; ?></th>
                                    <td><?php echo $photodetail->PhotoDescription?></td>
                                  </tr>
                                  <?php  } ?>
                                  <?php } ?>
                                </tbody>
                              </table>

                                <?php if(count($keywords) > 0){?>
                              <h3><?php echo $lang['keywords'];?></h3>
                                <div class="box">
                                  <div class="box-inner">
                                    <?php foreach ($keywords as $keywordd){ ?>
                                      <?php echo " " . " " . $keywordd->KeywordTranslation . " " . "|" ?>
                                    <?php } ?>
                                  </div>
                                </div>
                            <?php } ?>
                            
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
        <div class="gallery-item-modal" style="background-image: url('https://apanarchive.gr/data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΦΩΤΟΓΡΑΦΙΚΟ ΥΛΙΚΟ/<?php echo $photo->documentPath?>'); ">
        </div>
     </div>
    </div>
  </div>
</div>
