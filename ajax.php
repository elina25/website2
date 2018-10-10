<?php
require_once("../inc/init.php");
   

if (empty($_GET['lang'])){
 include '../lang/gr/language.php';
 $CultureID = 1;
} else {
  include '../lang/' . $_GET['lang'] . '/language.php';
  if ($_GET['lang'] == "en") ;
$CultureID = 2;
   }


$ControllerKeyword = new ControllerKeyword();
$ControllerArchivedObjectRelations = new ControllerArchivedObjectRelations();
$ControllerAccompanyingObject = new ControllerAccompanyingObject();
$keywords = $ControllerKeyword->getKeywordForEachItem($_GET['id'],$CultureID); 

$accompanyingitems = $ControllerAccompanyingObject->getAllAccompanyingItemsWithItemTypeIdAndType($_GET['item_type_id'], $_GET['item_id']); 
print_r($_GET['current_item_type_id']);
print_r($_GET['item_id']);

//$main = $ControllerArchivedObjectRelations->ViewArchivedObjectRelation($_GET['item_id'], $_GET['item_type_id']); 
$listsOfGeo = $ControllerAccompanyingObject->GetAllRelationsAccToGeoList($_GET['item_id'], $_GET['item_type_id']); 
$main = $ControllerAccompanyingObject->GetAllRelationsAccToMainEntitiesList($_GET['item_id'], $_GET['item_type_id']); 
?>

