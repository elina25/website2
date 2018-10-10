<?php 
$controller = new ControllerSponsor();
$countOfRecords = $controller->getAllSponsorCount($CultureID);

include('pagination/pagination_file.php');

$sponsors = $controller->getAllSponsors($CultureID, $PAGE_SIZE, $offset);
//print_r($sponsors);
$item_type_id = $_GET['item_type_id'];
?>




				<div class="tab-content">
                    <div class="tab-pane active" id="tab-all" role="tabpanel">
                        <div class="">
                            <div class="table-wrapper">
                                <div class="overview">
                                    <ul>
									<?php foreach ($sponsors as $sponsor) { ?>
						                <li class="nav-item featured"> <a href="accompanying_item_profile.php?item_type_id=<?php echo $item_type_id; ?>&item_id=<?php echo $sponsor->SponsorID;  echo $langParam;?>  " class="nav-link "><?php echo $sponsor->FriendlyName ?> </a></li>
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

          <!-- ************************************************************************* START OF FILTERS  *************************************************************************** -->

                <div class="col-md-4 col-lg-3">
                  <div class="sidebar" id="sidebar_two_region">
                    
                    
                    <div class="filter filter-boxed filter-gray">
                      <form id="filters-form" method="POST" action="<?php echo GetPageUrl('') ?>">
                        <h2><?php echo $lang['search_criteria'] ?></h2>

                          <div class="form-group">
                           <label for="exampleSelect2"> <b><?php echo $lang['TypeOfAccompanyingObject']?></b></label>
                              <select multiple class="form-control" id="MainUnities" name="MainUnities[]">
                                <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                                  <?php foreach ($typesOfMainUnities as $type) { ?>
                                      <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false)?  $type->SingularDesc : $type->StandardName  ) ?>
                                      </option>
                                  <?php } ?>
                              </select>
                              <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                          </div>
                         
                         
                          <div class="form-group">
                            <input type="text" name="Title" id="Title" class="form-control" placeholder="<?php echo $lang['search_title']?>">
                          </div>

                        
                           <div class="form-group">
                            <label><?php echo $lang['title']?></label>
                              <select class="form-control" id="exampleSelect1">
                                <option><?php echo $lang['one_or_more_selected_word'] ?></option>
                                <option><?php echo $lang['all_of_the_selected_words'] ?></option>
                                <option><?php echo $lang['the_whole_sentence'] ?></option>
                              </select>
                            <input type="text" class="form-control" placeholder="">
                          </div> 

                        
                          
                          <div class="form-group-btn form-group-btn-placeholder-gap">
                            <button type="submit" class="btn btn-primary btn-block"><?php echo $lang['Search'] ?></button>
                          </div>

                          <button style="margin-left:70px; border: none; background-color:#eeeeee; " id="res"  class=""><?php echo $lang['clear'] ?></button>

                          <input type="hidden" name="submit_search" value="true">

                      </form>
                    </div>


                   
                  </div>
                </div>
<!-- ************************************************************************* END OF FILTERS  *************************************************************************** -->

                        
