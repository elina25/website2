<?php

class ControllerArchaeologicalReligiousMonument {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getParentWithID($regionID) {
        $stmt = $this->pdo->prepare('SELECT * FROM `archivedobjects` WHERE `ArchivedObjectID`=:reg_id');

        $result = $stmt->execute(array('reg_id' => $regionID));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new ReligiousMonument();
            $itm->region_id = $row['ArchivedObjectID'];
            $itm->unique_name = $row['UniqueName'];
//            print_r($itm);
            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }

    public function getReligionWithID($religionID) {
        $stmt = $this->pdo->prepare('SELECT * FROM `religions` WHERE `ReligionID`=:reg_id');

        $result = $stmt->execute(array('reg_id' => $religionID));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new ReligiousMonument();
            $itm->region_id = $row['ReligionID'];
            $itm->unique_name = $row['StandardValue'];
//            print_r($itm);
            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }

    public function getReligiousMonumentWithID($regionID) {
        $stmt = $this->pdo->prepare('SELECT a.*,i.conditionID,i.lastVisitDate,i.isCurrent,i.lastVisitInfo FROM `religiousMonuments` a left join items i on i.itemId=a.ReligiousMonumentId WHERE a.`ReligiousMonumentId`=:reg_id');

        $result = $stmt->execute(array('reg_id' => $regionID));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new ReligiousMonument();
            $itm->region_id = $row['ReligiousMonumentId'];
            $itm->conditionID = $row['conditionID'];
            $itm->longitude = $row['longitude'];
            $itm->latitude = $row['latitude'];
            $itm->unique_name = $row['UniqueName'];
            $itm->parentID = $row['parentID'];
            $itm->religionID = $row['religionID'];
            $itm->itemKindID = $row['itemKindID'];
            $itm->isCurrent = $row['isCurrent'];
            $itm->lastVisitDate = $row['lastVisitDate'];
            $itm->lastVisitInfo = $row['lastVisitInfo'];
//            print_r($itm);
            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }

    public function getReligiousMonumentDetails($regionID, $culture_id) {
        $stmt = $this->pdo->prepare('SELECT * FROM `religiousMonumentsDetails` WHERE `ReligiousMonumentId`=:reg_id and `CultureID` = :culture ');

        $result = $stmt->execute(array('reg_id' => $regionID, 'culture' => $culture_id));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new ReligiousMonument();
            $itm->detail_id = $row['ID'];
            $itm->ReligiousMonumentId = $row['ReligiousMonumentId'];
            $itm->officialName = $row['officialName'];
            $itm->friendlyName = $row['friendlyName'];
            $itm->phoneticTranscription = $row['phoneticTranscription'];
            $itm->localName = $row['localName'];
            $itm->historicalData = $row['historicalData'];
            $itm->address = $row['address'];
            $itm->contact = $row['contact'];
            $itm->description_form = $row['description_form'];
            $itm->embeddedArtwork = $row['embeddedArtwork'];
            $itm->founder = $row['founder'];
            $itm->artists = $row['artists'];
            $itm->people = $row['people'];
            $itm->areIncluded = $row['areIncluded'];
            $itm->sponsors = $row['sponsors'];
            $itm->commentsPlainText = $row['commentsPlainText'];
            $itm->historicalDataPlainText = $row['historicalDataPlainText'];
            $itm->info = $row['info'];
            $itm->Comments = $row['Comments'];
            $itm->CreatedOn = $row['CreatedOn'];

            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }

    //For Item Kind

    public function getItemKinds($type) {
        $stmt = $this->pdo->prepare('SELECT * FROM `item_kinds` WHERE  `ItemTypeID` = :type ORDER BY `StandardValue`');

        $result = $stmt->execute(array('type' => $type));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new stdClass();
            $itm->ItemKindID = $row['ItemKindID'];
            $itm->StandardValue = $row['StandardValue'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

    public function getSelectedKinds($type_id, $item) {
        $stmt = $this->pdo->prepare('SELECT * FROM  `item_to_kind` WHERE  `ItemID` = :item');

        $result = $stmt->execute(array('item' => $item));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $array[$ind] = $row['ChoiceID'];
            $ind++;
        }
        return $array;
    }



    public function getItemInterest($type) {
        $stmt = $this->pdo->prepare('SELECT * FROM `interests` WHERE  `ItemTypeID` = :type ORDER BY `StandardValue`');

        $result = $stmt->execute(array('type' => $type));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new stdClass();
            $itm->interestID = $row['interestID'];
            $itm->StandardValue = $row['StandardValue'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

    public function getSelectedInterest($type_id, $item) {
        $stmt = $this->pdo->prepare('SELECT * FROM  `item_to_interest` WHERE  `ItemID` = :item');

        $result = $stmt->execute(array('item' => $item));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $array[$ind] = $row['ChoiceID'];
            $ind++;
        }
        return $array;
    }

  


    public function getAllKeywords() {
        $stmt = $this->pdo->prepare('SELECT * FROM `keywords` ');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            //$itm = new Keyword();
            //$itm->keywordID = $row['KeywordID'];
            //$itm->createdOn = $row['CreatedOn'];
            //$itm->keyword = $row['Keyword'];
            //return $itm;
            $array[$ind] = array('value' => $row['KeywordID'], 'label' => $row['Keyword']);
            $ind++;
        }
        return $array;
    }







}

?>