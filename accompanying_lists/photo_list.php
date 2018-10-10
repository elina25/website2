<div class="tab-content" id="search_result_box">
    <?php
    $controller = new ControllerPhoto();
    $ControllerAccompanyingObject = new ControllerAccompanyingObject();
    $ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();


    $countOfRecords = $controller->getAllPhotoCount($CultureID);
//$relatedToItems = $ControllerArchivedObjectRelations->ViewRelatedItemsToPhoto($CultureID);
    $photo_sources = $controller->GetAllPhotosSources($CultureID);
    $KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID(1, $CultureID);

    include('pagination/pagination_file.php');

    $photos = $controller->getAllPhotos($CultureID, $PAGE_SIZE, $offset);
    $item_type_id = $_GET['item_type_id'];
    ?>
    <div class="tab-pane active" id="tab-all" role="tabpanel">
        <div class="">
            <div class="table-wrapper">
                <div class="overview">
                    <ul>

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
                                                <?php echo $lang['related_to']; ?>
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
                        <?php include('pagination/pagination_pages.php'); ?>
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
</div>
</div>



<!-- ************************************************************************* END OF MAIN PAGE *************************************************************************** -->
<!-- ************************************************************************* START OF FILTERS  *************************************************************************** -->

<div class="col-md-4 col-lg-3">
    <div class="sidebar" id="sidebar_two_region">


        <div class="filter filter-boxed filter-gray">
            <form id="filters-form" name="photo-form" onSubmit="select_data(); return false;" >
                <h2><?php echo $lang['search_criteria'] ?></h2>
                <div class="form-group">
                    <label for="exampleSelect2"> <b><?php echo $lang['TypeOfAccompanyingObject'] ?></b></label>
                    <select multiple class="form-control" id="MainUnities" name="MainUnities[]">
                        <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                        <?php foreach ($typesOfMainUnities as $type) { ?>
                            <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false) ? $type->SingularDesc : $type->StandardName ) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                </div>

                <div class="form-group">
                    <label><?php echo $lang['title'] ?></label>
                    <select class="form-control" id="title_type" name="title_type">
                        <option value="or"><?php echo $lang['one_or_more_selected_word'] ?></option>
                        <option value="and"><?php echo $lang['all_of_the_selected_words'] ?></option>
                        <option value="exact"><?php echo $lang['the_whole_sentence'] ?></option>
                    </select>
                    <input type="text" name="title" id="title" class="form-control" placeholder="<?php echo $lang['search_title'] ?>">
                </div> 


                <div class="form-group">
                    <label for="photo_source"><?php echo $lang['source'] ?></label>
                    <select name="photo_source" class="form-control" id="exampleSelect2">
                        <option value="">---------Select <?php echo $lang['source'] ?>---------</option>
                        <?php foreach ($photo_sources as $photo_source) { ?>
                            <option value="<?php echo $photo_source->photoSourceID; ?>"><?php echo $photo_source->lookupValue ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="keywords"><?php echo $lang['keyword'] ?></label>

                    <select class="form-control" id="keyword_search_type" name="keyword_search_type">
                        <option value="and"><?php echo $lang['selected_all'] ?></option>
                        <option value="or"><?php echo $lang['one_or_more_selected'] ?></option>
                    </select>
                    <select multiple class="form-control" id="keywords" name="keywords[]">
                        <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                            <option value="<?php echo $KeywordsFilter->KeywordID ?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                        <?php } ?>
                    </select>
                    <label for="keywords"><?php echo $lang['multiple_select'] ?></label>
                </div>


                <div class="form-group-btn form-group-btn-placeholder-gap">
                    <button type="submit" id="search_btn" class="btn btn-primary btn-block"><?php echo $lang['Search'] ?></button>
                </div>

                <button type="button" style="margin-left:70px; border: none; background-color:#eeeeee; " id="clear_filters"><?php echo $lang['clear'] ?></button>
                <span class="submit_notification"></span>
                <input type="hidden" name="submit_search" value="true">
            </form>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#clear_filters").click(function () {
            var resetbuttom = document.getElementById("filters-form");
            resetbuttom.reset();
            select_data();
        });
        $(document).off("click", ".ajax_search .page-link").on("click", '.ajax_search .page-link', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('.page-link').css("pointer-events", "none");
            select_data(url);
        });
    });

    function select_data(u) {
        var form = $("#filters-form");
        var btn = $("#search_btn");
        var old_val = btn.html();
        url = u ? u : 'accompanying_lists/photo_search_result.php?item_type_id=<?php echo $item_type_id . $langParam; ?>&page=1';
        $.ajax({
            url: url,
            type: 'post',
            data: form.serialize(),
            beforeSend: function () {
                $('.error,.submit_notification').html('');
                $('.btn,.label').attr("disabled", "disabled");
                btn.html('Searching...');
            },
            success: function (result) {
                $('.btn,.label').removeAttr("disabled");
                btn.html(old_val);
                $("#sy").find("#search_result_box").replaceWith(result);
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            },
            error: function (e) {
                $('.btn,.label').removeAttr("disabled");
                btn.html(old_val);
                $('.submit_notification').html('<span class="text-danger error">Something Went Wrong!... Please try again after refresh</span>');
            }
        });
        return false;
    }

</script>

<!-- ************************************************************************* END OF FILTERS  *************************************************************************** -->