<?php if ($_GET['cat'] == 11){ ?>
<?php $acs = $ControllerAccompanyingObject->GetAllRelationsAccToAccItemsS($_GET['item_id'],$_GET['item_type_id']); ?>
                  <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" id="first_tab">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['basicdetails']; ?></a>
                      </li>

                      <li class="nav-item" id="not">
                           <a class="nav-link" id="tab_two" href="#tab-rent" data-toggle="tab"> 
                              <?php switch ($_GET['item_type_id']) {
                                   case 1:
                                    echo $lang['photos_list']; 
                                    break;
                                   case 2:
                                    echo $lang['printed_doc']; 
                                    break;
                                   case 3:
                                    echo $lang['biography_list']; 
                                    break;
                                   case 4:
                                    echo $lang['bibliography_list']; 
                                    break;
                                    case 5:
                                    echo $lang['audiovisual_list']; 
                                    break;
                                    case 6:
                                    echo $lang['document_list']; 
                                    break;
                                    case 7:
                                    echo $lang['notes_list']; 
                                    break;
                                    case 8:
                                    echo $lang['map_list']; 
                                    break;
                                    default:
                                     echo $lang['sponsor_list']; 
                                    break;
                                 } ?>
                            </a>
                      </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">


                            <?php 
                              
      							$current_tab = $_GET['current_item_type_id'];
                                print_r($current_tab);



                              
                               if(array_key_exists('$accompanyingitems[0]->accompanyingItemTypeID',$_GET)) {
                                $current_tab = $_GET['$accompanyingitems[0]->accompanyingItemTypeID']; 
                                  
                               } 



                               switch ($current_tab) {
                                  case '1':
                                  include 'profiles/photo_profile.php';
                                      break;
                                  case '2':
                                      include ('profiles/printed_or_handwritten_doc_profile.php');
                                      break;
                                  case '3':
                                      include ('profiles/biography_profile.php');
                                      break;
                                  case '4':
                                      include ('profiles/bibliography_profile.php');
                                      break;
                                  case '5':
                                      include ('../profiles/audiovisual_profile.php');
                                      break;
                                  case '6':
                                      include ('profiles/document_profile.php');
                                      break;
                                  case '7':
                                      include ('profiles/note_profile.php');
                                      break;
                                  case '8':
                                      include ('profiles/map_profile.php');
                                      break;
                                  case '9':
                                      include 'profiles/sponsor_profile.php';
                                      break;
                                  default:
                                      echo "An error occured!";
                                                  }

                            ?>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="tab-rent" role="tabpanel">
                      <div class="table-wrapper">
                        <div class="overview">
                          <ul>
                            <?php foreach ($acs as $ac){ ?>
                               <li class="nav-item featured">
                                  <a href="accompanying_item_profile.php?item_type_id=<?php echo $ac->accompanyingItemTypeID; ?>&item_id=<?php echo $ac->secondObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $ac->uniqueName?></b></a>
                               </li>
                            <?php  } ?> 
                          </ul>
                        </div>  

                          <ul class="pagination pull-right">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                          </ul>
                      </div>
                    </div>
              </div> 


<?php } else if  ($_GET['cat'] == 12){  ?>
                  <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['basicdetails']; ?></a>
                      </li>

                      
                        <li class="nav-item" id="not">
                          <a class="nav-link" id="tab_three" href="#tab-rent" data-toggle="tab">  
                          <?php switch ($_GET['item_type_id']) {
                               case 1:
                                echo $lang['ReligiousMonument']; 
                                break;
                               case 2:
                                echo $lang['ChristianOrthodoxMonument']; 
                                break;
                               case 3:
                                echo $lang['Artwork']; 
                                break;
                               case 4:
                                echo $lang['EducationalFoundation']; 
                                break;
                                case 5:
                                echo $lang['Epigraph']; 
                                break;
                                case 6:
                                echo $lang['Community']; 
                                break;
                                case 7:
                                echo $lang['Cemetery']; 
                                break;
                                case 13:
                                echo $lang['ArchaeologicalReligiousMonument']; 
                                break;
                                case 14:
                                echo $lang['ArchaeologicalSite']; 
                                break;
                                case 15:
                                echo $lang['Fortress']; 
                                break;
                                case 16:
                                echo $lang['Tomb']; 
                                break;
                                case 17:
                                echo $lang['Museum']; 
                                break;
                                case 18:
                                echo $lang['Exhibition']; 
                                break;
                                case 19:
                                echo $lang['AdministrationBuilding']; 
                                break;
                                case 20:
                                echo $lang['WelfareBuilding']; 
                                break;
                                case 21:
                                echo $lang['InfrastructureBuilding']; 
                                break;
                                case 22:
                                echo $lang['SocialResidentialBuilding']; 
                                break;
                                case 23:
                                echo $lang['Coin']; 
                                break;
                                case 24:
                                echo $lang['Person']; 
                                break;
                                default:
                                echo $lang['ReligiousEvent']; 
                                break;

                              } ?>
                        </a>
                      </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
                        <div class="listing-detail-section" id="listing-detail-section-details" data-title="<?php echo $lang['details']; ?>">
                              <h2><?php echo $lang['details']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                     <?php foreach ($informations as $information) { ?>


                                        <?php 
                                        if(!IsNullOrEmpty($informations[0]->Artwork)){ ?>
                                        <tr>
                                          <th class="min-width center"><?php echo $lang['Artwork']; ?></th>
                                          <td><?php echo $information->Artwork?></td>
                                        </tr>
                                        <?php } ?>


                                        <?php
                                              MakeItemList($information, 'Artwork', $lang);
                                              MakeItemList($information, 'FriendlyName', $lang);
                                              MakeItemList($information, 'OfficialName', $lang);
                                              MakeItemList($information, 'Dimensions_Weight', $lang);
                                              MakeItemList($information, 'HistoricalData', $lang);
                                              MakeItemList($information, 'Creator', $lang);
                                              MakeItemList($information, 'Owner', $lang);
                                              MakeItemList($information, 'Origin', $lang);
                                              MakeItemList($information, 'FindingLocation', $lang);
                                              MakeItemList($information, 'CurrentLocation', $lang);
                                              MakeItemList($information, 'Description', $lang);
                                              MakeItemList($information, 'Theme', $lang);
                                              MakeItemList($information, 'Persons', $lang);
                                              MakeItemList($information, 'Layers', $lang);
                                              MakeItemList($information, 'BackView', $lang);
                                              MakeItemList($information, 'Epigraph', $lang);
                                              MakeItemList($information, 'EpigraphLanguages', $lang);
                                              MakeItemList($information, 'EpigraphText', $lang);
                                              MakeItemList($information, 'EpigraphLocation', $lang);
                                              MakeItemList($information, 'EpigraphEpochs', $lang);
                                              MakeItemList($information, 'Info', $lang);
                                              MakeItemList($information, 'Comments', $lang);
                                        ?>
                                    <?php } ?>
                                      </div>
                                  </div>
                              </div>
                       </div>
                     </div>
                    </div>
                    <!-- /.tab-pane -->
                       <div class="tab-pane active" id="tab-rent" role="tabpanel">

                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>

                          
                                    <?php foreach ($main as $mn) { ?>
                                      <li class="nav-item featured">
                                          <a href="accompanying_item_profile.php?item_type_id=<?php echo $mn->accompanyingItemTypeID; ?>&item_id=<?php echo $mn->accompanyingObjectID;  echo $langParam;?>" class="nav-link "><b><?php echo $mn->UniqueName?></b></a>
                                      </li>
                                    <?php  } ?>

                                </ul>

                                   
                            </div>  
 
                              <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                        </div>
                          
                      </div>
                </div>
<?php } else {  ?>

   <div class="listing-tabs-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" href="#tab-all" data-toggle="tab"><?php echo $lang['basicdetails']; ?></a>
                      </li>

                        <li class="nav-item" id="not">
                              <a class="nav-link" id="tab_four" href="#tab-rent" data-toggle="tab"> 
                              <?php switch ($_GET['item_type_id']) {
                                   case 8:
                                    echo $lang['mountain']; 
                                    break;
                                   case 9:
                                    echo $lang['areas']; 
                                    break;
                                   case 10:
                                    echo $lang['sea']; 
                                    break;
                                   case 11:
                                    echo $lang['lakes']; 
                                    break;
                                   default:
                                     echo $lang['rivers']; 
                                     break;
                                 } ?>
                              </a>
                          </li>
                     
                      <!--<li class="nav-item">
                        <a class="nav-link" href="#tab-sale" data-toggle="tab">For Sale</a>
                      </li>-->
                    </ul>
                  </div>
                  <!-- /.listing-tabs-headser -->
                  <div class="tab-content">
                    <div class="tab-pane" id="tab-all" role="tabpanel">
                      <div class="listing-boxes">
                             <div class="listing-detail-section" id="listing-detail-section-details" data-title="<?php echo $lang['details']; ?>">
                              <h2><?php echo $lang['details']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                       <?php foreach ($informations as $information) { ?>
                                        <?php
                                              MakeItemList($information, 'Artwork', $lang);
                                              MakeItemList($information, 'FriendlyName', $lang);
                                              MakeItemList($information, 'OfficialName', $lang);
                                              MakeItemList($information, 'Dimensions_Weight', $lang);
                                              MakeItemList($information, 'HistoricalData', $lang);
                                              MakeItemList($information, 'Creator', $lang);
                                              MakeItemList($information, 'Owner', $lang);
                                              MakeItemList($information, 'Origin', $lang);
                                              MakeItemList($information, 'FindingLocation', $lang);
                                              MakeItemList($information, 'CurrentLocation', $lang);
                                              MakeItemList($information, 'Description', $lang);
                                              MakeItemList($information, 'Theme', $lang);
                                              MakeItemList($information, 'Persons', $lang);
                                              MakeItemList($information, 'Layers', $lang);
                                              MakeItemList($information, 'BackView', $lang);
                                              MakeItemList($information, 'Epigraph', $lang);
                                              MakeItemList($information, 'EpigraphLanguages', $lang);
                                              MakeItemList($information, 'EpigraphText', $lang);
                                              MakeItemList($information, 'EpigraphLocation', $lang);
                                              MakeItemList($information, 'EpigraphEpochs', $lang);
                                              MakeItemList($information, 'Info', $lang);
                                              MakeItemList($information, 'Comments', $lang);
                                        ?>
                                    <?php } ?>
                                      </div>
                                  </div>
                              </div>
                          </div>


                        <?php 
                          if(!IsNullOrEmpty($keywords[0]->KeywordTranslation)){ ?>
                            <div class="listing-detail-section" id="listing-detail-section-keyword" data-title="<?php echo $lang['keyword']; ?>">
                              <h2><?php echo $lang['keyword']; ?></h2>
                                <div class="box">
                                  <div class="box-inner">
                                      <div class="overview overview-half overview-no-margin">
                                           <?php foreach ($keywords as $keywordd){ ?>
                                                <?php echo $keywordd->KeywordTranslation . " " . "|"?>
                                            <?php } ?>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        <?php } ?>

                    

                     


                        
                       
                       
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                       <div class="tab-pane active" id="tab-rent" role="tabpanel">
                          <div class="table-wrapper">
                             <div class="overview">
                                <ul>
                                  <?php foreach ($listsOfGeo as $listOfGeo) { ?>
                                  <li class="nav-item featured">
                                  <a href="" class="nav-link "><b><?php echo $listOfGeo->UniqueName?></b></a>
                                  </li>
                                  <?php  } ?>
                                </ul>
                              </div>  
 
                              <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                          </div>
                        </div>
                </div>
                <?php  } ?>





