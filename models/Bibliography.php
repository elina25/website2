<?php
 
class Bibliography{
	public $bibliographyID;
    public $abbreviation;
    public $authors;
    public $title;
    public $subtitle;
    public $firstPublisher;
    public $originalTitle;
    public $ISBN_ISDN;
    public $documentFormID;
    public $volume;
    public $scientificEditor;
    public $translator;
    public $pages;
    public $publisher;
    public $issue;
    public $editionNumber;
    public $collectiveWork;
    public $isSource;
    public $publicationPlace;
    public $publicationYear;
    public $firstPublicationPlace;
    public $firstPublicationYear;
    public $abbreviationPlainText;
    public $titlePlainText;
    public $subtitlePlainText;
    public $seriesPlainText;
    public $originalTitlePlainText;
    public $journalPlainText;
   

  

    

    // constructor
    function __construct() 
    {

    }
 
    // destructor
    function __destruct() 
    {
         
    }
}

    //FOR FILTERS

class BibliographyFilters { 


    public $Title;
    public $abbreviation;
    public $documentForms;
    public $MainUnities;

    //public $title;
    public $authors;
    public $Keywords;

    public static function Load() {
        
        $newFilterObj = new BibliographyFilters();

        if (isset($_POST['submit_search']) && $_POST['submit_search'] === 'true') {

            //print_r($_POST);

            $newFilterObj->Title = "%" . $_POST['Title'] . "%";
            $newFilterObj->abbreviation = "%" . $_POST['abbreviation'] . "%";
            $newFilterObj->documentForms = implode(",", $_POST['documentForms']);
            $newFilterObj->MainUnities = implode(",", $_POST['MainUnities']);
            //$newFilterObj->title = implode(",", $_POST['title']);
            $newFilterObj->authors = "%" . $_POST['authors'] . "%";
            $newFilterObj->Keywords = implode(",", $_POST['Keywords']);

            //print_r(json_encode($newFilterObj));
        }
        else {
            return null;
        }

        return $newFilterObj;
    }

    public static function SetFilters() {
        if (isset($_POST['submit_search']) && $_POST['submit_search'] === 'true') {
            return "SetFilters();";
        }
    }
}



 
?>