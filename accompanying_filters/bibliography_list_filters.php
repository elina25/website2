
<?php 
$ControllerBibliography = new ControllerBibliography();
$documentforms = $ControllerBibliography->getAllBibliographyDocumentForms($CultureID);//
//KeywordsFilters = $ControllerKeyword->getKeywordWithTypeIDD('tBibliographies',$CultureID);
//print_r($KeywordsFilters);
$KeywordsFilters = $ControllerKeyword->getKeywordWithItemTypeID(4,$CultureID);    
 //include("/../accompanying_lists/bibliography_list.php"); 



?>
                    <div class="filter filter-boxed filter-gray">
                      <form id="filters-form" method="POST" action="<?php echo GetPageUrl('') ?>">
                        <h2><?php echo $lang['search_criteria'] ?></h2>

                          <div class="form-group">
                            <label for="MainUnities"><?php echo $lang['multiple_select'] ?></label>
                              <select multiple class="form-control" id="MainUnities" name="MainUnities[]">
                                <option value="REGIONS"><?php echo $lang['locations'] ?></option>
                                  <?php foreach ($typesOfMainUnities as $type) { ?>
                                      <option value="<?php echo $type->itemTypeID ?>"><?php echo ((isset($_GET['lang']) === false)?  $type->SingularDesc : $type->StandardName  ) ?>
                                      </option>
                                  <?php } ?>
                              </select>
                          </div>
                         
                          <div class="form-group">
                            <label><?php echo $lang['title']?></label>
                            <input type="text" name="Title" id="Title" class="form-control" placeholder="<?php echo $lang['search_title']?>">
                          </div>

                          <div class="form-group">
                            <label><?php echo $lang['abbreviation']?></label>
                            <input type="text" name="abbreviation" id="abbreviation" class="form-control" placeholder="<?php echo $lang['abbreviation']?>">
                          </div>

                          <div class="form-group">
                              <label for="documentForms"><?php echo $lang['multiple_select'] ?></label>
                              <select multiple class="form-control" id="documentForms" name="documentForms[]">
                                <?php foreach ($documentforms as $documentform) { ?>
                                     <option value="<?php echo $documentform->bibliographyDocumentFormID ?>"><?php echo $documentform->lookupValue ?></option>
                                <?php } ?>
                              </select>
                          </div>

                          <!--<div class="form-group">
                            <label><?php echo $lang['title']?></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="<?php echo $lang['title']?>">
                          </div>-->

                          <div class="form-group">
                            <label><?php echo $lang['authors']?></label>
                            <input type="text" name="authors" id="authors" class="form-control" placeholder="<?php echo $lang['authors']?>">
                          </div>

                          <div class="form-group">
                            <label for="Keywords"><?php echo $lang['keyword'] ?></label>
                            <select multiple class="form-control" id="Keywords" name="Keywords[]">
                              <?php foreach ($KeywordsFilters as $KeywordsFilter) { ?>
                                <option value="<?php echo $KeywordsFilter->KeywordID?>"><?php echo $KeywordsFilter->KeywordTranslation ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          
                          <div class="form-group-btn form-group-btn-placeholder-gap">
                            <button type="submit" class="btn btn-primary btn-block"><?php echo $lang['Search'] ?></button>
                          </div>

                          <button style="margin-left:70px; border: none; background-color:#eeeeee; " id="res"  class=""><?php echo $lang['clear'] ?></button>

                          <input type="hidden" name="submit_search" value="true">

                      </form>
                    </div>


   <script type="text/javascript">
      function SetFilters() {
          $("#Title").val('<?php echo $FilterObject->title ?>'.replace('%','').replace('%',''));
          $("#authors").val('<?php echo $FilterObject->authors ?>'.replace('%','').replace('%',''));
          $("#abbreviation").val('<?php echo $FilterObject->abbreviation ?>'.replace('%','').replace('%',''));

          $.each('<?php echo $FilterObject->MainUnities ?>'.split(","), function(i,e){
              $("#MainUnities option[value='" + e + "']").prop("selected", true);
          });
          $.each('<?php echo $FilterObject->documentForms ?>'.split(","), function(i,e){
              $("#documentForms option[value='" + e + "']").prop("selected", true);
          });
          $.each('<?php echo $FilterObject->Keywords ?>'.split(","), function(i,e){
              $("#Keywords option[value='" + e + "']").prop("selected", true);
          });
      }

      $(document).ready(function() {
          <?php echo BibliographyFilters::SetFilters() ?>
      });

    
     
      $("#res").click(function() {
       var resetbuttom = document.getElementById("filters-form");
       resetbuttom.reset();
      });
    
      $(".page-item").click(function() {
        //console.log('1:');
        //console.log($(this).first().attr('href'));
      });

      $(".page-link").click(function() {
        console.log('2:');
        console.log($(this).attr('href'));

        var myForm = document.getElementById("filters-form");
        myForm.action = $(this).attr('href');
        myForm.submit();

        e.preventDefault();
        return false;
      });
     

 </script>

