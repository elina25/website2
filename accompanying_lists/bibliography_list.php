<div class="tab-content" id="search_result_box">
    <?php
    $ControllerBibliography = new ControllerBibliography();
    $FilterObject = BibliographyFilters::Load();
//$countOfRecords = $ControllerBibliography->getAllBibliographyCount($CultureID);
    $biblioRecords = $ControllerBibliography->getAllBibliography2($CultureID, $FilterObject);
    $KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID(4, $CultureID);
    $documentforms = $ControllerBibliography->getAllBibliographyDocumentForms($CultureID); //
    $countOfRecords = count($biblioRecords);

    $currentPage = 1;
    $offset = 0;
    $num_of_pages = 0;

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = $_GET['page'];
    }
    $offset = ($currentPage - 1) * $PAGE_SIZE;
//$bibliographies = $ControllerBibliography->getAllBibliography($CultureID, $PAGE_SIZE, $offset);

    if ($_GET['item_type_id'] == 4) {
        $bibliographies = $ControllerBibliography->getAllBibliography2($CultureID, $FilterObject, $PAGE_SIZE, $offset);
        $item_type_id = $_GET['item_type_id'];
//print_r($FilterObject);

        $num_of_pages = ceil($countOfRecords / $PAGE_SIZE);
    }
    ?>
    <div class="tab-pane active" id="tab-all" role="tabpanel">
        <div class="">
            <div class="table-wrapper">
                <div class="overview">
                    <ul>
                        <?php foreach ($bibliographies as $bibliography) { ?>
                            <li class="nav-item featured"> <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php
                                echo $bibliography->bibliographyID;
                                echo $langParam;
                                ?>  " class="nav-link "><?php echo $bibliography->title ?> </a></li>
                                                          <?php } ?>


                        <ul class="pagination pull-left">
                            <?php include('pagination/pagination_pages.php'); ?>
                        </ul>
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
            <form id="filters-form" name="filters-form" method="get" onSubmit="select_data(); return false;">
                <h2><?php echo $lang['search_criteria'] ?></h2>
                <div class="form-group">
                    <label for="exampleSelect2"> <b><?php echo $lang['TypeOfAccompanyingObject'] ?></b></label>
                    <select multiple class="form-control" id="accompanying_object" name="MainUnities[]">
                        <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                        <?php foreach ($typesOfMainUnities as $type) { ?>
                            <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false) ? $type->SingularDesc : $type->StandardName ) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                </div>
                <div class="form-group">
                    <label><b><?php echo $lang['abbreviation'] ?></b></label>
                    <select class="form-control" id="abbreviation_type" name="abbreviation_type">
                        <option value="or"><?php echo $lang['one_or_more_selected_word'] ?></option>
                        <option value="and"><?php echo $lang['all_of_the_selected_words'] ?></option>
                        <option value="exact"><?php echo $lang['the_whole_sentence'] ?></option>
                    </select>
                    <input type="text" name="abbreviation" id="abbreviation" class="form-control" placeholder="<?php echo $lang['abbreviation'] ?>">
                </div>
                <div class="form-group">
                    <label for="documentForms"><?php echo $lang['document_form'] ?></label>
                    <select multiple class="form-control" id="documentForms" name="documentForms[]">
                        <?php foreach ($documentforms as $documentform) { ?>
                            <option value="<?php echo $documentform->bibliographyDocumentFormID ?>"><?php echo $documentform->lookupValue ?></option>
                        <?php } ?>
                    </select>
                    <label for="documentForms"><?php echo $lang['multiple_select'] ?></label>
                </div>
                <div class="form-group">
                    <label><?php echo $lang['authors'] ?></label>
                    <select class="form-control" id="author_type" name="author_type">
                        <option value="or"><?php echo $lang['one_or_more_selected_word'] ?></option>
                        <option value="and"><?php echo $lang['all_of_the_selected_words'] ?></option>
                        <option value="exact"><?php echo $lang['the_whole_sentence'] ?></option>
                    </select>
                    <input type="text" name="authors" id="authors" class="form-control" placeholder="<?php echo $lang['authors'] ?>">
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
                <!--            <div class="form-group">
                                    <label><?php // echo $lang['subtitle']      ?></label>
                                    <input type="text" class="form-control" placeholder="Enter Subtitle">
                                </div>-->
                <div class="form-group">
                    <label><b><?php echo $lang['keyword'] ?></b></label>
                    <select class="form-control" id="keyword_search_type" name="keyword_search_type">
                        <option value="and"><?php echo $lang['all_selected_keywords'] ?></option>
                        <option value="or"><?php echo $lang['any_of_the_selected_keyword'] ?></option>
                    </select>
                    <select multiple class="form-control" id="keywords" name="keywords[]">
                        <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                            <option value="<?php echo $KeywordsFilter->KeywordID ?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group-btn form-group-btn-placeholder-gap">
                    <button type="submit" class="btn btn-primary btn-block" id="search_btn"><?php echo $lang['Search'] ?></button>
                    <button type="button" style="margin-left:40px; margin-top:10px; background-color:#eeeeee;" id="clear_filters"  class=""><?php echo $lang['clear'] ?></button>
                </div>
                <span class="submit_notification"></span>
                <input type="hidden" name="submit_search" value="true">
            </form>
        </div>
    </div>
