<?php

class ControllerKeyword {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }


public function getKeywordWithTypeID($accompanyingItemTypeID,$CultureID){   //GET KEYWORDS FOR ACCOMPANYING OBJECT



$stmt = $this->pdo->prepare('SELECT distinct keywords_per_record.KeywordID, accompanyingItemTypes.* , keywords_per_record.TableName ,
							 keywords_details.KeywordTranslation, keywords_details.KeywordID, keywords_details.CultureID
	                        FROM `accompanyingItemTypes` 
	                        INNER JOIN keywords_per_record 
	                        ON `keywords_per_record`.`TableName` = `accompanyingItemTypes`.`AssociatedTable` 
	                        INNER JOIN keywords_details
	                        ON `keywords_per_record`.`KeywordID`  = `keywords_details`.`KeywordID`
	                        WHERE accompanyingItemTypes.accompanyingItemTypeID = :accompanyingItemTypeID
	                        AND CultureID = :CultureID;
');

$stmt->execute( array('accompanyingItemTypeID' => $accompanyingItemTypeID, 'CultureID' => $CultureID ));

$array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Keyword();
            $itm->KeywordID = $row['KeywordID'];
            $itm->TableName = $row['TableName'];
            $itm->accompanyingItemTypeID  = $row['accompanyingItemTypeID '];
            $itm->AssociatedTable = $row['AssociatedTable'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];

           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }





public function getKeywordWithTypeIDD($TableName,$CultureID){   //GET KEYWORDS FOR ACCOMPANYING OBJECT



$stmt = $this->pdo->prepare('SELECT distinct keywords_per_record.KeywordID, keywords_per_record.TableName,
                             keywords_details.KeywordTranslation, keywords_details.KeywordID, keywords_details.CultureID
                            FROM `keywords_per_record` 
                            INNER JOIN keywords_details
                            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
                            WHERE TableName LIKE TableName  AND CultureID = :CultureID ; 
');

$stmt->execute( array('TableName' => $TableName, 'CultureID' => $CultureID ));

$array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Keyword();
            $itm->KeywordID = $row['KeywordID'];
            $itm->TableName = $row['TableName'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];

           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }





    public function getKeywordWithItemTypeID($itemTypeID,$CultureID){   //GET KEYWORDS FOR mainUnities OBJECT



$stmt = $this->pdo->prepare('SELECT distinct keywords_per_record.KeywordID, itemtypes.* , keywords_per_record.TableName ,
                             keywords_details.KeywordTranslation, keywords_details.KeywordID, keywords_details.CultureID
                            FROM `itemtypes` 
                            INNER JOIN keywords_per_record 
                            ON `keywords_per_record`.`TableName` = `itemtypes`.`AssociatedTable` 
                            INNER JOIN keywords_details
                            ON `keywords_per_record`.`KeywordID`  = `keywords_details`.`KeywordID`
                            WHERE itemtypes.itemTypeID = :itemTypeID
                            AND CultureID = :CultureID;
');

$stmt->execute( array('itemTypeID' => $itemTypeID, 'CultureID' => $CultureID ));

$array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Keyword();
            $itm->KeywordID = $row['KeywordID'];
            $itm->TableName = $row['TableName'];
            $itm->itemTypeID  = $row['itemTypeID '];
            $itm->AssociatedTable = $row['AssociatedTable'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];

           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


 public function getKeywordForEachItem($KeywordPerRecordID, $CultureID = NULL){   
        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`,
             `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
             `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `keywords_per_record` 
            INNER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :KeywordPerRecordID AND `keywords_details`.`CultureID` = :CultureID;');

        $stmt->execute( array('KeywordPerRecordID' => $KeywordPerRecordID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new stdClass();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  










}

