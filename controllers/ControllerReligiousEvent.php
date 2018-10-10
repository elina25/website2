<?php

class ControllerReligiousEvent {

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
            $itm = new ReligiousEvent();
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
            $itm = new ReligiousEvent();
            $itm->region_id = $row['ReligionID'];
            $itm->unique_name = $row['StandardValue'];
//            print_r($itm);
            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }


    public function getReligiousEventWithID($ReligiousEventID) //DISPLAY DATA FOR 
    {
        $stmt = $this->pdo->prepare('SELECT * 
            FROM `religiousEvents` 
          
            WHERE ReligiousEventID = :ReligiousEventID;
');

        $stmt->execute( array('ReligiousEventID' => $ReligiousEventID ));

        
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ReligiousEvent();
            $itm->ReligiousEventID = $row['ReligiousEventID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->parentID = $row['parentID'];
            $itm->religionID = $row['religionID'];
            $itm->eventTimeID = $row['eventTimeID'];
       
            return $itm;
            
          }

       
    }






    public function getReligiousEventDetails($regionID, $culture_id) {
        $stmt = $this->pdo->prepare('SELECT * FROM `religiousEventsDetails` WHERE `religiousEventID`=:reg_id and `cultureID` = :culture');

        $result = $stmt->execute(array('reg_id' => $regionID, 'culture' => $culture_id));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new ReligiousEvent();
            $itm->detail_id = $row['ID'];
            $itm->title = $row['title'];
            $itm->occasion = $row['occasion'];
            $itm->historicalData = $row['historicalData'];
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


  public function getItemLocations($type) {
        $stmt = $this->pdo->prepare('SELECT * FROM `item_location` WHERE  `ItemTypeID` = :type ORDER BY `StandardValue`');

        $result = $stmt->execute(array('type' => $type));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new stdClass();
            $itm->ItemLocationID = $row['ItemLocationID'];
            $itm->StandardValue = $row['StandardValue'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }



    public function getSelectedLocations($type_id, $item) {
        $stmt = $this->pdo->prepare('SELECT * FROM  `item_to_location` WHERE  `ItemID` = :item');

        $result = $stmt->execute(array('item' => $item));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $array[$ind] = $row['ChoiceID'];
            $ind++;
        }
        return $array;
    }


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


        public function getKeywordsForReligiousEventId($regionID) {
        $stmt = $this->pdo->prepare('SELECT * FROM `keywords_per_record` INNER JOIN `keywords` ON `keywords`.`KeywordID` = `keywords_per_record`.`KeywordID`
                                        WHERE `RecordID`=:reg_id AND `TableName` = :tableName');

        $result = $stmt->execute(array('reg_id' => $regionID, 'tableName' => 'tReligiousEvents'));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
//            $itm = new Keyword();
            $itm['keywordID'] = $row['KeywordID'];
            $itm['recordID'] = $row['RecordID'];
            $itm['tableName'] = $row['TableName'];
            $itm['createdOn'] = $row['CreatedOn'];
            $itm['keyword'] = $row['Keyword'];

            //return $itm;
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}