</div>
<!-- ************************************************************************* END OF FILTERS  *************************************************************************** -->



<script type="text/javascript">

//    function SetFilters() {
//        $("#Title").val('<?php // echo $FilterObject->title      ?>'.replace('%', '').replace('%', ''));
//        $("#authors").val('<?php // echo $FilterObject->authors      ?>'.replace('%', '').replace('%', ''));
//        $("#abbreviation").val('<?php // echo $FilterObject->abbreviation      ?>'.replace('%', '').replace('%', ''));
//
//        $.each('<?php // echo $FilterObject->MainUnities      ?>'.split(","), function (i, e) {
//            $("#MainUnities option[value='" + e + "']").prop("selected", true);
//        });
//        $.each('<?php // echo $FilterObject->documentForms      ?>'.split(","), function (i, e) {
//            $("#documentForms option[value='" + e + "']").prop("selected", true);
//        });
//        $.each('<?php // echo $FilterObject->Keywords      ?>'.split(","), function (i, e) {
//            $("#Keywords option[value='" + e + "']").prop("selected", true);
//        });
//    }
//
//    $(document).ready(function () {
//<?php // echo BibliographyFilters::SetFilters()      ?>
//    });



    $("#clear_filters").click(function () {
        var resetbuttom = document.getElementById("filters-form");
        resetbuttom.reset();
    });

    $(document).off("click", ".ajax_search .page-link").on("click", '.ajax_search .page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('.page-link').css("pointer-events", "none");
        select_data(url);
    });

    function select_data(u) {
        var form = $("#filters-form");
        var btn = $("#search_btn");
        var old_val = btn.html();
        url = u ? u : 'accompanying_lists/bibliography_search_result.php?item_type_id=<?php echo $item_type_id . $langParam; ?>&page=1';
        $.ajax({
            url: url,
            type: 'post',
//            dataType: 'json',
            data: form.serialize(),
            beforeSend: function () {
                $('.error,.submit_notification').html('');
                $('.btn,.label').attr("disabled", "disabled");
                btn.html('Searching...');
            },
            success: function (result) {
                $('.btn,.label').removeAttr("disabled");
                btn.html(old_val);
//                console.log("hi");
                $("#sy").find("#search_result_box").replaceWith(result);
//                $("#sy").find("#search_result_box").html(result);
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

//    $(".page-link").click(function () {
//        console.log('2:');
//        console.log($(this).attr('href'));
//
//        var myForm = document.getElementById("filters-form");
//        myForm.action = $(this).attr('href');
//        myForm.submit();
//
//        e.preventDefault();
//        return false;
//    });
</script>