<?php

class ControllerArtwork {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }



 
    public function getArtWorksWithID($ArtworkID, $CultureID) //DISPLAY DATA FOR ARTWORKS
    {

        $stmt = $this->pdo->prepare('SELECT * 
            FROM `artworks_details` 
            WHERE  ArtworkID = :ArtworkID AND CultureID = :CultureID
');

        $stmt->execute( array('ArtworkID' => $ArtworkID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Artwork();
            $itm->ID = $row['ID'];
            $itm->ArtworkID = $row['ArtworkID'];
            $itm->CultureID = $row['CultureID'];
            $itm->Artwork = $row['Artwork'];
            $itm->OfficialName = $row['OfficialName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->Dimensions_Weight = $row['Dimensions_Weight'];
            $itm->HistoricalData = $row['HistoricalData'];
            $itm->Creator = $row['Creator'];
            $itm->Workshop = $row['Workshop'];
            $itm->Owner = $row['Owner'];
            $itm->Origin = $row['Origin'];
            $itm->Description = $row['Description'];
            $itm->FindingLocation = $row['FindingLocation'];
            $itm->Theme = $row['Theme'];
            $itm->Persons = $row['Persons'];
            $itm->Layers = $row['Layers'];
            $itm->EpigraphLocation = $row['EpigraphLocation'];
            $itm->EpigraphEpochs = $row['EpigraphEpochs'];
            $itm->Info = $row['Info'];
            $itm->Comments = $row['Comments'];
            $itm->FindingMeans = $row['FindingMeans'];
            $itm->CurrentLocation = $row['CurrentLocation'];
            $itm->BackView = $row['BackView'];
            $itm->Epigraph = $row['Epigraph'];
            $itm->EpigraphLanguages = $row['EpigraphLanguages'];
            $itm->EpigraphText = $row['EpigraphText'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



 
    public function getArtWorksDetailWithID($ArtworkID, $CultureID) //DISPLAY DATA FOR ARTWORKS
    {

        $stmt = $this->pdo->prepare('SELECT `artworks_details`.*,
            `archivedobjects`.`UniqueName`,`archivedobjects`.`DigitizationSponsor`,`archivedobjects`.`IsRegion`,`archivedobjects`.`PrivateData`,
            `archivedobjects`.`ParentID`, `archivedobjects`.`IsComplete`,`archivedobjects`.`WebAccess`,`archivedobjects`.`Imprimatur`,`archivedobjects`.`PrivateData`,
            `archivedobjects`.`ArchiveCode`,`generalized_time`.`GeneralizedTimeID`,`generalized_time`.`YearInfo`,`generalized_time`.`MonthInfo`,
            `generalized_time`.`DayInfo`,`generalized_time`.`ca`
            FROM `artworks_details` 
            LEFT OUTER  JOIN `archivedobjects` 
            ON `archivedobjects`.`ArchivedObjectID` = `artworks_details`.`ArtworkID` 
            LEFT OUTER JOIN `artworks`
            ON `archivedobjects`.`ArchivedObjectID` = `artworks`.`ArtworkID`
            LEFT OUTER JOIN `generalized_time`
            ON `artworks`.`CreationTimeID` = `generalized_time`.`GeneralizedTimeID`
            WHERE `archivedobjects`.`ArchivedObjectID` = :ArtworkID AND `archivedobjects`.`ArchivedObjectID` = :CultureID
');

        $stmt->execute( array('ArtworkID' => $ArtworkID , 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Artwork();
            $itm->ArtworkID = $row['ArtworkID'];
            $itm->CultureID = $row['CultureID'];
            $itm->ParentID = $row['ParentID'];
            $itm->Artwork = $row['Artwork'];
            $itm->OfficialName = $row['OfficialName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->Dimensions_Weight = $row['Dimensions_Weight'];
            $itm->HistoricalData = $row['HistoricalData'];
            $itm->FindingLocation = $row['FindingLocation'];
            $itm->Creator = $row['Creator'];
            $itm->Workshop = $row['Workshop'];
            $itm->Owner = $row['Owner'];
            $itm->Origin = $row['Origin'];
            $itm->Description = $row['Description'];
            $itm->Theme = $row['Theme'];
            $itm->Persons = $row['Persons'];
            $itm->Layers = $row['Layers'];
            $itm->EpigraphLocation = $row['EpigraphLocation'];
            $itm->EpigraphEpochs = $row['EpigraphEpochs'];
            $itm->Info = $row['Info'];
            $itm->Comments = $row['Comments'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->DigitizationSponsor = $row['DigitizationSponsor'];
            $itm->IsRegion = $row['IsRegion'];
            $itm->GeneralizedTimeID = $row['GeneralizedTimeID'];
            $itm->PrivateData = $row['PrivateData'];
            $itm->IsComplete = $row['IsComplete'];
            $itm->WebAccess = $row['WebAccess'];
            $itm->Imprimatur = $row['Imprimatur'];
            $itm->ArchiveCode = $row['ArchiveCode'];
            $itm->YearInfo = $row['YearInfo'];
            $itm->MonthInfo = $row['MonthInfo'];
            $itm->DayInfo = $row['DayInfo'];
            $itm->ca = $row['ca'];
            $itm->FindingMeans = $row['FindingMeans'];
            $itm->CurrentLocation = $row['CurrentLocation'];
            $itm->BackView = $row['BackView'];
            $itm->Epigraph = $row['Epigraph'];
            $itm->EpigraphLanguages = $row['EpigraphLanguages'];
            $itm->EpigraphText = $row['EpigraphText'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }





    public function getKeywordFromArtworkID($ArtworkID)   //DISPLAY KEYWORDS FOR ARTWORK
    {

        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`, `artworks_details`.`ArtworkID`,
             `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
             `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `artworks_details` 
            INNER JOIN `keywords_per_record` 
            ON `keywords_per_record`.`RecordID` = `artworks_details`.`ArtworkID` 
            INNER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :ArtworkID;');

        $stmt->execute( array('ArtworkID' => $ArtworkID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Artwork();
            $itm->ArtworkID = $row['ArtworkID'];
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  




    public function getKindforArtwork($ArtworkID)   //Display the kinds of Artwork
    {

        $stmt = $this->pdo->prepare('SELECT `artworks_details`.`ArtworkID`,`item_to_kind`.`ItemID`,
            `item_kinds_detail`.`ItemKindID`,`item_to_kind`.`ChoiceID`,`item_kinds_detail`.`CultureID`,
            `item_kinds_detail`.`LookupValue`
            FROM artworks_details
            INNER JOIN item_to_kind
            ON `artworks_details`.`ArtworkID` = `item_to_kind`.`ItemID`
            INNER JOIN `item_kinds_detail`
            ON `item_to_kind`.`ChoiceID` = `item_kinds_detail`.`ItemKindID`
            WHERE `item_to_kind`.`ItemID` = :ArtworkID;
');

        $stmt->execute( array('ArtworkID' => $ArtworkID ));

        $array = array();
        $ind = 0;
       foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Artwork();
            $itm->ArtworkID = $row['ArtworkID'];
            $itm->ItemID = $row['ItemID'];
            $itm->ItemKindID = $row['ItemKindID'];
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  




     public function getsomeDetailsforArtwork($ArtworkID)   //Display the current_id, condition,  last visit of a Museum
   {

        $stmt = $this->pdo->prepare('SELECT artworks_details.ArtworkID, items.*,
            conditions_details.LookupValue , conditions_details.conditionID, archivedobjects.UniqueName
            FROM artworks_details
            INNER JOIN items
            ON `artworks_details`.`ArtworkID` = `items`.`ItemID`
            INNER JOIN conditions_details
            ON `conditions_details`.`ConditionID` = `items`.`ConditionID`
            INNER JOIN archivedobjects 
            ON `archivedobjects`.`ArchivedObjectID` = `items`.`parentID`
            WHERE `artworks_details`.`ArtworkID` = :ArtworkID;
');

            $stmt->execute( array('ArtworkID' => $ArtworkID ));

            $array = array(); 
            $ind = 0;
            foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Artwork();
            $itm->ArtworkID = $row['ArtworkID'];
            $itm->ItemID = $row['ItemID']; 
            $itm->lastVisitDate = $row['lastVisitDate'];
            $itm->lastVisitInfo = $row['lastVisitInfo']; 
            $itm->LookupValue = $row['LookupValue']; 
            $itm->isCurrent = $row['isCurrent']; 
            $itm->conditionID = $row['conditionID'];
            $itm->UniqueName = $row['UniqueName'];
            //$itm->YearInfo = $row['YearInfo'];
            //$itm->conditionID = $row['conditionID'];
            //$itm->MonthInfo = $row['MonthInfo'];
            //$itm->DayInfo = $row['DayInfo'];
            //$itm->ca = $row['ca'];
            $itm->CultureID = $row['CultureID'];
            
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    } 



}
