<div class="tab-content" id="search_result_box">
    <?php
    $ControllerBiography = new ControllerBiography();

    $countOfRecords = $ControllerBiography->getAllBiographyCount($CultureID);  //metraei poses eggrafes exei o pinakas biography
    $KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID(3, $CultureID);

    $currentPage = 1;  //i selida opou vriksomai 
//$offset = 0;  // apo ekei pou tha ksekinisei
    $num_of_pages = 0;

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = $_GET['page'];
    }
    $offset = ($currentPage - 1) * $PAGE_SIZE;  //prepei na mideniso to offset
    $num_of_pages = ceil($countOfRecords / $PAGE_SIZE);  // metrao posa kiklakia me noumerakia the exei i selida mou
    $biographies = $ControllerBiography->getAllBiography($CultureID, $PAGE_SIZE, $offset);
    $item_type_id = $_GET['item_type_id'];
    ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab-all" role="tabpanel">
            <div class="">
                <div class="table-wrapper">
                    <div class="overview">
                        <ul>
                            <?php foreach ($biographies as $biography) { ?>
                                <li class="nav-item featured"> <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php echo $biography->biographyID . $langParam; ?>  " class="nav-link ">
                                        <?php echo $biography->FullName ?> 
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
</div>


<!-- ************************************************************************* END OF MAIN PAGE *************************************************************************** -->
<div class="col-md-4 col-lg-3">
    <div class="sidebar" id="sidebar_two_region">

        <div class="filter filter-boxed filter-gray">
            <form id="filters-form" name="biography_search" onSubmit="select_data(); return false;">
                <h2><?php echo $lang['search_criteria'] ?></h2>


                <div class="form-group">
                    <label for="exampleSelect2"> <b><?php echo $lang['TypeOfAccompanyingObject'] ?></b></label>
                    <select multiple class="form-control" id="accompanying_object" name="MainUnities[]">
                        <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                        <?php foreach ($Alltypes as $type) { ?>
                            <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false) ? $type->SingularDesc : $type->StandardName ) ?></option>
                        <?php } ?>
                    </select>
                    <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                </div>

                <!--                <div class="form-group">
                                    <input type="text" name="" class="form-control" placeholder="<?php echo $lang['title'] ?>">
                                </div>-->

                <div class="form-group">
                    <label><?php echo $lang['name_field'] ?></label>
                    <select class="form-control" name="fullname_search_type" id="exampleSelect1">
                        <option value="or"><?php echo $lang['one_or_more_selected_word'] ?></option>
                        <option value="and"><?php echo $lang['all_of_the_selected_words'] ?></option>
                        <option value="exact"><?php echo $lang['the_whole_sentence'] ?></option>
                    </select>
                    <input type="text" name="fullname" class="form-control" placeholder="">
                </div>

                <div class="form-group" class="row">
                    <label><?php echo $lang['birth_time'] ?></label>
                    <select class="form-control" name="birth_search_type" onchange='Checkdates(this.value);'>
                        <option value="equal"><?php echo $lang['equal'] ?></option>  
                        <option value="bigger"><?php echo $lang['equal_or_bigger'] ?></option>
                        <option value="smaller"><?php echo $lang['equal_or_smaller'] ?></option>
                        <option value="btw"><?php echo $lang['between'] ?></option>
                    </select>
                    <input type="text" name="color" id="color" style='display:none;'/>
                    <div class="row"  id="year" style='display:none;'>
                        <div class="col-10">
                            <label style="padding-left:15px;" for="birth_from" class="">From</label>
                            <input class="form-control" type="date" name="birth_from" id="birth_from">
                        </div>
                    </div>
                    <div class="row" name="" id="" >
                        <div class="col-10">
                            <input class="form-control" type="date" name="birth_date" id="birth_date">
                        </div>
                    </div>
                </div>

                <div class="form-group" class="row">
                    <label><?php echo $lang['death_time'] ?></label>
                    <select class="form-control" name="death_search_type" onchange='CheckRecordsDate(this.value);' >
                        <option value="equal"><?php echo $lang['equal'] ?></option>  
                        <option value="bigger"><?php echo $lang['equal_or_bigger'] ?></option>
                        <option value="smaller"><?php echo $lang['equal_or_smaller'] ?></option>
                        <option value="btw"><?php echo $lang['between'] ?></option>
                    </select>
                    <input type="text" name="hidden_field" id="hidden_field" style='display:none;'/>

                    <div class="row"  id="death" style='display:none;'>
                        <div class="col-10">
                            <label for="death_from" class="">From</label>
                            <input class="form-control" type="date" name="death_from" id="death_from">
                        </div>
                    </div>
                    <div class="row" name="" id="" >
                        <label for="death_date" class=""></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="death_date" id="death_date">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keywords"><?php echo $lang['keyword'] ?></label>
                    <select class="form-control" id="keyword_search_type" name="keyword_search_type">
                        <option value="and"><?php echo $lang['selected_all'] ?></option>
                        <option value="or"><?php echo $lang['one_or_more_selected'] ?></option>
                    </select>
                    <select multiple class="form-control" id="Keywords" name="keywords[]">
                        <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                            <option value="<?php echo $KeywordsFilter->KeywordID ?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                        <?php } ?>
                    </select>
                    <label for="keywords"><?php echo $lang['multiple_select'] ?></label>
                </div>

                <div class="form-group-btn form-group-btn-placeholder-gap">
                    <button type="submit" class="btn btn-primary btn-block" id="search_btn"><?php echo $lang['Search'] ?></button>
                    <button type="button" style="margin-left:40px; margin-top:10px; background-color:#eeeeee;" id="clear_filters"  class=""><?php echo $lang['clear'] ?></button>
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
    function Checkdates(val) {
        var element = document.getElementById('year');
        if (val == 'btw')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function CheckRecordsDate(val) {
        var element = document.getElementById('death');
        if (val == 'btw')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function select_data(u) {
        var form = $("#filters-form");
        var btn = $("#search_btn");
        var old_val = btn.html();
        url = u ? u : 'accompanying_lists/biography_search_result.php?item_type_id=<?php echo $item_type_id . $langParam; ?>&page=1';
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