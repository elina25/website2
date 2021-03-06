<div class="tab-content" id="search_result_box">
    <?php
    $controller = new ControllerMap();
    $countOfRecords = $controller->getAllMapCount($CultureID);

    include('pagination/pagination_file.php');

    $maps = $controller->getAllMaps($CultureID, $PAGE_SIZE, $offset);
    $maps_kinds = $controller->getAllMapsKindDetails($CultureID);
    $KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID(8, $CultureID);

    $item_type_id = $_GET['item_type_id'];
    ?>
    <div class="tab-pane active" id="tab-all" role="tabpanel">
        <div class="">
            <div class="table-wrapper">
                <div class="overview">
                    <ul>

                        <?php foreach ($maps as $map) { ?>
                            <li class="nav-item featured"> 
                                <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php echo $map->MapID . $langParam; ?>" class="nav-link">
                                    <?php echo $map->Title ?>
                                </a>
                            </li>
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
            <form id="filters-form" name="map-form" onSubmit="select_data(); return false;">
                <h2><?php echo $lang['search_criteria'] ?></h2>

                <div class="form-group">
                    <label for="MainUnities"><b> <?php echo $lang['TypeOfAccompanyingObject'] ?> </b></label>
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
                    <input type="text" class="form-control" name="title" placeholder="<?php echo $lang['search_title'] ?>">
                </div>

                <div class="form-group">
                    <label for="maps_kinds"><?php echo $lang['kind'] ?></label>
                    <select class="form-control" id="maps_kinds_type" name="maps_kinds_type">
                        <option value="and"><?php echo $lang['selected_all'] ?></option>
                        <option value="or"><?php echo $lang['one_or_more_selected'] ?></option>
                    </select>
                    <select multiple class="form-control" id="maps_kinds" name="maps_kinds[]">
                        <?php foreach ($maps_kinds as $maps_kind) { ?>
                            <option value="<?php echo $maps_kind->MapKindID; ?>"><?php echo $maps_kind->LookupValue ?></option>
                        <?php } ?>
                    </select>
                    <label for="maps_kinds"><?php echo $lang['multiple_select'] ?></label>
                </div>

                <div class="form-group">
                    <label for="keywords"><?php echo $lang['keyword'] ?></label>
                    <select class="form-control" id="keyword_search_type" name="keyword_search_type">
                        <option value="and"><?php echo $lang['all_selected_keywords'] ?></option>
                        <option value="or"><?php echo $lang['any_of_the_selected_keyword'] ?></option>
                    </select>
                     <select multiple class="form-control" id="keywords" name="keywords[]">
                        <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                            <option value="<?php echo $KeywordsFilter->KeywordID ?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                        <?php } ?>
                    </select>
                    <label for="keywords"><?php echo $lang['multiple_select'] ?></label>
                </div>


                <div class="form-group-btn form-group-btn-placeholder-gap">
                    <button type="submit" class="btn btn-primary btn-block" id="search_btn"><?php echo $lang['Search'] ?></button>
                    <button type="button" style="margin-left:70px; border: none; background-color:#eeeeee; " id="clear_filters"  class=""><?php echo $lang['clear'] ?></button>
                </div>
                <span class="submit_notification"></span>

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
        url = u ? u : 'accompanying_lists/map_search_result.php?item_type_id=<?php echo $item_type_id . $langParam; ?>&page=1';
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
