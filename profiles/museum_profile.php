<?php 
require_once("inc/init.php");
require_once("inc/lang.php");

$ControllerMuseum = new ControllerMuseum();
$informations = $ControllerMuseum->getMuseumFromMuseumID($_GET['id']);
$Kinds = $ControllerMuseum->getKindOfMuseum($_GET['id']);
$Characters = $ControllerMuseum->getCharactersOfMuseum($_GET['id']);
$details = $ControllerMuseum->getsomeDetails($_GET['id']);
$keywords = $ControllerMuseum->getKeywordFromMuseumID($_GET['id']);
$types = $ControllerMuseum->getTypeForMuseum($_GET['id']);


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Panorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/imports.css" media="screen">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/custom.css" media="screen">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="single single-post">

    <div id="top"></div>

    <!-- Navigation (main menu)
    ================================================== -->

    <div class="navbar-wrapper">
    <?php include('inc/header.php'); ?>

    </div><!-- /.navbar-wrapper -->




    <!-- Hero Section
    ================================================== -->

    <section class="hero small-hero" style="background-image:url(assets/images/hero-4.jpg);">
      <div class="bg-overlay">
        <div class="container">
          <div class="intro-wrap">
            <h3 class="intro-title"><?php echo $lang['museum']; ?></h3>
          </div>
        </div>
      </div>
    </section>





  <!-- Main Section
    ================================================== -->

    <section class="main container">
      <div id="content" class="row">
        <div class="col-sm-8 col-md-6 col-md-push-3">
          <header class="entry-header">
              <h4 class="entry-title"><?php echo $lang['otherdetails'] ?></h4>          
          </header>
          <article class="post">
            <div class="entry-summary">
              <p class="lead"></p>
            </div>

              <?php foreach ($informations as $information) { ?>
            <div class="entry-content">
              
                    

              <p class="entry-content"><b><?php echo $lang['global_name'] ?></b>&nbsp;&nbsp;<?php echo $information->internationalName?></p><br/>

              <p class="entry-content"><b><?php echo $lang['history_name'] ?></b>&nbsp;&nbsp;<?php echo $information->historicalData?></p><br/>

              <p class="entry-content"><b><?php echo $lang['iscurrent'] ?></b>&nbsp;&nbsp;
              <?php foreach ($details as $detail) {  ?>
                <?php 
                if ($details['0']->isCurrent == 1){
                  echo $lang['yes'];
                } else if  ($details['0']->isCurrent == 0){
                   echo $lang['no'];
                } ?>

                <?php } ?>
                 </p><br/>

              <p class="entry-content"><b><?php echo $lang['biographicaldata'] ?></b><br/>&nbsp;&nbsp;
              <?php echo $information->biographicalData?></p><br/>

              <p class="entry-content"><b><?php echo $lang['latitude'] ?></b>&nbsp;&nbsp;
              <?php echo $information->latitude?></p><br/>
              
              <p class="entry-content"><b><?php echo $lang['longitude'] ?></b>&nbsp;&nbsp;
              <?php echo $information->longitude?>
               </p><br/>

              <p class="entry-content"><b><?php echo $lang['kind'] ?></b>&nbsp;&nbsp;
              <?php foreach ($Kinds as $kind) {  ?>
                <?php echo $kind->LookupValue?>
              <?php } ?>
              </p><br/>

              <p class="entry-content"><b><?php echo $lang['character'] ?></b>&nbsp;&nbsp;
              <?php foreach ($Characters as $Character) {  ?>
                <?php echo $Character->LookupValue?>
              <?php } ?>
              </p><br/>

              <p class="entry-content"><b><?php echo $lang['condition'] ?></b>&nbsp;&nbsp;
                <?php foreach ($details as $detail) {  ?>
              <?php echo $detail->LookupValue?>
              <?php } ?>
               </p><br/>

              <p class="entry-content"><b><?php echo $lang['lastvisit'] ?></b>&nbsp;&nbsp;
              <?php foreach ($details as $detail) {  ?>
              <?php echo $detail->ca . $detail->YearInfo .'-'. $detail->MonthInfo .'-'. $detail->DayInfo ?>
             
              <?php } ?>
               </p><br/>
              

              <p class="entry-content"><b><?php echo $lang['type'] ?></b>
                <?php foreach ($types as $type) {  ?>
              <?php echo $type->StandardName?>
              <?php } ?>
              </p><br/>

              <p class="entry-content"><b><?php echo $lang['officialname'] ?></b>
             <?php echo $information->officialName?>
    		</p><br/>

    		   <p class="entry-content"><b><?php echo $lang['friendlyName'] ?></b>
             <?php echo $information->friendlyName?>
    		</p><br/>

    		 <p class="entry-content"><b><?php echo $lang['phoneticTranscription'] ?></b>
             <?php echo $information->phoneticTranscription?>
    		</p><br/>

    		 <p class="entry-content"><b><?php echo $lang['LocalName'] ?></b>
             <?php echo $information->localName?>
    		</p><br/>

    		 <p class="entry-content"><b><?php echo $lang['geographicalData'] ?></b>
             <?php echo $information->geographicalData?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['Architect'] ?></b>
             <?php echo $information->Architect?>
    		</p><br/>
    		
    		<p class="entry-content"><b><?php echo $lang['historicalData'] ?></b>
             <?php echo $information->historicalData?>
    		</p><br/>

			<p class="entry-content"><b><?php echo $lang['form'] ?></b>
             <?php echo $information->form?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['description'] ?></b>
             <?php echo $information->description?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['Epochs'] ?></b>
             <?php echo $information->Epochs?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['address'] ?></b>
             <?php echo $information->address?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['contact'] ?></b>
             <?php echo $information->contact?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['areincluded'] ?></b>
             <?php echo $information->areincluded?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['interestingExhibits'] ?></b>
             <?php echo $information->interestingExhibits?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['collections'] ?></b>
             <?php echo $information->collections?>
    		</p><br/>

			<p class="entry-content"><b><?php echo $lang['info'] ?></b>
             <?php echo $information->info?>
    		</p><br/>

    		<p class="entry-content"><b><?php echo $lang['comments'] ?></b>
             <?php echo $information->comments?>
    		</p><br/>



<button onclick= "executeParent();"></button>

    		

    		
             


          

            </div>

        <?php } ?>
                 
           
          
          </article>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 col-md-pull-6 blog-details-column">
          <div class="entry-meta">

          <?php foreach ($informations as $information) { ?>
          <span class="icon-meta">
              <span class="posted-on"> 
              <h3 class="widget-title"><?php echo $lang['basicdetails']; ?></h3>
              </span>
            </span>


            <div class="byline icon-meta">
              <i class="fa fa-user "></i>
              <span class="author vcard meta-item">
                <a href="author.html" title="Posts by Olivia" rel="author"><?php echo $information->UniqueName?></a>
              </span>
            </div>

            <div class="comments-link icon-meta">
              <i class="fa fa-barcode "></i>
              <span class="author vcard meta-item">
                <a href="#"><?php echo $information->ArchiveCode?></a>
              </span>
            </div>

            <div class="comments-link icon-meta">
              <i class="fa fa-user"></i>
              <span class="meta-item">
                <a href="#"><?php echo $lang['father']  ?>&nbsp;&nbsp;<?php echo $information->parentID?></p> </a>
              </span>
            </div>

             <div class="comments-link icon-meta">
              <i class="fa fa-user"></i>
              <span class="meta-item">
                <a href="#"><?php echo $information->parentID?> </a>
              </span>
            </div>

            <hr>


             <div class="comments-link icon-meta">
              <i class="fa fa-tags"></i>
              <span class="meta-item">
                <a href="#"><b><?php echo $lang['keyword'] ?></b><br/>
                <?php foreach ($keywords as $keyword) {  ?>
              <?php echo $keyword->KeywordTranslation?>
              <?php } ?></p> </a>
              </span>
            </div>

            


          


                <?php } ?>

          </div>

          <div class="sidebar">
            <div class="sidebar-padder">
              <div class="widget scg_widget single-post-left widget_text">
                <div class="textwidget">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sidebar col-xs-12 col-sm-4 col-md-3">
          <div class="sidebar-padder">
            <aside id="nav_menu-3" class="widget widget_nav_menu">
              <h3 class="widget-title"><?php echo $lang['sinodeutiko_iliko'] ?></h3>
              <div class="menu-top-destinations-container">
                <ul id="menu-top-destinations" class="menu">
                <form action="#ajax/filter_accompanying_relations_with_archiveobjects.php" method="POST" id="filters_form" class="smart-form">
                  <?php foreach ($itemtypes as $itemtype) { ?>
                    <button onclick="filterResults();"><li class="cat-item"><?php echo ((isset($_GET['lang']) === false)?  $itemtype->PluralDesc : $itemtype->StandardName  ) ?></li></button>
                  <?php } ?>      
                  <input type="hidden" name="item_type_id" value="<?php echo $itemtype->accompanyingItemTypeID ?>">
                </form>

                  
                </ul>
              </div>
            </aside>
      
       
          </div>
        </div>
  
      </div>
    </section>

    <!-- Footer
    ================================================== -->

    <?php include('inc/footer.php') ?>


<script type="text/javascript">
  function executeParent () {
    alert('Link Clicked');
    return false;
  }

  alert('aaa');

</script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>