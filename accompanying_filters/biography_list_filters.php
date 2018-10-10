
<?php 
//$KeywordsFilters = $ControllerKeyword->getKeywordWithTypeIDD('tBiographies',$CultureID);
?>
                


                  <div class="filter filter-boxed filter-gray">
                      <form method="get" action="?">
                          <h2><?php echo $lang['search_criteria'] ?></h2>


                            <div class="form-group">
                              <label for="exampleSelect2"><?php echo $lang['multiple_select'] ?></label>
                                <select multiple class="form-control" id="exampleSelect2">

                                 <option value=""><?php echo $lang['places']?></option>
                                  <?php foreach ($Alltypes as $type) { ?>
                                      <option value=""><?php echo ((isset($_GET['lang']) === false)?  $type->SingularDesc : $type->StandardName  ) ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                         
                            <div class="form-group">
                              <label><?php echo $lang['title']?></label>
                              <input type="text" class="form-control" placeholder="<?php echo $lang['search_title']?>">
                            </div>

                            <div class="form-group">
                              <label><?php echo $lang['koini_onomasia']?></label>
                              <input type="text" class="form-control" placeholder="<?php echo $lang['koini_onomasia']?>">
                            </div>


                            <div class="form-group" class="row">
                                <label><?php echo $lang['birth_time']?></label>
                                <select class="form-control" name="color" onchange='CheckColors(this.value);'>
                                      <option value="equal"><?php echo $lang['equal']?></option>  
                                      <option value="bigger"><?php echo $lang['equal_or_bigger']?></option>
                                      <option value="smaller"><?php echo $lang['equal_or_smaller']?></option>
                                      <option value="btw"><?php echo $lang['between']?></option>
                                  <input type="text" name="color" id="color" style='display:none;'/>


                            
                              
                             <div class="row"  id="year" style='display:none;'>
                                  <div class="form-group col-xl-4">
                                   
                                       <input type="text" name="color" class="form-control" placeholder="<?php echo $lang['year']?>"/>
                                  </div>
                                  <div class="form-group col-xl-4">
                                  
                                       <input type="text"  name="color" class="form-control" placeholder="<?php echo $lang['month']?>"/>
                                  </div>
                                  <div class="form-group col-xl-4">
                                      
                                        <input type="text" name="color" class="form-control" placeholder="<?php echo $lang['day']?>"/>
                                  </div>
                              </div>

                                </select>


                                 <div class="row" name="" id="" >
                                  <div class="form-group col-xl-4">
                                   
                                       <input type="text" class="form-control" placeholder="<?php echo $lang['year']?>"/>
                                  </div>
                                  <div class="form-group col-xl-4">
                                  
                                       <input type="text" class="form-control" placeholder="<?php echo $lang['month']?>"/>
                                  </div>
                                  <div class="form-group col-xl-4">
                                      
                                        <input type="text" class="form-control" placeholder="<?php echo $lang['day']?>"/>
                                  </div>
                              </div>
                            </div>

                              <div class="form-group-btn form-group-btn-placeholder-gap">
                                 <button type="submit" class="btn btn-primary btn-block"><?php echo $lang['Search'] ?></button>
                              </div>
                        </form>
                    </div>


<script type="text/javascript">

  function CheckColors(val){
     var element=document.getElementById('year');
   
     
     if(val=='btw')
       element.style.display='block';
     else  
       element.style.display='none';
    }

</script>