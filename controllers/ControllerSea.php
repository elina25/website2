<?php

class ControllerSea{

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }


public function getAllSeas()
{
    $stmt = $this->pdo->prepare('SELECT * FROM `seas`');

        $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Sea();
            $itm->seaID = $row['seaID'];
            $itm->kindID = $row['kindID'];
            $itm->longitude = $row['longitude'];
            $itm->latitude = $row['latitude'];
            ;
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }

    public function getAllSeasFromSeaDetails($CultureID, $FilterObject, $PageSize = NULL, $RecordOffest = NULL)  //list
{
    
     $query = "SELECT DISTINCT m.* /*, ref.referencedObjectID, ref_items.* */
                    FROM seas_details m
                    LEFT JOIN geophysicalReferences ref
                    ON m.seaID = ref.geophysicalObjectID
                    LEFT JOIN archivedobjects ao
                    ON ao.ArchivedObjectID = ref.referencedObjectID
                    LEFT JOIN items ref_items
                    ON ref.referencedObjectID = ref_items.itemID 
                    LEFT JOIN item_to_kind itk
                    ON itk.itemID = m.seaID
                    LEFT JOIN keywords_per_record kpr 
                    ON kpr.TableName = 'tSeas' AND kpr.RecordID = m.seaID
                    WHERE m.CultureID = :CultureID ";



           if ($FilterObject != null) {
           // echo json_encode($FilterObject);
            $query .= sprintf(" AND m.officialName LIKE '%s' ", $FilterObject->OfficialName);
            $query .= sprintf(" AND m.friendlyName LIKE '%s' ", $FilterObject->Title);

            if (!IsNullOrEmpty($FilterObject->MainUnities)) {
                if (strpos($FilterObject->MainUnities, 'REGIONS') !== false) {
                    $query .= "  AND ao.IsRegion = 1";
                    
                    $_mainUnities = $FilterObject->MainUnities;
                    $_mainUnities = str_replace("REGIONS,", "", $_mainUnities);
                    $_mainUnities = str_replace("REGIONS", "", $_mainUnities);
                }
                if (!IsNullOrEmpty($_mainUnities)) {
                    $query .= sprintf(" AND ref_items.itemTypeID IN (%s) ", $_mainUnities);
                }
                }
            if (!IsNullOrEmpty($FilterObject->Kinds)) {
                $query .= sprintf(" AND itk.ChoiceID IN (%s) ", $FilterObject->Kinds);
            }
            if (!IsNullOrEmpty($FilterObject->Keywords)) {
                $query .= sprintf(" AND kpr.KeywordID IN (%s) ", $FilterObject->Keywords);
                    }
        }

           

         if(is_numeric($PageSize) && is_numeric($RecordOffest))
        {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " .  $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);

        $stmt->execute( array('CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Sea();
            $itm->seaID = $row['seaID'];
            $itm->seas_detailsID =$row['seas_detailsID'];
            $itm->officialName =$row['officialName'];
            $itm->friendlyName =$row['friendlyName'];
            $itm->CultureID =$row['CultureID'];
            $itm->localName =$row['localName'];
            
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
}



    public function getAllSeaCount($CultureID,$FilterObject) {

         try {
                $query = "SELECT  COUNT(DISTINCT m.seas_detailsID) /*, ref.referencedObjectID, ref_items.* */
                    FROM seas_details m
                    LEFT JOIN geophysicalReferences ref
                    ON m.seaID = ref.geophysicalObjectID
                    LEFT JOIN archivedobjects ao
                    ON ao.ArchivedObjectID = ref.referencedObjectID
                    LEFT JOIN items ref_items
                    ON ref.referencedObjectID = ref_items.itemID 
                    LEFT JOIN item_to_kind itk
                    ON itk.itemID = m.seaID
                    LEFT JOIN keywords_per_record kpr 
                    ON kpr.TableName = 'tSeas' AND kpr.RecordID = m.seaID
                    WHERE m.CultureID = :CultureID ";    


        if ($FilterObject != null) {
            //echo json_encode($FilterObject);
            $query .= sprintf(" AND m.officialName LIKE '%s' ", $FilterObject->OfficialName);
            $query .= sprintf(" AND m.friendlyName LIKE '%s' ", $FilterObject->Title);

            if (!IsNullOrEmpty($FilterObject->MainUnities)) {
                if (strpos($FilterObject->MainUnities, 'REGIONS') !== false) {
                    $query .= "  AND ao.IsRegion = 1";
                    
                    $_mainUnities = $FilterObject->MainUnities;
                    $_mainUnities = str_replace("REGIONS,", "", $_mainUnities);
                    $_mainUnities = str_replace("REGIONS", "", $_mainUnities);
                }
                if (!IsNullOrEmpty($_mainUnities)) {
                    $query .= sprintf(" AND ref_items.itemTypeID IN (%s) ", $_mainUnities);
                }
            }
            if (!IsNullOrEmpty($FilterObject->Kinds)) {
                $query .= sprintf(" AND itk.ChoiceID IN (%s) ", $FilterObject->Kinds);
            }
            if (!IsNullOrEmpty($FilterObject->Keywords)) {
                $query .= sprintf(" AND kpr.KeywordID IN (%s) ", $FilterObject->Keywords);
            }
        }

       // echo $query;
    
        $stmt = $this->pdo->prepare($query); 
        $result = $stmt->execute( array('CultureID' => $CultureID ));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
        } catch (Exception $e) {
            print_r($e);
        }

    }


public function getSeaDetailWithID($seaID, $CultureID)
{
	$stmt = $this->pdo->prepare('SELECT * 
		FROM `seas_details`
        WHERE seaID = :seaID AND `seas_details`.`CultureID` = :CultureID');

	$result = $stmt->execute(array('seaID' => $seaID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Sea();
            $itm->seaID = $row['seaID'];
            $itm->kindID = $row['kindID'];
            $itm->longitude = $row['longitude'];
            $itm->latitude = $row['latitude'];
            $itm->seas_detailsID =$row['seas_detailsID'];
            $itm->OfficialName =$row['officialName'];
            $itm->FriendlyName =$row['friendlyName'];
            $itm->CultureID =$row['CultureID'];
            $itm->localName =$row['localName'];
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


    public function getSeaWithID($seaID)
    {
    $stmt = $this->pdo->prepare('SELECT * FROM `seas`
         WHERE seaID=:seaID;');

        $stmt->execute(array('seaID' => $seaID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Sea();
            $itm->seaID = $row['seaID'];
            $itm->longitude = $row['longitude'];
            $itm->latitude = $row['latitude'];
   
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }
















}
