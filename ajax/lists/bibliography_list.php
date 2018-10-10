
<?php 
$item_type_id = isset($_GET['item_type_id']) && $_GET['item_type_id'] ? $_GET['item_type_id'] : '';


$controller = new ControllerBibliography();

$bibliographies = $controller->getAllBibliography();
print_r($bibliographies)
?>


<?php 
echo 'Doulepsee'
?>

                      <h3 class="page-title-small"><?php echo $lang['list']; ?></h3>

                        <div class="overview">
                          <ul>

                            <?php foreach ($bibliographies as $bibliography) { ?>
                                  <li class="nav-item featured"> <a href="accompanying_item_profile.php?item_type_id=<?php echo $bibliography->accompanyingItemTypeID; ?>&item_id=<?php echo $bibliography->accompanyingObjectID;  echo $langParam;?>  " class="nav-link "><?php echo $bibliography->title ?> </a></li>
                            <?php } ?>

                          </ul>
                        </div>  

                            <!-- /.table-wrapper -->
                        <ul class="pagination pull-right">
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item active"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>

