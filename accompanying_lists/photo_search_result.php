<?php
require_once("../inc/init.php");
if (isset($_GET['lang']) === false) {
    include '../lang/gr/language.php';
    $CultureID = 1;
} else {
    include '../lang/' . $_GET['lang'] . '/language.php';
    if ($_GET['lang'] == "en")
        $CultureID = 2;
}
$langParam = ((isset($_GET['lang']) === false) ? '' : '&lang=' . $_GET['lang']);
?>
<div class="tab-content" id="search_result_box">
    <?php
    $controller = new ControllerPhoto();
    $ControllerAccompanyingObject = new ControllerAccompanyingObject();

    $item_type_id = $_GET['item_type_id'];
    $search_peram = $_POST ? $_POST : '';
    $total_records = $controller->getSearchPhotos($CultureID, $search_peram);
    $countOfRecords = count($total_records);

    include('../pagination/pagination_file.php');

    $photos = $controller->getSearchPhotos($CultureID, $search_peram, $PAGE_SIZE, $offset);
    ?>
    <div class="tab-pane active" id="tab-all" role="tabpanel">
        <div class="ajax_search">
            <div class="table-wrapper">
                <div class="overview">
                    <ul>
                        <?php if ($countOfRecords > 0) { ?>
                            <?php foreach ($photos as $photo) { ?>

                                <div class="listing-row">
                                    <div class="listing-row-inner">
                                        <a class="listing-row-image" href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php
                                        echo $photo->photoID;
                                        echo $langParam;
                                        ?>">
                                            <span class="listing-row-image-content" style="background-image: url('../data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΦΩΤΟΓΡΑΦΙΚΟ ΥΛΙΚΟ/WebThumbsSmall/thumb_<?php echo $photo->documentPath ?>'); "></span>
                                            <!--<span class="listing-row-image-content" style="background-image: url('https://apanarchive.gr/data/ΣΥΝΟΔΕΥΤΙΚΟ ΥΛΙΚΟ/ΦΩΤΟΓΡΑΦΙΚΟ ΥΛΙΚΟ/WebThumbsSmall/thumb_<?php echo $photo->documentPath ?>'); "></span>-->
                                        </a>
                                        <div class="listing-row-content">
                                            <div class="listing-row-content-header">
                                                <h3><a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php
                                                    echo $photo->photoID;
                                                    echo $langParam;
                                                    ?>"><?php echo $photo->title ?></a></h3>                         
                                            </div>
                                            <!-- /.listing-row-content-header -->
                                            <div  class="listing-row-content-meta">
                                                <div class="listing-row-content-meta-item">
                                                    <?php $relations = $ControllerAccompanyingObject->GetAllRelationsFromPhotosToOthers($photo->photoID); ?>
                                                    <?php echo $lang['related_to'] ?>
                                                    <?php // if (isset($relations[0]) && $relations[0]) { ?>
                                                    <?php if (isset($relations) && $relations) { ?>
                                                        <?php if ($relations[0]->itemTypeID == 1) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToReligiousMonument($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 2) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosTochristianorthodoxMonumentsDetails($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 3) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToArtworks_details($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->FriendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 4) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToEducationalFoundationDetails($relations[0]->itemID, $CultureID); ?>

                                                        <?php echo $related_to[0]->friendlyName; ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 5) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToEpigraphsDetails($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 6) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosTocommunityDetails($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 7) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosTocemeteryDetails($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 13) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToArchRel($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 14) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToArchSite($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 15) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToFortress($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 16) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToTomb($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->name ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 17) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToMuseums($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 18) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToExhibition($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 19) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToAdminBuildings($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 20) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToWelfareBuilding($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 21) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToInfrastructureBuilding($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 22) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToResidentialBuildingId($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->friendlyName ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 23) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToCoin($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->frontView ?>

                                                        <?php } else if ($relations[0]->itemTypeID == 24) { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToPersonDetails($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->fullName ?>

                                                        <?php } else { ?>

                                                            <?php $related_to = $controller->GetAllRelationsWithfriendlyNameFromPhotosToReligiousEvent($relations[0]->itemID, $CultureID); ?>

                                                            <?php echo $related_to[0]->title ?>

                                                        <?php } ?>
                                                    <?php } ?>

                                                </div>

                                            </div>
                                            <!-- /.listing-row-meta-item -->

                                            <!-- /.listing-row-content-body -->
                                        </div>
                                        <!-- /.listing-row-content -->
                                    </div>
                                    <!-- /.listing-row-inner -->
                                </div>


                            <?php } ?>
                            <?php include('../pagination/pagination_pages.php'); ?>
                        <?php } else { ?>
                            <h2 class="text-center"><?php echo $lang['no_result_msg']; ?></h2>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane not-show" id="tab-rent" role="tabpanel">
        <div class="">
            <div class="row">
                <div class="blog-container classic" style="padding-top:40px;">
                    <article>
                        <div class="content" style="width:100%;">
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ************************************************************************* END OF MAIN PAGE *************************************************************************** -->
