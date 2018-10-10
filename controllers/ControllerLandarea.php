<?php

class ControllerLandarea {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getAllLandareasFromLandereaDetails($CultureID, $FilterObject, $PageSize = NULL, $RecordOffest = NULL)
{
         $query = "SELECT DISTINCT m.* /*, ref.referencedObjectID, ref_items.* */
                    FROM landareas_details m
                    LEFT JOIN geophysicalReferences ref
                    ON m.landAreaID = ref.geophysicalObjectID
                    LEFT JOIN archivedobjects ao
                    ON ao.ArchivedObjectID = ref.referencedObjectID
                    LEFT JOIN items ref_items
                    ON ref.referencedObjectID = ref_items.itemID 
                    LEFT JOIN item_to_kind itk
                    ON itk.itemID = m.landAreaID
                    LEFT JOIN keywords_per_record kpr 
                    ON kpr.TableName = 'tLandAreas' AND kpr.RecordID = m.landAreaID
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
            $itm = new LandArea();
            $itm->detailsID = $row['detailsID'];
            $itm->landAreaID = $row['landAreaID'];
            $itm->CultureID = $row['CultureID'];
            $itm->OfficialName = $row['officialName'];
            $itm->FriendlyName = $row['friendlyName'];
            $itm->phoneticTranscription = $row['phoneticTranscription'];
            
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



     public function getAllLandAreasCount($CultureID,$FilterObject) {  
try {
        $query = "SELECT DISTINCT m.* /*, ref.referencedObjectID, ref_items.* */
        FROM landareas_details m
        LEFT JOIN geophysicalReferences ref
        ON m.landAreaID = ref.geophysicalObjectID
        LEFT JOIN archivedobjects ao
        ON ao.ArchivedObjectID = ref.referencedObjectID
        LEFT JOIN items ref_items
        ON ref.referencedObjectID = ref_items.itemID 
        LEFT JOIN item_to_kind itk
        ON itk.itemID = m.landAreaID
        LEFT JOIN keywords_per_record kpr 
        ON kpr.TableName = 'tLandAreas' AND kpr.RecordID = m.landAreaID
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

public function getLandAreasDetailWithID($landAreaID, $CultureID)
{
    $stmt = $this->pdo->prepare('SELECT * 
        FROM `landareas_details`
        WHERE landAreaID = :landAreaID AND CultureID = :CultureID;');

    $stmt->execute(array('landAreaID' => $landAreaID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new LandArea();
            $itm->landAreaID = $row['landAreaID'];
            $itm->OfficialName = $row['officialName'];
            $itm->FriendlyName = $row['friendlyName'];
            $itm->CultureID = $row['CultureID'];
            $itm->localName = $row['localName'];
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
}


public function getMapDetailsWithID($landareaID)

{
    $stmt = $this->pdo->prepare('SELECT * 
        FROM `landareas`
        WHERE landareaID =:landareaID;');

    $stmt->execute(array('landareaID' => $landareaID ) );

    $array = array();
    $ind = 0;

    foreach ($stmt as $row)
    {
        $itm = new LandArea();
        $itm->landareaID = $row['landareaID'];
        $itm->longitude = $row['longitude'];
        $itm->latitude = $row['latitude'];

        $array[$ind] = $itm;
        $ind++;

    }

    return $array;

}

}