<?php 

class Lake{

public $lake_detailsID;
public $lakeID;
public $CultureID;
public $friendlyName;
public $officialName;
public $phoneticTranscription;

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

class LakeFilters { 
	public $Title;
	public $OfficialName;
	public $MainUnities;
	public $Kinds;
	public $Keywords;

	public static function Load() {
		
		$newFilterObj = new LakeFilters();

		if (isset($_POST['submit_search']) && $_POST['submit_search'] === 'true') {

			//print_r($_POST);

			$newFilterObj->Title = "%" . $_POST['Title'] . "%";
			$newFilterObj->OfficialName = "%" . $_POST['OfficialName'] . "%";
			$newFilterObj->MainUnities = implode(",", $_POST['MainUnities']);
			$newFilterObj->Kinds = implode(",", $_POST['Kinds']);
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