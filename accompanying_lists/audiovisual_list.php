<div class="tab-content" id="search_result_box">

    <?php

    $controller = new ControllerAudiovisual();

    $ControllerKeyword = new ControllerKeyword();

    $countOfRecords = $controller->getAllAudiovisualCount($CultureID);



    include('pagination/pagination_file.php');



    $audiovisuals = $controller->getAllAudiovisual($CultureID, $PAGE_SIZE, $offset);

    $kinds = $controller->getAllKindsOfAudioVisuals($CultureID);

    $characterizations = $controller->getAllCharacterizationOfAudioVisual($CultureID);

    $item_type_id = $_GET['item_type_id'];

    $KeywordsFilters = $controller->getKeywordForAllAudiovisual($CultureID);

    ?>

    <div class="tab-pane active" id="tab-all" role="tabpanel">

        <div class="">

            <div class="table-wrapper">

                <div class="overview">

                    <ul>

                        <?php foreach ($audiovisuals as $audiovisual) { ?>

                            <li class="nav-item featured"> 

                                <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php echo $audiovisual->audioVisualID . $langParam; ?>" class="nav-link">

                                    <?php echo $audiovisual->title ?> 

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

            <form id="filters-form" name="filters-form" method="get" onSubmit="select_data(); return false;" >

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

                    <label><?php echo $lang['title'] ?></label>

                    <select class="form-control" id="title_type" name="title_type">

                        <option value="or"><?php echo $lang['one_or_more_selected_word'] ?></option>

                        <option value="and"><?php echo $lang['all_of_the_selected_words'] ?></option>

                        <option value="exact"><?php echo $lang['the_whole_sentence'] ?></option>

                    </select>

                    <input type="text" class="form-control" name="title" placeholder="<?php echo $lang['search_title'] ?>">

                </div>

                <!--                <div class="form-group">

                                    <label><?php // echo $lang['subtitle']     ?></label>

                                    <input type="text" class="form-control" placeholder="Enter Subtitle">

                                </div>-->

                <div class="form-group">

                    <label for="exampleSelect2"><b><?php echo $lang['kind'] ?></b></label>

                    <select class="form-control" id="kinds" name="kinds">

                        <?php foreach ($kinds as $kind) { ?>

                            <option value=""><?php echo $kind->lookupValue ?></option>

                        <?php } ?>

                    </select>

                </div>

                <div class="form-group">

                    <label for="characterization"><b><?php echo $lang['characterization'] ?></b></label>

                    <select class="form-control" id="character_search_type" name="character_search_type">

                        <option value="and"><?php echo $lang['selected_all'] ?></option>

                        <option value="or"><?php echo $lang['one_or_more_selected'] ?></option>

                    </select>

                    <select multiple class="form-control" id="character_search" name="characters[]">

                        <?php foreach ($characterizations as $characterization) { ?>

                            <option value="<?php echo $characterization->accObjCharacterizationID ?>"><?php echo $characterization->lookupValue ?></option>

                        <?php } ?>

                    </select>

                    <label for="exampleSelect2"><?php echo $lang['multiple_select'] ?></label>

                </div>

                <div class="form-group" class="row">

                    <label><?php echo $lang['recording_time'] ?></label>

                    <select class="form-control" name="date_search_type" onchange='CheckRecordsDate(this.value);'>

                        <option value="equal"><?php echo $lang['equal'] ?></option>  

                        <option value="bigger"><?php echo $lang['equal_or_bigger'] ?></option>

                        <option value="smaller"><?php echo $lang['equal_or_smaller'] ?></option>

                        <option value="btw"><?php echo $lang['between'] ?></option>

                    </select>

                    <input type="text" name="hidden_field" id="hidden_field" style='display:none;'/>

                    <div class="row"  id="from_date"  style='display:none;'>

                        <label style="padding-left:15px;" for="example-date-input" class="form-group">From</label>

                        <div class="col-10">

                            <input class="form-control" type="date" placeholder="from" name="from_date">

                        </div>

                    </div>

                    <div class="row" id="" >

                        <label for="example-date-input" class=""></label>

                        <div class="col-10">

                            <input class="form-control" type="date" name="date" id="example-date-input">

                        </div>

                    </div>

                </div>

                <div class="form-group">

                    <label><b><?php echo $lang['keyword'] ?></b></label>

                    <select class="form-control" id="keyword_search_type" name="keyword_search_type">

                        <option value="and"><?php echo $lang['selected_all'] ?></option>

                        <option value="or"><?php echo $lang['one_or_more_selected'] ?></option>

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

                <input type="hidden" name="submit_search_audiovisual" value="true">

            </form>

        </div>

    </div>

</div>





<script>

    $(function () {



        $("#clear_filters").click(function () {

            var resetbuttom = document.getElementById("filters-form");

            resetbuttom.reset();

            select_data();

        });



        $(document).off("click", ".ajax_search .page-link").on("click", '.ajax_search .page-link', function (e) {

            e.preventDefault();

            var url = $(this).attr('href');

            select_data(url);

        });

    });



    function CheckRecordsDate(val) {

        var element = document.getElementById('from_date');

        if (val == 'btw')

            element.style.display = 'block';

        else

            element.style.display = 'none';

    }



    function select_data(u) {

        var form = $("#filters-form");

        var btn = $("#search_btn");

        var old_val = btn.html();

        url = u ? u : 'accompanying_lists/audiovisual_search_result.php?item_type_id=<?php echo $item_type_id . $langParam; ?>&page=1';

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

</script>