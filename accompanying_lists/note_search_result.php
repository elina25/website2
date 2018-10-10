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
    $controller = new ControllerNote();

    $item_type_id = $_GET['item_type_id'];
    $search_peram = $_POST ? $_POST : '';
    $total_records = $controller->getSearchNotes($CultureID, $search_peram);
    $countOfRecords = count($total_records);
    //for pagination
    include('../pagination/pagination_file.php');

    $notes = $controller->getSearchNotes($CultureID, $search_peram, $PAGE_SIZE, $offset);
    ?>
    <div class="tab-pane active" id="tab-all" role="tabpanel">
        <div class="ajax_search">
            <div class="table-wrapper">
                <div class="overview">
                    <ul>
                        <?php if ($countOfRecords > 0) { ?>
                            <?php foreach ($notes as $note) { ?>
                                <li class="nav-item featured"> <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php echo $note->NoteID . $langParam; ?>" class="nav-link">
                                        <?php echo $note->title ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php include_once('../pagination/pagination_pages.php'); ?>
                        <?php } else { ?>
                            <h2 class="text-center"><?php echo $lang['no_result_msg']; ?></h2>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
