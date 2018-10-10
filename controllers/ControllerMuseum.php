<?php

class ControllerMuseum {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }


    public function getMuseumFromMuseumID($MuseumId)  //Display all data for Museum Profile Page
   {

        $stmt = $this->pdo->prepare('SELECT museums.* , museumsDetails.* , archivedobjects.*
            FROM museums
            INNER JOIN archivedobjects
            ON `archivedobjects`.`ArchivedObjectID` = `museums`.`MuseumId`
            INNER JOIN museumsDetails
            ON `museumsDetails`.`MuseumId` = `museums`.`MuseumId`

            WHERE `archivedobjects`.`ArchivedObjectID` = :MuseumId;
');

        $stmt->execute( array('MuseumId' => $MuseumId ));

        $array = array();
        $ind = 0;
       foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->privateData = $row['privateData'];
            $itm->parentID = $row['parentID'];
            $itm->internationalName = $row['internationalName'];
            $itm->characterID = $row['characterID'];
            $itm->longitude = $row['longitude'];
            $itm->latitude = $row['latitude'];
			$itm->officialName = $row['officialName'];
            $itm->friendlyName = $row['friendlyName'];
            $itm->phoneticTranscription = $row['phoneticTranscription'];
            $itm->localName = $row['localName'];
            $itm->address = $row['address'];
            $itm->contact = $row['contact'];
            $itm->areincluded = $row['areincluded'];
            $itm->collections = $row['collections'];
            $itm->interestingExhibits = $row['interestingExhibits'];
            $itm->historicalData = $row['historicalData'];
            $itm->info = $row['info'];
            $itm->geographicalData = $row['geographicalData'];
            $itm->description = $row['description'];
            $itm->form = $row['form'];
            $itm->architect = $row['architect'];
            $itm->epochs = $row['epochs'];
            $itm->Comments = $row['Comments'];


            

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  



    public function getCharactersOfMuseum($MuseumId)   //Display the Characters of a museum
   {

        $stmt = $this->pdo->prepare('SELECT museums.MuseumId, museums.characterID,
        	item_characters_detail.ItemCharacterID, item_characters_detail.LookupValue,
        	item_characters_detail.CultureID

            FROM museums
            INNER JOIN item_characters_detail
            ON `museums`.`characterID` = `item_characters_detail`.`ItemCharacterID`

            WHERE `museums`.`MuseumId` = :MuseumId;
');

        	$stmt->execute( array('MuseumId' => $MuseumId ));

        	$array = array();
        	$ind = 0;
       		foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
        	$itm->ItemCharacterID = $row['ItemCharacterID']; 
            $itm->LookupValue = $row['LookupValue'];
            $itm->CultureID = $row['CultureID'];   


            

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  



    public function getKindOfMuseum($MuseumId)   //Display the Kind of a museum
   {

        $stmt = $this->pdo->prepare('SELECT museums.MuseumId,
        	item_to_kind.ItemID, item_to_kind.ChoiceID,
        	item_kinds_detail.CultureID,item_kinds_detail.LookupValue

            FROM museums
            INNER JOIN item_to_kind
            ON `museums`.`MuseumId` = `item_to_kind`.`ItemID`
            INNER JOIN item_kinds_detail
            ON `item_to_kind`.`ChoiceID` = `item_kinds_detail`.`ItemKindID`


            WHERE `museums`.`MuseumId` = :MuseumId;
');

        	$stmt->execute( array('MuseumId' => $MuseumId ));

        	$array = array();
        	$ind = 0;
       		foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
        	$itm->ItemID = $row['ItemID']; 
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->CultureID = $row['CultureID']; 
            $itm->LookupValue = $row['LookupValue'];  

			$array[$ind] = $itm;
            $ind++;

          }

        return $array;
    } 


        public function getsomeDetails($MuseumId)   //Display the current_id, condition,  last visit of a Museum
   {

        $stmt = $this->pdo->prepare('SELECT museums.MuseumId,
        	items.ItemID, items.conditionID,
        	items.lastVisitInfo, items.lastVisitDate, items.isCurrent,
            conditions_details.ConditionID, conditions_details.CultureID,
            conditions_details.LookupValue,
            generalized_time.GeneralizedTimeID, generalized_time.PeriodID,
            generalized_time.YearInfo, generalized_time.MonthInfo,
            generalized_time.DayInfo, generalized_time.ca
        	
            FROM museums
            INNER JOIN items
            ON `museums`.`MuseumId` = `items`.`ItemID`
            LEFT OUTER JOIN conditions_details
            ON  items.conditionID = conditions_details.ConditionID
            LEFT OUTER JOIN generalized_time
            ON `items`.`lastVisitDate` = `generalized_time`.`GeneralizedTimeID`
            
			WHERE `museums`.`MuseumId` = :MuseumId;
');

        	$stmt->execute( array('MuseumId' => $MuseumId ));

        	$array = array();
        	$ind = 0;
       		foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
        	$itm->ItemID = $row['ItemID']; 
            $itm->lastVisitDate = $row['lastVisitDate'];
            $itm->lastVisitInfo = $row['lastVisitInfo']; 
            $itm->LookupValue = $row['LookupValue']; 
            $itm->isCurrent = $row['isCurrent']; 
            $itm->ConditionID = $row['ConditionID']; //  conditions_details.ConditionID
            $itm->conditionID = $row['conditionID']; //   items.conditionID
            $itm->CultureID = $row['CultureID'];
            $itm->MonthInfo = $row['MonthInfo'];
            $itm->DayInfo = $row['DayInfo'];
            $itm->ca = $row['ca'];
            $itm->YearInfo = $row['YearInfo'];

            


			$array[$ind] = $itm;
            $ind++;

          }

        return $array;
    } 


    public function getKeywordFromMuseumID($MuseumId)   //DISPLAY KEYWORDS FOR PERSON
    {

        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`, `museumsDetails`.`MuseumId`,
             `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
             `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `museumsDetails` 
            LEFT OUTER JOIN `keywords_per_record` 
            ON `keywords_per_record`.`RecordID` = `museumsDetails`.`MuseumId` 
            LEFT OUTER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :MuseumId;
');

        $stmt->execute( array('MuseumId' => $MuseumId ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  


        public function getTypeForMuseum($MuseumId)   //Display the Kind of a museum
   {

        $stmt = $this->pdo->prepare('SELECT museums.MuseumId,
            items.itemID, items.itemTypeID, itemtypes.StandardName,
            itemtypes.SingularDesc

            FROM museums
            LEFT OUTER JOIN items
            ON museums.MuseumId = items.itemID 
            LEFT OUTER JOIN itemtypes
            ON items.itemTypeID = itemtypes.itemTypeID

            WHERE `museums`.`MuseumId` = :MuseumId;
');

            $stmt->execute( array('MuseumId' => $MuseumId ));

            $array = array();
            $ind = 0;
            foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Museum();
            $itm->MuseumId = $row['MuseumId'];
            $itm->ItemID = $row['ItemID']; 
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName']; 
            $itm->SingularDesc = $row['SingularDesc'];  

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    } 


  



}










