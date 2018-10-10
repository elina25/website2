


                    <div class="filter filter-boxed filter-gray">
                        <form method="get" action="?">
                          <h2><?php echo $lang['search_criteria'] ?></h2>


                            <div class="form-group">
                             <label for="exampleSelect2"> Τύπος συσχετιζόμενης οντότητας </label>
                              
                                <select multiple class="form-control" id="exampleSelect2">
                                  <?php foreach ($typesOfMainUnities as $type) { ?>
                                      <option value=""><?php echo ((isset($_GET['lang']) === false)?  $type->SingularDesc : $type->StandardName  ) ?></option>
                                  <?php } ?>
                                </select>
                                <label for="exampleSelect2"><?php echo $lang['multiple_select'] ?></label>
                            </div>
                         
                            <div class="form-group">
                              <label><?php echo $lang['title']?></label>
                              <input type="text" class="form-control" placeholder="<?php echo $lang['search_title']?>">
                            </div>

                            <div class="form-group">
                              <label><?php echo $lang['koini_onomasia']?></label>
                              <input type="text" class="form-control" placeholder="<?php echo $lang['koini_onomasia']?>">
                            </div>

                            <div class="form-group">
                             <label for="Kinds">Είδος </label>
                                
                                <select multiple class="form-control" id="exampleSelect2">
                                  <?php foreach ($SourcesOfPhotos as $SourcesOfPhoto) { ?>
                                      <option value=""><?php echo $SourcesOfPhoto->standardValue ?></option>
                                  <?php } ?>
                                </select>
                                <label for="exampleSelect2"><?php echo $lang['multiple_select'] ?></label>
                            </div>


                            <div class="form-group">
                              <label for="exampleSelect2"><?php echo $lang['keyword'] ?></label>
                                <select multiple class="form-control" id="exampleSelect2">
                                  <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                                    <option value=""><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                                  <?php } ?>
                                </select>
                            </div>

                          
                           <div class="form-group-btn form-group-btn-placeholder-gap">
                             <button type="submit" class="btn btn-primary btn-block"><?php echo $lang['Search'] ?></button>
                          </div>
                        </form>
                      </div>